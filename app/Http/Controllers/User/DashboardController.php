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

        // Data untuk chart - Laporan Keuangan 6 bulan terakhir
        $laporanKeuangan = DB::table('laporan_keuangan')
            ->select('bulan', 'total_pendapatan', 'total_pengeluaran', 'laba_bersih')
            ->orderBy('bulan', 'desc')
            ->limit(6)
            ->get()
            ->reverse()
            ->values();

        // Data kolam aktif vs nonaktif
        $kolamAktif = DB::table('kolam')->where('status', 'aktif')->count();
        $kolamNonaktif = DB::table('kolam')->where('status', 'nonaktif')->count();

        // Top 5 jenis ikan berdasarkan total panen
        $topIkan = DB::table('panen')
            ->join('jenis_ikan', 'panen.jenis_id', '=', 'jenis_ikan.id')
            ->select('jenis_ikan.nama_ikan', DB::raw('SUM(panen.berat_total_kg) as total_berat'))
            ->groupBy('jenis_ikan.id', 'jenis_ikan.nama_ikan')
            ->orderBy('total_berat', 'desc')
            ->limit(5)
            ->get();

        // Panen terbaru
        $panenTerbaru = DB::table('panen')
            ->join('kolam', 'panen.kolam_id', '=', 'kolam.id')
            ->join('jenis_ikan', 'panen.jenis_id', '=', 'jenis_ikan.id')
            ->select('panen.tanggal_panen', 'panen.berat_total_kg', 'panen.jumlah_ikan', 'panen.total_pendapatan', 'kolam.nama_kolam', 'jenis_ikan.nama_ikan')
            ->orderBy('panen.tanggal_panen', 'desc')
            ->limit(5)
            ->get();

        return view('user.dashboard', compact(
            'totalPanen',
            'totalPenjualan',
            'totalPendapatan',
            'totalPengeluaran',
            'labaBersih',
            'laporanKeuangan',
            'kolamAktif',
            'kolamNonaktif',
            'topIkan',
            'panenTerbaru'
        ));
    }
}
