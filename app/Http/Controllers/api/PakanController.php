<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PakanController extends Controller
{
    public function index()
    {
        try {
            $pakan = Pakan::all();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $pakan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading pakan: ' . $e->getMessage());

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
                'nama_pakan' => 'required|string|max:255',
                'jenis_pakan' => 'required|string|max:255',
                'harga_per_kg' => 'required|numeric|min:0',
                'stok_kg' => 'required|numeric|min:0',
                'supplier' => 'required|string|max:255'
            ]);

            $pakan = Pakan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $pakan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pakan = Pakan::findOrFail($id);

            $validated = $request->validate([
                'nama_pakan' => 'required|string|max:255',
                'jenis_pakan' => 'required|string|max:255',
                'harga_per_kg' => 'required|numeric|min:0',
                'stok_kg' => 'required|numeric|min:0',
                'supplier' => 'required|string|max:255'
            ]);

            $pakan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $pakan
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
            Log::error('Error updating pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pakan = Pakan::findOrFail($id);
            $pakan->delete();

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
            Log::error('Error deleting pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
