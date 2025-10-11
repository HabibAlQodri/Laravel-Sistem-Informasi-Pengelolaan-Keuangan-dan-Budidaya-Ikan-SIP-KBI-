import React, { useState } from "react";
import LayoutKaryawan from "@/layouts/LayoutKaryawan";

const Keuangan: React.FC = () => {
  const [showForm, setShowForm] = useState(false);

  return (
    <LayoutKaryawan>
      <div className="p-8 bg-white min-h-screen">
        {/* Header */}
        <div className="flex justify-between items-center mb-8">
          <div>
            <h1 className="text-2xl font-bold text-gray-900">Keuangan</h1>
            <p className="text-gray-500">
              Catat pendapatan dan pengeluaran harian
            </p>
          </div>
          <button
            onClick={() => setShowForm(!showForm)}
            className="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition"
          >
            {showForm ? "Tutup Form" : "+ Tambah Transaksi"}
          </button>
        </div>

        {/* Jika tombol ditekan, form tampil */}
        {showForm && (
            <div className="border rounded-xl p-8 mb-8 shadow-sm">
                <h2 className="text-2xl font-bold text-gray-900 mb-6 text-center">
                Tambahkan Data
                </h2>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {/* Input tanggal & waktu */}
                <div>
                    <label className="block text-gray-700 font-medium mb-1">
                    Tanggal & Waktu
                    </label>
                    <input
                        type="datetime-local"
                        className="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-blue-500"
                        />

                </div>

                <div>
                    <label className="block text-gray-700 font-medium mb-1">Tipe</label>
                    <select className="w-full border rounded-lg px-3 py-2 bg-gray-100 focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih tipe</option>
                    <option value="masuk">Uang Masuk</option>
                    <option value="keluar">Uang Keluar</option>
                    </select>
                </div>

                <div>
                    <label className="block text-gray-700 font-medium mb-1">Jumlah</label>
                    <input
                    type="number"
                    placeholder="1.000.000"
                    className="w-full border rounded-lg px-3 py-2 bg-gray-100 focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <div>
                    <label className="block text-gray-700 font-medium mb-1">
                    Keterangan
                    </label>
                    <input
                    type="text"
                    placeholder="Pendapatan Bulan Feb"
                    className="w-full border rounded-lg px-3 py-2 bg-gray-100 focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                </div>

                {/* Tombol simpan & batal */}
                <div className="flex justify-center gap-4">
                <button className="bg-green-500 text-white font-medium px-6 py-2 rounded-lg hover:bg-green-600 transition">
                    Simpan
                </button>
                <button
                    onClick={() => setShowForm(false)}
                    className="bg-gray-200 text-gray-700 font-medium px-6 py-2 rounded-lg hover:bg-gray-300 transition"
                >
                    Batal
                </button>
                </div>
            </div>
            )}


        {/* Statistik Keuangan */}
        <div className="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
          <div className="border rounded-xl p-6 shadow-sm">
            <p className="text-gray-600 text-sm mb-2">Total Pendapatan</p>
            <h2 className="text-green-600 text-3xl font-bold">Rp. 20.539.000</h2>
          </div>

          <div className="border rounded-xl p-6 shadow-sm">
            <p className="text-gray-600 text-sm mb-2">Total Pengeluaran</p>
            <h2 className="text-red-600 text-3xl font-bold">Rp. 1.598.000</h2>
          </div>

          <div className="border rounded-xl p-6 shadow-sm">
            <p className="text-gray-600 text-sm mb-2">Saldo</p>
            <h2 className="text-green-600 text-3xl font-bold">Rp. 23.941.000</h2>
          </div>
        </div>

        {/* Riwayat Transaksi */}
        <div className="border rounded-xl p-6 shadow-sm">
          <h2 className="text-xl font-semibold text-gray-900 mb-2">
            Riwayat Transaksi
          </h2>
          <p className="text-gray-500 mb-4">Entri Keuangan Terbaru</p>

          <div className="space-y-4 border rounded-lg p-4">
            <div className="flex items-center">
              <span className="bg-green-600 text-white text-sm px-2 py-1 rounded mr-3">
                Uang Masuk
              </span>
              <p className="text-gray-800">
                Penjualan di Bulan Januari :{" "}
                <span className="font-semibold">Rp. 2.000.000</span>
              </p>
            </div>

            <div className="flex items-center">
              <span className="bg-red-600 text-white text-sm px-2 py-1 rounded mr-3">
                Uang Keluar
              </span>
              <p className="text-gray-800">
                Pembelian Pakan Ikan :{" "}
                <span className="font-semibold">Rp. 2.000.000</span>
              </p>
            </div>

            <div className="flex items-center">
              <span className="bg-green-600 text-white text-sm px-2 py-1 rounded mr-3">
                Uang Masuk
              </span>
              <p className="text-gray-800">
                Penjualan di Bulan Januari :{" "}
                <span className="font-semibold">Rp. 2.000.000</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </LayoutKaryawan>
  );
};

export default Keuangan;
