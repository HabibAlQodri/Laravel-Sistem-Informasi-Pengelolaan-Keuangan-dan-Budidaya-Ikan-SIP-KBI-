import React, { useState } from "react";
import LayoutKaryawan from "@/layouts/LayoutKaryawan";

const Kolam: React.FC = () => {
  const [showForm, setShowForm] = useState(false);

  return (
    <LayoutKaryawan>
      <div className="p-8 bg-white min-h-screen">
        {/* Header */}
        <div className="flex justify-between items-center mb-8">
          <div>
            <h1 className="text-2xl font-bold text-gray-900">Kolam & Pakan</h1>
            <p className="text-gray-500">
              Lacak data ikan dan aktivitas sehari-hari
            </p>
          </div>
          <button
            onClick={() => setShowForm(!showForm)}
            className={`${
              showForm
                ? "bg-red-500 hover:bg-red-600"
                : "bg-blue-600 hover:bg-blue-700"
            } text-white px-4 py-2 rounded-lg shadow transition`}
          >
            {showForm ? "Tutup Form" : "+ Tambah Aktivitas"}
          </button>
        </div>

        {/* Form Tambah Data */}
        {showForm && (
          <div className="border rounded-xl p-8 mb-8 shadow-sm">
            <h2 className="text-2xl font-semibold text-gray-900 mb-6 text-center">
              Tambahkan Data
            </h2>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
              {/* Tanggal */}
              <div>
                <label className="block text-gray-700 font-medium mb-1">
                  Tanggal
                </label>
                <input
                  type="date"
                  className="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-blue-500"
                />
              </div>

              {/* Tipe */}
              <div>
                <label className="block text-gray-700 font-medium mb-1">Tipe</label>
                <select className="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-blue-500">
                  <option value="">Pilih tipe</option>
                  <option value="pemberian-pakan">Pemberian Pakan</option>
                  <option value="panen">Panen</option>
                  <option value="penggantian-air">Penggantian Air</option>
                </select>
              </div>

              {/* Spesies */}
              <div>
                <label className="block text-gray-700 font-medium mb-1">
                  Spesies
                </label>
                <input
                  type="text"
                  placeholder="Nila / Mas / Dll"
                  className="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-blue-500"
                />
              </div>

              {/* Kuantitas */}
              <div>
                <label className="block text-gray-700 font-medium mb-1">
                  Kuantitas
                </label>
                <div className="flex items-center border rounded-lg bg-gray-100">
                  <input
                    type="number"
                    placeholder="0"
                    className="flex-1 px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-blue-500 rounded-l-lg"
                  />
                  <span className="px-3 py-2 bg-gray-200 text-gray-600 rounded-r-lg">
                    Kg/g
                  </span>
                </div>
              </div>
            </div>

            {/* Tombol Simpan dan Batal */}
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

        {/* Statistik Kolam */}
        <div className="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
          <div className="border rounded-xl p-6 shadow-sm">
            <p className="text-gray-600 text-sm mb-2">Total Stok</p>
            <h2 className="text-green-600 text-3xl font-bold">539</h2>
          </div>

          <div className="border rounded-xl p-6 shadow-sm">
            <p className="text-gray-600 text-sm mb-2">Pemberian Pakan</p>
            <h2 className="text-red-600 text-3xl font-bold">1.598 kg</h2>
          </div>

          <div className="border rounded-xl p-6 shadow-sm">
            <p className="text-gray-600 text-sm mb-2">Kematian</p>
            <h2 className="text-red-600 text-3xl font-bold">3</h2>
          </div>

          <div className="border rounded-xl p-6 shadow-sm">
            <p className="text-gray-600 text-sm mb-2">Total Panen</p>
            <h2 className="text-green-600 text-3xl font-bold">490 kg</h2>
          </div>
        </div>

        {/* Riwayat Aktivitas */}
        <div className="border rounded-xl p-6 shadow-sm">
          <h2 className="text-xl font-semibold text-gray-900 mb-2">
            Riwayat Aktivitas
          </h2>
          <p className="text-gray-500 mb-4">Entri Aktivitas Terbaru</p>
          <div className="border rounded-lg p-4 text-gray-600 italic text-center">
            Belum ada aktivitas terbaru.
          </div>
        </div>
      </div>
    </LayoutKaryawan>
  );
};

export default Kolam;
