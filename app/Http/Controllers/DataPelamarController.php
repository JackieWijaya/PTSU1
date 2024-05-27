<?php

namespace App\Http\Controllers;

use App\Models\data_pelamar;
use App\Models\data_pribadi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\New_;
use RealRashid\SweetAlert\Facades\Alert;

class DataPelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $data_pribadis = data_pribadi::all();
        // Ambil semua data pribadi yang tidak memiliki role 'HRD' langsung dari database
        $data_pribadis = data_pribadi::all();
        // dd($data_pribadis);

        return view('data_pelamar.index')->with('data_pribadis', $data_pribadis);

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
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_pelamar $data_pelamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // Temukan berdasarkan ID
        $update_status = $request->input('status');
        $data_pribadi = data_pribadi::findOrFail($id);
        $data_pribadi->status = $update_status;
        $data_pribadi->update();

        if($data_pribadi->status == 'Diterima'){
            $user = New User();
            $user->name     = $data_pribadi->nama_lengkap;
            $user->no_hp    = $data_pribadi->no_hp;
            $user->password = $data_pribadi->no_hp;
            $user->save();  

            // Modifikasi nomor WA
            $no_hp = $user->no_hp;
            // Hapus awalan "08" dan tambahkan kode negara "+62"
            $no_hp = "+62".substr($no_hp, 1);

            $pesan = "Selamat $data_pribadi->nama_lengkap, anda diterima di PT Sumatra Unggul. Silahkan login melalui link http://127.0.0.1:8000/ untuk melengkapi data. Berikut No HP: $data_pribadi->no_hp dan Password: $data_pribadi->no_hp anda untuk login. Terima Kasih";

            $url = "https://api.whatsapp.com/send?phone=".$no_hp."&text=".urlencode($pesan);
            
            // Redirect to WhatsApp with the message
            return redirect()->away($url);
        }

        return redirect()->route('data_pelamar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_pelamar $data_pelamar)
    {
        //
    }
}
