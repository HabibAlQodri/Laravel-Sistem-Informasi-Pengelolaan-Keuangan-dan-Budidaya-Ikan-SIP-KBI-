<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BiayaOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BiayaOperasionalController extends Controller
{
    public function index()
    {
        try {
            $biayaOperasional = BiayaOperasional::orderBy('bulan', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $biayaOperasional
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading biaya operasional: ' . $e->getMessage());

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
                'bulan' => 'required|date', // ✅ BENAR
                'listrik' => 'required|numeric|min:0',
                'air' => 'required|numeric|min:0',
                'transportasi' => 'required|numeric|min:0',
                'lainnya' => 'required|numeric|min:0'
            ]);

            // Hitung total biaya otomatis
            $validated['total_biaya'] = $validated['listrik'] +
                                        $validated['air'] +
                                        $validated['transportasi'] +
                                        $validated['lainnya'];

            $biayaOperasional = BiayaOperasional::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $biayaOperasional
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing biaya operasional: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $biayaOperasional = BiayaOperasional::findOrFail($id);

            $validated = $request->validate([
                'bulan' => 'required|date',
                'listrik' => 'required|numeric|min:0',
                'air' => 'required|numeric|min:0',
                'transportasi' => 'required|numeric|min:0',
                'lainnya' => 'required|numeric|min:0'
            ]);

            // Hitung total biaya otomatis
            $validated['total_biaya'] = $validated['listrik'] +
                                        $validated['air'] +
                                        $validated['transportasi'] +
                                        $validated['lainnya'];

            $biayaOperasional->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $biayaOperasional
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
            Log::error('Error updating biaya operasional: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $biayaOperasional = BiayaOperasional::findOrFail($id);
            $biayaOperasional->delete();

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
            Log::error('Error deleting biaya operasional: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
