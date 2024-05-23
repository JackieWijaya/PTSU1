<?php

namespace App\Http\Controllers;

use App\Models\data_keluarga_inti;
use App\Models\data_pribadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataKeluargaIntiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $data_keluarga_inti_status = data_keluarga_inti::where('data_pribadis_id', $data_pribadi->id)->first();
        $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($data_keluarga_inti);
        return view('data_karyawan.data_keluarga_inti')->with('data_pribadi', $data_pribadi)->with('data_keluarga_inti_status', $data_keluarga_inti_status)->with('data_keluarga_inti', $data_keluarga_inti);
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
        $status_isi = $request->input('status_isi');
        if($status_isi == '1'){
            $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $request->id)->get();
            // Loop melalui setiap entri dan perbarui status_isi
            foreach ($data_keluarga_inti as $data) {
                $data->status_isi = $status_isi;
                $data->update();
            }
            return redirect('data_keluarga_kandung');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nik_inti'                   => 'required|numeric|gt:-1',
                'status_keluarga_inti'       => 'required',
                'nama_anggota_keluarga_inti' => 'required',
                'ktp_pasangan'               => 'image|max:800|mimes:jpg,jpeg,png',
                'tempat_lahir_inti'          => 'required',
                'tanggal_lahir_inti'         => 'required',
                'pendidikan_inti'            => 'required',
                'pekerjaan_inti'             => 'required'
            ],
            [
                'nik_inti.required'                   => 'NIK Harus Diisi',
                'nik_inti.numeric'                    => 'NIK Harus Angka',
                'nik_inti.gt'                         => 'NIK Tidak Boleh Min',
                'status_keluarga_inti.required'       => 'Pilih Status Keluarga',
                'nama_anggota_keluarga_inti.required' => 'Nama Anggota Keluarga Harus Diisi',
                'ktp_pasangan.image'                  => 'File Harus Foto',   
                'ktp_pasangan.mimes'                  => 'Format Harus .jpg/.jpeg/.png',
                'ktp_pasangan.max'                    => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
                'tempat_lahir_inti.required'          => 'Tempat Lahir Harus Diisi',
                'tanggal_lahir_inti.required'         => 'Tanggal Lahir Harus Diisi',
                'pendidikan_inti.required'            => 'Pilih Pendidikan',
                'pekerjaan_inti.required'             => 'Pekerjaan Harus Diisi'
            ]);

            $ktp_pasangan = '-';
            if($request->hasFile('ktp_pasangan')){
                $extktppasangan = $request->ktp_pasangan->getClientOriginalExtension();
                $ktp_pasangan = "ktp_pasangan-".time().".".$extktppasangan;
                $request->ktp_pasangan->storeAs('public/DataKaryawan',$ktp_pasangan);
            }

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
            $data_keluarga_inti->status_isi            = $status_isi;
            $data_keluarga_inti->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect()->route('data_keluarga_inti.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(data_keluarga_inti $data_keluarga_inti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_keluarga_inti $data_keluarga_inti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, data_keluarga_inti $data_keluarga_inti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_keluarga_inti $data_keluarga_inti)
    {
        //
    }
}
