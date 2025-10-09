import React from "react";
import { Link } from "@inertiajs/react";

export default function Welcome() {
  return (
    <div className="min-h-screen flex flex-col bg-gray-50 text-gray-800">
      {/* Navbar */}
      <header className="flex justify-between items-center px-8 py-4 bg-white shadow">
        <h1 className="text-2xl font-bold text-blue-700 tracking-wide">SIP-KIB</h1>

        <div className="space-x-4">
          <Link
            href="/login"
            className="px-4 py-2 text-sm font-medium text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition"
          >
            Login
          </Link>
          <Link
            href="/register"
            className="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition"
          >
            Register
          </Link>
        </div>
      </header>

      {/* Main Content */}
      <main className="flex flex-col items-center justify-center flex-grow text-center px-4">
        <h2 className="text-4xl font-bold mb-4">Selamat Datang di SIP-KIB</h2>
        <p className="text-lg text-gray-600 max-w-2xl">
          Sistem Informasi Pengelolaan Data Keuangan dan Hasil Budidaya Ikan.
          <br />
          Kelola data hasil budidaya dan keuangan usaha perikanan anda secara
          efisien dan mudah dalam satu platform terintegrasi.
        </p>
      </main>

      {/* Footer */}
      <footer className="bg-white border-t py-4 text-center text-gray-500 text-sm">
        &copy; {new Date().getFullYear()} SIP-KIB. Semua hak dilindungi.
      </footer>
    </div>
  );
}
