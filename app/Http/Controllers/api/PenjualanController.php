<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Panen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    public function index()
    {
        try {
            $penjualan = Penjualan::with('panen')->orderBy('tanggal_jual', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $penjualan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading penjualan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOptions()
    {
        try {
            $panen = Panen::with(['kolam', 'jenisIkan'])
                ->select('id', 'kolam_id', 'jenis_id', 'tanggal_panen', 'berat_total_kg')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'panen' => $panen
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading options: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat options: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'panen_id' => 'required|exists:panen,id',
                'tanggal_jual' => 'required|date',
                'pembeli' => 'required|string|max:255',
                'jumlah_kg' => 'required|numeric|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'metode_bayar' => 'required|string|max:255'
            ]);

            // Hitung total jual otomatis
            $validated['total_jual'] = $validated['jumlah_kg'] * $validated['harga_per_kg'];

            $penjualan = Penjualan::create($validated);
            $penjualan->load('panen');

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $penjualan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing penjualan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $penjualan = Penjualan::findOrFail($id);

            $validated = $request->validate([
                'panen_id' => 'required|exists:panen,id',
                'tanggal_jual' => 'required|date',
                'pembeli' => 'required|string|max:255',
                'jumlah_kg' => 'required|numeric|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'metode_bayar' => 'required|string|max:255'
            ]);

            // Hitung total jual otomatis
            $validated['total_jual'] = $validated['jumlah_kg'] * $validated['harga_per_kg'];

            $penjualan->update($validated);
            $penjualan->load('panen');

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $penjualan
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
            Log::error('Error updating penjualan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $penjualan = Penjualan::findOrFail($id);
            $penjualan->delete();

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
            Log::error('Error deleting penjualan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
