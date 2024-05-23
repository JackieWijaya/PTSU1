<?php

namespace App\Http\Controllers;

use App\Models\data_pendidikan;
use App\Models\data_pribadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $data_pendidikan_status = data_pendidikan::where('data_pribadis_id', $data_pribadi->id)->first();
        $data_pendidikan = data_pendidikan::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($data_pendidikan);
        return view('data_karyawan.data_pendidikan')->with('data_pribadi', $data_pribadi)->with('data_pendidikan_status', $data_pendidikan_status)->with('data_pendidikan', $data_pendidikan);
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
            $data_pendidikan = data_pendidikan::where('data_pribadis_id', $request->id)->get();
            // Loop melalui setiap entri dan perbarui status_isi
            foreach ($data_pendidikan as $data) {
                $data->status_isi = $status_isi;
                $data->update();
            }
            return redirect('pelatihan_sertifikat');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'jenjang'      => 'required',
                'fakultas'     => 'required',
                'nama_sekolah' => 'required',
                'jurusan'      => 'required',
                'tahun_masuk'  => 'required',
                'tahun_lulus'  => 'required'
            ],
            [
                'jenjang.required'      => 'Pilih Jenjang',
                'fakultas.required'     => 'Fakultas Harus Diisi',
                'nama_sekolah.required' => 'Nama Sekolah Harus Diisi',
                'jurusan.required'      => 'Jurusan Harus Diisi',
                'tahun_masuk.required'  => 'Tahun Masuk Harus Diisi',
                'tahun_lulus.required'  => 'Tahun Lulus Harus Diisi'
            ]);

            $data_pendidikan = new data_pendidikan();
            $data_pendidikan->data_pribadis_id = $request->id;
            $data_pendidikan->jenjang          = $validateData['jenjang'];
            $data_pendidikan->fakultas         = $validateData['fakultas'];
            $data_pendidikan->nama_sekolah     = $validateData['nama_sekolah'];
            $data_pendidikan->jurusan          = $validateData['jurusan'];
            $data_pendidikan->tahun_masuk      = $validateData['tahun_masuk'];
            $data_pendidikan->tahun_lulus      = $validateData['tahun_lulus'];
            $data_pendidikan->status_isi       = $status_isi;
            $data_pendidikan->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect()->route('data_pendidikan.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(data_pendidikan $data_pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_pendidikan $data_pendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, data_pendidikan $data_pendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_pendidikan $data_pendidikan)
    {
        //
    }
}
