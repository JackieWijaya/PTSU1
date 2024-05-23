<?php

namespace App\Http\Controllers;

use App\Models\pengalaman_kerja;
use App\Models\data_pribadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PengalamanKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $pengalaman_kerja_status = pengalaman_kerja::where('data_pribadis_id', $data_pribadi->id)->first();
        $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($pengalaman_kerja);
        return view('data_karyawan.pengalaman_kerja')->with('data_pribadi', $data_pribadi)->with('pengalaman_kerja_status', $pengalaman_kerja_status)->with('pengalaman_kerja', $pengalaman_kerja);
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
            $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $request->id)->get();
            // Loop melalui setiap entri dan perbarui status_isi
            foreach ($pengalaman_kerja as $data) {
                $data->status_isi = $status_isi;
                $data->update();
            }
            return redirect('bahasa_asing');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nama_perusahaan' => 'required',
                'jabatan'         => 'required',
                'mulai_kerja'     => 'required',
                'akhir_kerja'     => 'required',
                'gaji'            => 'required',
                'alasan_keluar'   => 'required'
            ],
            [
                'nama_perusahaan.required' => 'Nama Perusahaan Harus Diisi',
                'jabatan.required'         => 'Jabatan Harus Diisi',
                'mulai_kerja.required'     => 'Tanggal Mulai Harus Diisi',
                'akhir_kerja.required'     => 'Tanggal Akhir Harus Diisi',
                'gaji.required'            => 'Gaji Harus Diisi',
                'alasan_keluar.required'   => 'Alasan Keluar Harus Diisi'
            ]);

            $pengalaman_kerja = new pengalaman_kerja();
            $pengalaman_kerja->data_pribadis_id = $request->id;
            $pengalaman_kerja->nama_perusahaan  = $validateData['nama_perusahaan'];
            $pengalaman_kerja->jabatan          = $validateData['jabatan'];
            $pengalaman_kerja->mulai            = $validateData['mulai_kerja'];
            $pengalaman_kerja->akhir            = $validateData['akhir_kerja'];
            $pengalaman_kerja->gaji             = $validateData['gaji'];
            $pengalaman_kerja->alasan_keluar    = $validateData['alasan_keluar'];
            $pengalaman_kerja->status_isi       = $status_isi;
            $pengalaman_kerja->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect()->route('pengalaman_kerja.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pengalaman_kerja $pengalaman_kerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengalaman_kerja $pengalaman_kerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengalaman_kerja $pengalaman_kerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengalaman_kerja $pengalaman_kerja)
    {
        //
    }
}
