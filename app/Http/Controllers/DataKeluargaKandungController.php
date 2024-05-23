<?php

namespace App\Http\Controllers;

use App\Models\data_keluarga_kandung;
use App\Models\data_pribadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataKeluargaKandungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $data_keluarga_kandung_status = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi->id)->first();
        $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($data_keluarga_kandung);
        return view('data_karyawan.data_keluarga_kandung')->with('data_pribadi', $data_pribadi)->with('data_keluarga_kandung_status', $data_keluarga_kandung_status)->with('data_keluarga_kandung', $data_keluarga_kandung);
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
            $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $request->id)->get();
            // Loop melalui setiap entri dan perbarui status_isi
            foreach ($data_keluarga_kandung as $data) {
                $data->status_isi = $status_isi;
                $data->update();
            }
            return redirect('data_pendidikan');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'status_keluarga_kandung'       => 'required',
                'nama_anggota_keluarga_kandung' => 'required',
                'jenis_kelamin_kandung'         => 'required',
                'tempat_lahir_kandung'          => 'required',
                'tanggal_lahir_kandung'         => 'required',
                'pendidikan_kandung'            => 'required',
                'pekerjaan_kandung'             => 'required'
            ],
            [
                'status_keluarga_kandung.required'       => 'Pilih Status Keluarga',
                'nama_anggota_keluarga_kandung.required' => 'Nama Anggota Keluarga Harus Diisi',
                'jenis_kelamin_kandung.required'         => 'Pilih Jenis Kelamin',
                'tempat_lahir_kandung.required'          => 'Tempat Lahir Harus Diisi',
                'tanggal_lahir_kandung.required'         => 'Tanggal Lahir Harus Diisi',
                'pendidikan_kandung.required'            => 'Pilih Pendidikan',
                'pekerjaan_kandung.required'             => 'Pekerjaan Harus Diisi'
            ]);

            $data_keluarga_kandung = new data_keluarga_kandung();
            $data_keluarga_kandung->data_pribadis_id      = $request->id;
            $data_keluarga_kandung->status_keluarga       = $validateData['status_keluarga_kandung'];
            $data_keluarga_kandung->nama_anggota_keluarga = $validateData['nama_anggota_keluarga_kandung'];
            $data_keluarga_kandung->jenis_kelamin         = $validateData['jenis_kelamin_kandung'];
            $data_keluarga_kandung->tempat_lahir          = $validateData['tempat_lahir_kandung'];
            $data_keluarga_kandung->tanggal_lahir         = $validateData['tanggal_lahir_kandung'];
            $data_keluarga_kandung->pendidikan            = $validateData['pendidikan_kandung'];
            $data_keluarga_kandung->pekerjaan             = $validateData['pekerjaan_kandung'];
            $data_keluarga_kandung->status_isi            = $status_isi;
            $data_keluarga_kandung->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect()->route('data_keluarga_kandung.index');
        }    
    }

    /**
     * Display the specified resource.
     */
    public function show(data_keluarga_kandung $data_keluarga_kandung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_keluarga_kandung $data_keluarga_kandung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, data_keluarga_kandung $data_keluarga_kandung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_keluarga_kandung $data_keluarga_kandung)
    {
        //
    }
}
