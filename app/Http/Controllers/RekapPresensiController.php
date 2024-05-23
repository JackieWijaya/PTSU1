<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\data_pribadi;
use App\Models\pengaturan_presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RekapPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = now()->toDateString(); // Mengambil tanggal hari ini dalam format Y-m-d
        $bulanini = date('m') * 1;
        $tahunini = date('Y');

        $presensisblnini = Presensi::whereYear('created_at', $tahunini)
                     ->whereMonth('created_at', $bulanini)
                     ->get();

        $presensis = Presensi::select('nik')
                     ->distinct()
                     ->get();

        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $pengaturan_presensi = pengaturan_presensi::where('id', 1)->first();
        // dd($pengaturan_presensi);

        $jam_terlambat = Carbon::parse($pengaturan_presensi->jam_masuk)->addMinutes(10)->format('H:i:s');
        $terlambat = Presensi::whereYear('created_at', $tahunini)
        ->whereMonth('created_at', $bulanini)
        ->whereTime('created_at', '>', $jam_terlambat)
        ->get();

        return view('presensi.rekap')->with('presensis', $presensis)->with('presensisblnini', $presensisblnini)->with('namabulan', $namabulan)->with('bulanini', $bulanini)->with('tahunini', $tahunini)->with('pengaturan_presensi', $pengaturan_presensi)->with('terlambat', $terlambat);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
