import React from "react";
import { Link, usePage } from "@inertiajs/react";

const LayoutKaryawan: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const { url } = usePage();

  return (
    <div className="flex min-h-screen bg-gray-100 text-gray-900">
      {/* Sidebar */}
      <aside className="w-64 bg-white border-r flex flex-col justify-between">
        {/* Logo dan Navigasi */}
        <div>
          <div className="flex items-center px-6 py-4">
            <div className="w-8 h-8 bg-blue-500 rounded-sm mr-3"></div>
            <h1 className="font-bold text-lg text-gray-800">SIP-KIB</h1>
          </div>

          <nav className="mt-6">
            <Link
              href="/karyawan/dashboard"
              className={`block px-6 py-3 rounded-l-full font-medium ${
                url.startsWith("/karyawan/dashboard")
                  ? "bg-blue-600 text-white"
                  : "text-gray-700 hover:bg-blue-50"
              }`}
            >
              Dashboard
            </Link>

            <Link
              href="/karyawan/keuangan"
              className={`block px-6 py-3 rounded-l-full font-medium ${
                url.startsWith("/karyawan/keuangan")
                  ? "bg-blue-600 text-white"
                  : "text-gray-700 hover:bg-blue-50"
              }`}
            >
              Manajemen Keuangan
            </Link>

            <Link
              href="/karyawan/kolam"
              className={`block px-6 py-3 rounded-l-full font-medium ${
                url.startsWith("/karyawan/kolam")
                  ? "bg-blue-600 text-white"
                  : "text-gray-700 hover:bg-blue-50"
              }`}
            >
              Manajemen Kolam
            </Link>
          </nav>
        </div>

        {/* Profil dan Logout */}
        <div className="border-t p-4">
          <div className="flex items-center space-x-3 mb-3">
            <div className="w-10 h-10 rounded-full bg-gray-300"></div>
            <div>
              <p className="font-medium text-gray-800">Bombardilo Crocodilo</p>
              <p className="text-sm text-gray-500">Karyawan</p>
            </div>
          </div>

          <button className="w-full flex items-center justify-center space-x-2 border rounded-lg py-2 hover:bg-gray-100 transition">
            <span className="text-gray-700 font-medium">⎋ Logout</span>
          </button>
        </div>
      </aside>

      {/* Konten Utama */}
      <div className="flex-1 flex flex-col">
        {/* Navbar atas */}
        <header className="bg-white border-b px-8 py-4">
          <h2 className="font-semibold text-gray-800">
            {url.includes("dashboard")
              ? "Dashboard"
              : url.includes("keuangan")
              ? "Manajemen Keuangan"
              : url.includes("kolam")
              ? "Manajemen Kolam"
              : "Halaman"}
          </h2>
        </header>

        {/* Isi Halaman */}
        <main className="flex-1 p-8 bg-white">{children}</main>
      </div>
    </div>
  );
};

export default LayoutKaryawan;
