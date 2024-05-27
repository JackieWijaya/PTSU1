<?php

namespace App\Http\Controllers;

use App\Models\data_karyawan;
use App\Models\jabatan;
use App\Models\data_pribadi;
use App\Models\data_keluarga_inti;
use App\Models\data_keluarga_kandung;
use App\Models\data_pendidikan;
use App\Models\pelatihan_sertifikat;
use App\Models\pengalaman_kerja;
use App\Models\bahasa_asing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->role == 'HRD'){
            $data_karyawan = User::select('users.*', 'data_pribadis.*')
                ->join('data_pribadis', 'users.no_hp', '=', 'data_pribadis.no_hp')
                ->where('users.role', '!=', 'HRD')
                ->get();
            return view('data_karyawan.index')->with('data_karyawan', $data_karyawan);
        } else {
            $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
            $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
            $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $data_pribadi->id)->get();
            $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi->id)->get();
            $data_pendidikan = data_pendidikan::where('data_pribadis_id', $data_pribadi->id)->get();
            $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi->id)->get();
            $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $data_pribadi->id)->get();
            $bahasa_asing = bahasa_asing::where('data_pribadis_id', $data_pribadi->id)->first();

            return view('data_karyawan.index')->with('data_pribadi', $data_pribadi)->with('data_keluarga_inti', $data_keluarga_inti)->with('data_keluarga_kandung', $data_keluarga_kandung)->with('data_pendidikan', $data_pendidikan)->with('pelatihan_sertifikat', $pelatihan_sertifikat)->with('pengalaman_kerja', $pengalaman_kerja)->with('bahasa_asing', $bahasa_asing);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jabatans = jabatan::all();
        return view('data_karyawan.create')->with('jabatans', $jabatans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_lengkap'        => 'required', 
            'no_hp'               => 'required|numeric|gt:-1|unique:users',
            'jenis_kelamin'       => 'required', 
            'jabatan'             => 'required', 
            'devisi'              => 'required', 
            'golongan'            => 'required',
            'tanggal_masuk_kerja' => 'required'
        ],
        [
            'nama_lengkap.required'        => 'Nama Lengkap Harus Diisi',
            'no_hp.required'               => 'No HP Harus Diisi',
            'no_hp.numeric'                => 'No HP Harus Angka',
            'no_hp.gt'                     => 'No HP Tidak Boleh Min',
            'no_hp.unique'                 => 'No HP Sudah Terdaftar',
            'jenis_kelamin.required'       => 'Pilih Jenis Kelamin',
            'jabatan.required'             => 'Pilih Jabatan',
            'devisi.required'              => 'Devisi Harus Diisi',
            'golongan.required'            => 'Golongan Harus Diisi',
            'tanggal_masuk_kerja.required' => 'Tanggal Masuk Kerja Harus Diisi'
        ]);

        $user = new User();
        $user->name     = $validateData['nama_lengkap'];
        $user->no_hp    = $validateData['no_hp'];
        $user->password = $validateData['no_hp'];
        $user->save();

        $data_pribadi = new data_pribadi();
        $data_pribadi->nama_lengkap        = $validateData['nama_lengkap'];
        $data_pribadi->jenis_kelamin       = $validateData['jenis_kelamin'];
        $data_pribadi->tempat_lahir        = '-';
        $data_pribadi->no_hp               = $validateData['no_hp'];
        $data_pribadi->email               = '-';
        $data_pribadi->alamat              = '-';
        $data_pribadi->pendidikan_terakhir = '-';
        $data_pribadi->agama               = '-';
        $data_pribadi->golongan_darah      = '-';
        $data_pribadi->status              = 'Diterima';
        $data_pribadi->jabatans_id         = $validateData['jabatan'];
        $data_pribadi->devisi              = $validateData['devisi'];
        $data_pribadi->golongan            = $validateData['golongan'];
        $data_pribadi->tanggal_masuk_kerja = $validateData['tanggal_masuk_kerja'];
        $data_pribadi->save();

        Alert::success('Berhasil', "Data Karyawan Berhasil Ditambahkan");
        return redirect()->route('data_karyawan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(data_karyawan $data_karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_karyawan $data_karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nik_pribadi'          => 'required|numeric|gt:-1',
            'ktp'                  => 'required|image|max:800|mimes:jpg,jpeg,png',
            'rekening'             => 'image|max:800|mimes:jpg,jpeg,png',
            'sim'                  => 'image|max:800|mimes:jpg,jpeg,png',
            'kk'                   => 'required|image|max:800|mimes:jpg,jpeg,png',
            'bpjs_ketenagakerjaan' => 'image|max:800|mimes:jpg,jpeg,png',
            'bpjs_kesehatan'       => 'image|max:800|mimes:jpg,jpeg,png',
            'npwp'                 => 'image|max:800|mimes:jpg,jpeg,png',

            'nik_inti'                   => 'required',
            'status_keluarga_inti'       => 'required',
            'nama_anggota_keluarga_inti' => 'required',
            'ktp_pasangan'               => 'image|max:800|mimes:jpg,jpeg,png',
            'tempat_lahir_inti'          => 'required',
            'tanggal_lahir_inti'         => 'required',
            'pendidikan_inti'            => 'required',
            'pekerjaan_inti'             => 'required',

            'status_keluarga_kandung'       => 'required',
            'nama_anggota_keluarga_kandung' => 'required',
            'jenis_kelamin_kandung'         => 'required',
            'tempat_lahir_kandung'          => 'required',
            'tanggal_lahir_kandung'         => 'required',
            'pendidikan_kandung'            => 'required',
            'pekerjaan_kandung'             => 'required',

            'jenjang'      => 'required',
            'fakultas'     => 'required',
            'nama_sekolah' => 'required',
            'jurusan'      => 'required',
            'tahun_masuk'  => 'required',
            'tahun_lulus'  => 'required',

            'nama_lembaga'    => 'required',
            'jenis'           => 'required',
            'mulai_pelatihan' => 'required',
            'akhir_pelatihan' => 'required',

            'nama_perusahaan' => 'required',
            'jabatan'         => 'required',
            'mulai_kerja'     => 'required',
            'akhir_kerja'     => 'required',
            'gaji'            => 'required',
            'alasan_keluar'   => 'required',

            'lisan'   => 'required',
            'tulisan' => 'required'
        ],
        [
            'nik_pribadi.required'       => 'NIK Harus Diisi',
            'nik_pribadi.numeric'        => 'NIK Harus Angka',
            'nik_pribadi.gt'             => 'NIK Tidak Boleh Min',
            'ktp.required'               => 'KTP Harus Diisi',
            'ktp.image'                  => 'File Harus Foto',   
            'ktp.mimes'                  => 'Format Harus .jpg/.jpeg/.png',
            'ktp.max'                    => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'rekening.image'             => 'File Harus Foto',   
            'rekening.mimes'             => 'Format Harus .jpg/.jpeg/.png',
            'rekening.max'               => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'sim.image'                  => 'File Harus Foto',   
            'sim.mimes'                  => 'Format Harus .jpg/.jpeg/.png',
            'sim.max'                    => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'kk.required'                => 'KK Harus Diisi',
            'kk.image'                   => 'File Harus Foto',   
            'kk.mimes'                   => 'Format Harus .jpg/.jpeg/.png',
            'kk.max'                     => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'bpjs_ketenagakerjaan.image' => 'File Harus Foto',   
            'bpjs_ketenagakerjaan.mimes' => 'Format Harus .jpg/.jpeg/.png',
            'bpjs_ketenagakerjaan.max'   => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'bpjs_kesehatan.image'       => 'File Harus Foto',   
            'bpjs_kesehatan.mimes'       => 'Format Harus .jpg/.jpeg/.png',
            'bpjs_kesehatan.max'         => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'npwp.image'                 => 'File Harus Foto',   
            'npwp.mimes'                 => 'Format Harus .jpg/.jpeg/.png',
            'npwp.max'                   => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',

            'nik_inti.required'                   => 'NIK Harus Diisi',
            'status_keluarga_inti.required'       => 'Status Keluarga Harus Diisi',
            'nama_anggota_keluarga_inti.required' => 'Nama Anggota Keluarga Harus Diisi',
            'ktp_pasangan.image'                  => 'File Harus Foto',   
            'ktp_pasangan.mimes'                  => 'Format Harus .jpg/.jpeg/.png',
            'ktp_pasangan.max'                    => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'tempat_lahir_inti.required'          => 'Tempat Lahir Harus Diisi',
            'tanggal_lahir_inti.required'         => 'Tanggal Lahir Harus Diisi',
            'pendidikan_inti.required'            => 'Pendidikan Harus Diisi',
            'pekerjaan_inti.required'             => 'Pekerjaan Harus Diisi',

            'status_keluarga_kandung.required'       => 'Status Keluarga Harus Diisi',
            'nama_anggota_keluarga_kandung.required' => 'Nama Anggota Keluarga Harus Diisi',
            'jenis_kelamin_kandung.required'         => 'Pilih Jenis Kelamin',
            'tempat_lahir_kandung.required'          => 'Tempat Lahir Harus Diisi',
            'tanggal_lahir_kandung.required'         => 'Tanggal Lahir Harus Diisi',
            'pendidikan_kandung.required'            => 'Pendidikan Harus Diisi',
            'pekerjaan_kandung.required'             => 'Pekerjaan Harus Diisi',

            'jenjang.required'      => 'Jenjang Harus Diisi',
            'fakultas.required'     => 'Fakultas Harus Diisi',
            'nama_sekolah.required' => 'Nama Sekolah Harus Diisi',
            'jurusan.required'      => 'Jurusan Harus Diisi',
            'tahun_masuk.required'  => 'Tahun Masuk Harus Diisi',
            'tahun_lulus.required'  => 'Tahun Lulus Harus Diisi',

            'nama_lembaga.required'    => 'Nama Lembaga Harus Diisi',
            'jenis.required'           => 'Jenis Harus Diisi',
            'mulai_pelatihan.required' => 'Mulai Harus Diisi',
            'akhir_pelatihan.required' => 'Akhir Harus Diisi',

            'nama_perusahaan.required' => 'Nama Perusahaan Harus Diisi',
            'jabatan.required'         => 'Jabatan Harus Diisi',
            'mulai_kerja.required'     => 'Mulai Harus Diisi',
            'akhir_kerja.required'     => 'Akhir Harus Diisi',
            'gaji.required'            => 'Gaji Harus Diisi',
            'alasan_keluar.required'   => 'Alasan Keluar Harus Diisi',

            'lisan.required'   => 'Pilih Nilai Keahlian',
            'tulisan.required' => 'Pilih Nilai Keahlian'
        ]);

        $extktp = $request->ktp->getClientOriginalExtension();
        $extkk = $request->kk->getClientOriginalExtension();

        $ktp = "ktp-".time().".".$extktp;
        $request->ktp->storeAs('public/DataKaryawan',$ktp);
        
        $kk = "kk-".time().".".$extkk;
        $request->kk->storeAs('public/DataKaryawan',$kk);

        $rekening = '-';
        $sim = '-';
        $bpjs_ketenagakerjaan = '-';
        $bpjs_kesehatan = '-';
        $npwp = '-';
        $ktp_pasangan = '-';
        if($request->hasFile('rekening')){
            $extrekening = $request->rekening->getClientOriginalExtension();
            $rekening = "rekening-".time().".".$extrekening;
            $request->rekening->storeAs('public/DataKaryawan',$rekening);
        }
        if($request->hasFile('sim')){
            $extsim = $request->sim->getClientOriginalExtension();
            $sim = "sim-".time().".".$extsim;
            $request->sim->storeAs('public/DataKaryawan',$sim);
        }
        if($request->hasFile('bpjs_ketenagakerjaan')){
            $extbpjsketenagakerjaan = $request->bpjs_ketenagakerjaan->getClientOriginalExtension();
            $bpjs_ketenagakerjaan = "bpjs_ketenagakerjaan-".time().".".$extbpjsketenagakerjaan;
            $request->bpjs_ketenagakerjaan->storeAs('public/DataKaryawan',$bpjs_ketenagakerjaan);
        }
        if($request->hasFile('bpjs_kesehatan')){
            $extbpjskesehatan = $request->bpjs_kesehatan->getClientOriginalExtension();
            $bpjs_kesehatan = "bpjs_kesehatan-".time().".".$extbpjskesehatan;
            $request->bpjs_kesehatan->storeAs('public/DataKaryawan',$bpjs_kesehatan);
        }
        if($request->hasFile('npwp')){
            $extnpwp = $request->npwp->getClientOriginalExtension();
            $npwp = "npwp-".time().".".$extnpwp;
            $request->npwp->storeAs('public/DataKaryawan',$npwp);
        }
        if($request->hasFile('ktp_pasangan')){
            $extktppasangan = $request->ktp_pasangan->getClientOriginalExtension();
            $ktp_pasangan = "ktp_pasangan-".time().".".$extktppasangan;
            $request->ktp_pasangan->storeAs('public/DataKaryawan',$ktp_pasangan);
        }

        $data_pribadi = data_pribadi::find($request->id);
        $data_pribadi->ktp                  = $ktp;
        $data_pribadi->rekening             = $rekening;
        $data_pribadi->sim                  = $sim;
        $data_pribadi->kk                   = $kk;
        $data_pribadi->bpjs_ketenagakerjaan = $bpjs_ketenagakerjaan;
        $data_pribadi->bpjs_kesehatan       = $bpjs_kesehatan;
        $data_pribadi->npwp                 = $npwp;
        $data_pribadi->nik                  = $validateData['nik_pribadi'];
        $data_pribadi->update();

        $data_keluarga_inti = new data_keluarga_inti();
        $data_keluarga_inti->data_pribadis_id      = $request->id;
        $data_keluarga_inti->nik                   = $validateData['nik_inti'];
        $data_keluarga_inti->status_keluarga       = $validateData['status_keluarga_inti'];
        $data_keluarga_inti->nama_anggota_keluarga = $validateData['nama_anggota_keluarga_inti'];
        $data_keluarga_inti->ktp_pasangan          = $ktp_pasangan;
        $data_keluarga_inti->tempat_lahir          = $validateData['tempat_lahir_inti'];
        $data_keluarga_inti->tanggal_lahir         = $validateData['tanggal_lahir_inti'];
        $data_keluarga_inti->pendidikan            = $validateData['pendidikan_inti'];
        $data_keluarga_inti->pekerjaan             = $validateData['pekerjaan_inti'];
        $data_keluarga_inti->save();

        $data_keluarga_kandung = new data_keluarga_kandung();
        $data_keluarga_kandung->data_pribadis_id      = $request->id;
        $data_keluarga_kandung->status_keluarga       = $validateData['status_keluarga_kandung'];
        $data_keluarga_kandung->nama_anggota_keluarga = $validateData['nama_anggota_keluarga_kandung'];
        $data_keluarga_kandung->jenis_kelamin         = $validateData['jenis_kelamin_kandung'];
        $data_keluarga_kandung->tempat_lahir          = $validateData['tempat_lahir_kandung'];
        $data_keluarga_kandung->tanggal_lahir         = $validateData['tanggal_lahir_kandung'];
        $data_keluarga_kandung->pendidikan            = $validateData['pendidikan_kandung'];
        $data_keluarga_kandung->pekerjaan             = $validateData['pekerjaan_kandung'];
        $data_keluarga_kandung->save();

        $data_pendidikan = new data_pendidikan();
        $data_pendidikan->data_pribadis_id = $request->id;
        $data_pendidikan->jenjang          = $validateData['jenjang'];
        $data_pendidikan->fakultas         = $validateData['fakultas'];
        $data_pendidikan->nama_sekolah     = $validateData['nama_sekolah'];
        $data_pendidikan->jurusan          = $validateData['jurusan'];
        $data_pendidikan->tahun_masuk      = $validateData['tahun_masuk'];
        $data_pendidikan->tahun_lulus      = $validateData['tahun_lulus'];
        $data_pendidikan->save();

        $pelatihan_sertifikat = new pelatihan_sertifikat();
        $pelatihan_sertifikat->data_pribadis_id = $request->id;
        $pelatihan_sertifikat->nama_lembaga     = $validateData['nama_lembaga'];
        $pelatihan_sertifikat->jenis            = $validateData['jenis'];
        $pelatihan_sertifikat->mulai            = $validateData['mulai_pelatihan'];
        $pelatihan_sertifikat->akhir            = $validateData['akhir_pelatihan'];
        $pelatihan_sertifikat->save();

        $pengalaman_kerja = new pengalaman_kerja();
        $pengalaman_kerja->data_pribadis_id = $request->id;
        $pengalaman_kerja->nama_perusahaan  = $validateData['nama_perusahaan'];
        $pengalaman_kerja->jabatan          = $validateData['jabatan'];
        $pengalaman_kerja->mulai            = $validateData['mulai_kerja'];
        $pengalaman_kerja->akhir            = $validateData['akhir_kerja'];
        $pengalaman_kerja->gaji             = $validateData['gaji'];
        $pengalaman_kerja->alasan_keluar    = $validateData['alasan_keluar'];
        $pengalaman_kerja->save();

        $bahasa_asing = new bahasa_asing();
        $bahasa_asing->data_pribadis_id = $request->id;
        $bahasa_asing->lisan            = $validateData['lisan'];
        $bahasa_asing->tulisan          = $validateData['tulisan'];
        $bahasa_asing->save();

        Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
        return redirect()->back();   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_karyawan $data_karyawan)
    {
        //
    }
}
