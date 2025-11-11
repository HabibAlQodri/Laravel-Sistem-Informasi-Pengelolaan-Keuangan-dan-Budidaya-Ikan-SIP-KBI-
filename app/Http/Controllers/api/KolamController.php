<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KolamController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Kolam::query();

            // Perbaikan fitur search dengan grouping WHERE
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_kolam', 'like', "%{$search}%")
                      ->orWhere('lokasi', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan status jika ada
            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', $request->status);
            }

            $kolam = $query->orderBy('id', 'desc')->get();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil dimuat',
                    'data' => $kolam,
                    'total' => $kolam->count()
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

            return back()->with('error', 'Gagal memuat data kolam');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kolam' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'luas_m2' => 'required|numeric|min:0',
                'kapasitas_ikan' => 'required|integer|min:0',
                'status' => 'required|in:aktif,nonaktif'
            ]);

            $kolam = Kolam::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $kolam
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing kolam: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kolam = Kolam::findOrFail($id);

            $validated = $request->validate([
                'nama_kolam' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'luas_m2' => 'required|numeric|min:0',
                'kapasitas_ikan' => 'required|integer|min:0',
                'status' => 'required|in:aktif,nonaktif'
            ]);

            $kolam->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $kolam
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
            Log::error('Error updating kolam: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kolam = Kolam::findOrFail($id);
            $kolam->delete();

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
            Log::error('Error deleting kolam: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}