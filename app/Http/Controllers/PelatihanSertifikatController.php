<?php

namespace App\Http\Controllers;

use App\Models\pelatihan_sertifikat;
use App\Models\data_pribadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PelatihanSertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $pelatihan_sertifikat_status = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi->id)->first();
        $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($pelatihan_sertifikat);
        return view('data_karyawan.pelatihan_sertifikat')->with('data_pribadi', $data_pribadi)->with('pelatihan_sertifikat_status', $pelatihan_sertifikat_status)->with('pelatihan_sertifikat', $pelatihan_sertifikat);
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
            $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $request->id)->get();
            // Loop melalui setiap entri dan perbarui status_isi
            foreach ($pelatihan_sertifikat as $data) {
                $data->status_isi = $status_isi;
                $data->update();
            }
            return redirect('pengalaman_kerja');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nama_lembaga'    => 'required',
                'jenis'           => 'required',
                'mulai_pelatihan' => 'required',
                'akhir_pelatihan' => 'required'
            ],
            [
                'nama_lembaga.required'    => 'Nama Lembaga Harus Diisi',
                'jenis.required'           => 'Jenis Harus Diisi',
                'mulai_pelatihan.required' => 'Tanggal Mulai Harus Diisi',
                'akhir_pelatihan.required' => 'Tanggal Akhir Harus Diisi'
            ]);

            $pelatihan_sertifikat = new pelatihan_sertifikat();
            $pelatihan_sertifikat->data_pribadis_id = $request->id;
            $pelatihan_sertifikat->nama_lembaga     = $validateData['nama_lembaga'];
            $pelatihan_sertifikat->jenis            = $validateData['jenis'];
            $pelatihan_sertifikat->mulai            = $validateData['mulai_pelatihan'];
            $pelatihan_sertifikat->akhir            = $validateData['akhir_pelatihan'];
            $pelatihan_sertifikat->status_isi       = $status_isi;
            $pelatihan_sertifikat->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect()->route('pengalaman_kerja.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pelatihan_sertifikat $pelatihan_sertifikat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pelatihan_sertifikat $pelatihan_sertifikat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pelatihan_sertifikat $pelatihan_sertifikat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pelatihan_sertifikat $pelatihan_sertifikat)
    {
        //
    }
}
