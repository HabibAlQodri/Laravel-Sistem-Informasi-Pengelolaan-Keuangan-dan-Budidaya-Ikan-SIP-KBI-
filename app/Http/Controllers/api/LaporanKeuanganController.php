<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        try {
            $laporanKeuangan = LaporanKeuangan::orderBy('bulan', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $laporanKeuangan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'bulan' => 'required|date',
                'total_pendapatan' => 'required|numeric|min:0',
                'total_pengeluaran' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            // Hitung laba bersih otomatis
            $validated['laba_bersih'] = $validated['total_pendapatan'] - $validated['total_pengeluaran'];

            $laporanKeuangan = LaporanKeuangan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $laporanKeuangan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $laporanKeuangan = LaporanKeuangan::findOrFail($id);

            $validated = $request->validate([
                'bulan' => 'required|date',
                'total_pendapatan' => 'required|numeric|min:0',
                'total_pengeluaran' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            // Hitung laba bersih otomatis
            $validated['laba_bersih'] = $validated['total_pendapatan'] - $validated['total_pengeluaran'];

            $laporanKeuangan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $laporanKeuangan
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error updating laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $laporanKeuangan = LaporanKeuangan::findOrFail($id);
            $laporanKeuangan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error deleting laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
