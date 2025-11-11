<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
    // Ambil data ringkasan untuk dashboard
    $totalPanen = DB::table('panen')->sum('berat_total_kg');
    $totalPenjualan = DB::table('penjualan')->sum('total_jual');
    $totalPendapatan = DB::table('laporan_keuangan')->sum('total_pendapatan');
    $totalPengeluaran = DB::table('laporan_keuangan')->sum('total_pengeluaran');
    $labaBersih = DB::table('laporan_keuangan')->sum('laba_bersih');

    return view('user.dashboard', compact('totalPanen','totalPenjualan','totalPendapatan','totalPengeluaran','labaBersih'));
    }
}
