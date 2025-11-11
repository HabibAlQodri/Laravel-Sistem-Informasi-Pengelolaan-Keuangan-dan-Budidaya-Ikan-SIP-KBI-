<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisIkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JenisIkanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = jenisIkan::query();

            // Perbaikan fitur search dengan grouping WHERE
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_ikan', 'like', "%{$search}%")
                      ->orWhere('masa_panen_hari', 'like', "%{$search}%")
                      ->orWhere('berat', 'like', "%{$search}%")
                      ->orWhere('harga_per_kg', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan berat jika ada
            if ($request->has('berat') && !empty($request->berat)) {
                $query->where('berat', $request->berat);
            }

            // Filter berdasarkan harga jika ada
            if ($request->has('harga_per_kg') && !empty($request->harga_per_kg)) {
                $query->where('harga_per_kg', $request->harga_per_kg);
            }

            $jenisIkan = $query->orderBy('id', 'desc')->get();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil dimuat',
                    'data' => $jenisIkan,
                    'total' => $jenisIkan->count()
                ], 200);
            }

        } catch (\Exception $e) {
            Log::error('Error loading kolam: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memuat data: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal memuat data Jenis Ikan');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_ikan' => 'required|string|max:255',
                'berat' => 'required|numeric|min:0',
                'masa_panen_hari' => 'required|integer|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            $jenisIkan = JenisIkan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $jenisIkan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing jenis ikan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $jenisIkan = JenisIkan::findOrFail($id);

            $validated = $request->validate([
                'nama_ikan' => 'required|string|max:255',
                'berat' => 'required|numeric|min:0',
                'masa_panen_hari' => 'required|integer|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            $jenisIkan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $jenisIkan
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
            Log::error('Error updating jenis ikan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jenisIkan = JenisIkan::findOrFail($id);
            $jenisIkan->delete();

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
            Log::error('Error deleting jenis ikan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
