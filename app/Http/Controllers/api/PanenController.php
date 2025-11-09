<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Panen;
use App\Models\Kolam;
use App\Models\JenisIkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PanenController extends Controller
{
    public function index()
    {
        try {
            $panen = Panen::with(['kolam', 'jenisIkan'])->orderBy('tanggal_panen', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $panen
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading panen: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOptions()
    {
        try {
            $kolam = Kolam::select('id', 'nama_kolam')->where('status', 'aktif')->get();
            $jenisIkan = JenisIkan::select('id', 'nama_ikan', 'harga_per_kg')->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'kolam' => $kolam,
                    'jenisIkan' => $jenisIkan
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
                'kolam_id' => 'required|exists:kolam,id',
                'jenis_id' => 'required|exists:jenis_ikan,id',
                'tanggal_panen' => 'required|date',
                'berat_total_kg' => 'required|numeric|min:0',
                'jumlah_ikan' => 'required|integer|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            // Hitung total pendapatan otomatis
            $validated['total_pendapatan'] = $validated['berat_total_kg'] * $validated['harga_per_kg'];

            $panen = Panen::create($validated);
            $panen->load(['kolam', 'jenisIkan']);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $panen
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing panen: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $panen = Panen::findOrFail($id);

            $validated = $request->validate([
                'kolam_id' => 'required|exists:kolam,id',
                'jenis_id' => 'required|exists:jenis_ikan,id',
                'tanggal_panen' => 'required|date',
                'berat_total_kg' => 'required|numeric|min:0',
                'jumlah_ikan' => 'required|integer|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            // Hitung total pendapatan otomatis
            $validated['total_pendapatan'] = $validated['berat_total_kg'] * $validated['harga_per_kg'];

            $panen->update($validated);
            $panen->load(['kolam', 'jenisIkan']);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $panen
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
            Log::error('Error updating panen: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $panen = Panen::findOrFail($id);
            $panen->delete();

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
            Log::error('Error deleting panen: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
