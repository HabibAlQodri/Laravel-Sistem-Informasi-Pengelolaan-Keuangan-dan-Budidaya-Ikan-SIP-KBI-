<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JadwalPakan;
use App\Models\Kolam;
use App\Models\Pakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JadwalPakanController extends Controller
{
    public function index()
    {
        try {
            $jadwalPakan = JadwalPakan::with(['kolam', 'pakan'])->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $jadwalPakan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading jadwal pakan: ' . $e->getMessage());

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
            $pakan = Pakan::select('id', 'nama_pakan')->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'kolam' => $kolam,
                    'pakan' => $pakan
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
                'pakan_id' => 'required|exists:pakan,id',
                'tanggal' => 'required|date',
                'jumlah_kg' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            $jadwalPakan = JadwalPakan::create($validated);
            $jadwalPakan->load(['kolam', 'pakan']);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $jadwalPakan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing jadwal pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $jadwalPakan = JadwalPakan::findOrFail($id);

            $validated = $request->validate([
                'kolam_id' => 'required|exists:kolam,id',
                'pakan_id' => 'required|exists:pakan,id',
                'tanggal' => 'required|date',
                'jumlah_kg' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            $jadwalPakan->update($validated);
            $jadwalPakan->load(['kolam', 'pakan']);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $jadwalPakan
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
            Log::error('Error updating jadwal pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jadwalPakan = JadwalPakan::findOrFail($id);
            $jadwalPakan->delete();

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
            Log::error('Error deleting jadwal pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
