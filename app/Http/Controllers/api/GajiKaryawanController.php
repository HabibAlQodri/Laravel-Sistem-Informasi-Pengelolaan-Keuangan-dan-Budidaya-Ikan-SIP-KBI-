<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GajiKaryawan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GajiKaryawanController extends Controller
{
    public function index()
    {
        try {
            $gajiKaryawan = GajiKaryawan::with('pegawai')->orderBy('bulan', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $gajiKaryawan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading gaji karyawan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOptions()
    {
        try {
            $pegawai = Pegawai::select('id', 'nama', 'gaji_pokok')->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'pegawai' => $pegawai
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
                'pegawai_id' => 'required|exists:pegawai,id',
                'bulan' => 'required|date', // ✅ BENAR
                'jumlah_gaji' => 'required|numeric|min:0',
                'bonus' => 'nullable|numeric|min:0',
                'potongan' => 'nullable|numeric|min:0',
                'status_bayar' => 'required|in:belum,sudah'
            ]);

            // Set default values
            $validated['bonus'] = $validated['bonus'] ?? 0;
            $validated['potongan'] = $validated['potongan'] ?? 0;

            // Hitung total diterima otomatis
            $validated['total_diterima'] = $validated['jumlah_gaji'] +
                                           $validated['bonus'] -
                                           $validated['potongan'];

            $gajiKaryawan = GajiKaryawan::create($validated);
            $gajiKaryawan->load('pegawai');

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $gajiKaryawan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing gaji karyawan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $gajiKaryawan = GajiKaryawan::findOrFail($id);

            $validated = $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'bulan' => 'required|date',
                'jumlah_gaji' => 'required|numeric|min:0',
                'bonus' => 'nullable|numeric|min:0',
                'potongan' => 'nullable|numeric|min:0',
                'status_bayar' => 'required|in:belum,sudah'
            ]);

            // Set default values
            $validated['bonus'] = $validated['bonus'] ?? 0;
            $validated['potongan'] = $validated['potongan'] ?? 0;

            // Hitung total diterima otomatis
            $validated['total_diterima'] = $validated['jumlah_gaji'] +
                                           $validated['bonus'] -
                                           $validated['potongan'];

            $gajiKaryawan->update($validated);
            $gajiKaryawan->load('pegawai');

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $gajiKaryawan
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
            Log::error('Error updating gaji karyawan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $gajiKaryawan = GajiKaryawan::findOrFail($id);
            $gajiKaryawan->delete();

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
            Log::error('Error deleting gaji karyawan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
