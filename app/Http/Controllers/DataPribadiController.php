<?php

namespace App\Http\Controllers;

use App\Models\data_pribadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class DataPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('data_pribadi.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Set default value for $tanggal_nikah
        $tanggal_nikah = $request->input('tanggal_nikah');

        // Check if the value is empty or '-'
        if(empty($tanggal_nikah) || $tanggal_nikah == '-') {
            $tanggal_nikah = null; // Set to null if empty or '-'
        }

        // 1. Validasi
        $validateData = $request->validate([
            'nama_lengkap'        => 'required', 
            'jenis_kelamin'       => 'required', 
            'tanggal_lahir'       => 'required', 
            'tempat_lahir'        => 'required', 
            'no_hp'               => 'required|numeric|gt:-1',
            'email'               => 'required|email',
            'alamat'              => 'required', 
            'pendidikan_terakhir' => 'required', 
            'agama'               => 'required', 
            'golongan_darah'      => 'required', 
            'status_kawin'        => 'required',
            'buku_nikah'          => 'image|max:800|mimes:jpg,jpeg,png'
        ],
        [
            'nama_lengkap.required'        => 'Nama Harus Diisi',
            'jenis_kelamin.required'       => 'Pilih Jenis Kelamin',
            'tanggal_lahir'                => 'Tanggal Lahir Harus Diisi',
            'tempat_lahir.required'        => 'Tempat Lahir Harus Diisi',
            'no_hp.required'               => 'No HP Harus Diisi',
            'no_hp.numeric'                => 'No HP Harus Angka',
            'email.required'               => 'Email Harus Diisi',
            'email.email'                  => 'Isi Dengan Email',
            'alamat.required'              => 'Alamat Harus Diisi',
            'pendidikan_terakhir.required' => 'Pilih Pendidikan Terakhir',
            'agama.required'               => 'Pilih Agama',
            'golongan_darah.required'      => 'Pilih Golongan Darah',
            'status_kawin.required'        => 'Pilih Status Kawin',
            'buku_nikah.image'             => 'File Harus Foto',   
            'buku_nikah.mimes'             => 'Format Harus .jpg/.jpeg/.png',
            'buku_nikah.max'               => 'Ukuran File Tidak Boleh Lebih Dari 800 KB'
        ]);

        $buku_nikah = '-';
        if($request->hasFile('buku_nikah')){
            $ext = $request->buku_nikah->getClientOriginalExtension();
            $buku_nikah = "buku_nikah-".time().".".$ext;
            $request->buku_nikah->storeAs('public/BukuNikah',$buku_nikah);
        }

        $data_pribadi = new data_pribadi();
        $data_pribadi->nama_lengkap        = $validateData['nama_lengkap'];
        $data_pribadi->jenis_kelamin       = $validateData['jenis_kelamin'];
        $data_pribadi->tanggal_lahir       = $validateData['tanggal_lahir'];
        $data_pribadi->tempat_lahir        = $validateData['tempat_lahir'];
        $data_pribadi->no_hp               = $validateData['no_hp'];
        $data_pribadi->email               = $validateData['email'];
        $data_pribadi->alamat              = $validateData['alamat'];
        $data_pribadi->pendidikan_terakhir = $validateData['pendidikan_terakhir'];
        $data_pribadi->agama               = $validateData['agama'];
        $data_pribadi->golongan_darah      = $validateData['golongan_darah'];
        $data_pribadi->status_kawin        = $validateData['status_kawin'];
        $data_pribadi->tanggal_nikah       = $tanggal_nikah;
        $data_pribadi->buku_nikah          = $buku_nikah;

        // Ambil jumlah data_pribadi berdasarkan no_hp
        $dataCount = data_pribadi::where('no_hp', $validateData['no_hp'])->count();
        // dd($dataCount);

        if ($dataCount > 0) {
            Alert::error('Gagal', "Maaf Kamu Hanya Bisa Mengirim Data Sekali Saja, Silakan Hubungi Pihak IT");
            return view('auth.login');
        } else {
            $data_pribadi->save();
            Alert::success('Data Terkirim', "Terima Kasih Data Kamu Segera Di Proses");
            return view('data_pribadi.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(data_pribadi $data_pribadi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_pribadi $data_pribadi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, data_pribadi $data_pribadi)
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
            'npwp'                 => 'image|max:800|mimes:jpg,jpeg,png'
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
            'npwp.max'                   => 'Ukuran File Tidak Boleh Lebih Dari 800 KB'
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

        $status_isi = $request->input('status_isi');
        // $data_pribadi = data_pribadi::findOrFail($request->id);
        $data_pribadi->ktp                  = $ktp;
        $data_pribadi->rekening             = $rekening;    
        $data_pribadi->sim                  = $sim;
        $data_pribadi->kk                   = $kk;
        $data_pribadi->bpjs_ketenagakerjaan = $bpjs_ketenagakerjaan;
        $data_pribadi->bpjs_kesehatan       = $bpjs_kesehatan;
        $data_pribadi->npwp                 = $npwp;
        $data_pribadi->nik                  = $validateData['nik_pribadi'];
        $data_pribadi->status_isi           = $status_isi;
        $data_pribadi->update();

        if($data_pribadi->status_isi == '1') {
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_keluarga_inti');
        } else {
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect()->route('data_karyawan.index');
            // return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_pribadi $data_pribadi)
    {
        //
    }
}
