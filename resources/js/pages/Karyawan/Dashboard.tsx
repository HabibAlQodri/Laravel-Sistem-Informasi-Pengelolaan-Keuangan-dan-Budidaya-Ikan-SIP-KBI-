import React from "react";
import LayoutKaryawan from "@/layouts/LayoutKaryawan";

const Dashboard: React.FC = () => {
  return (
    <LayoutKaryawan>
      <div>
        <h1 className="text-2xl font-bold mb-2">Dashboard Overview</h1>
        <p className="text-gray-500 mb-6">
          Apa yang telah anda lakukan hari ini?
        </p>

        {/* Card ringkasan */}
        <div className="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
          <div className="border rounded-xl p-6 text-center shadow-sm">
            <h3 className="text-gray-600 text-sm mb-2">Pemberian Pakan Hari Ini</h3>
            <p className="text-blue-600 text-3xl font-bold">12</p>
            <p className="text-gray-500 text-sm">Pemberian Pakan Selesai</p>
          </div>
          <div className="border rounded-xl p-6 text-center shadow-sm">
            <h3 className="text-gray-600 text-sm mb-2">Ikan Mati</h3>
            <p className="text-red-600 text-3xl font-bold">3</p>
            <p className="text-gray-500 text-sm">Yang Telah Dilaporkan</p>
          </div>
          <div className="border rounded-xl p-6 text-center shadow-sm">
            <h3 className="text-gray-600 text-sm mb-2">Tugas</h3>
            <p className="text-green-600 text-3xl font-bold">8</p>
            <p className="text-gray-500 text-sm">Tugas yang Belum Selesai</p>
          </div>
        </div>

        {/* Aktivitas terbaru */}
        <div className="border rounded-xl p-6">
          <h2 className="text-lg font-semibold text-gray-900 mb-2">
            Aktivitas Terbaru
          </h2>
          <p className="text-gray-500 mb-4">Terimakasih atas kerja keras anda!</p>

          {[1, 2, 3, 4].map((i) => (
            <div
              key={i}
              className="flex items-center py-2 border-b last:border-b-0"
            >
              <div className="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
              <div>
                <p className="text-gray-800 font-medium">
                  Pemberian pakan ikan
                </p>
                <p className="text-gray-500 text-sm">1 jam yang lalu</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </LayoutKaryawan>
  );
};

export default Dashboard;
