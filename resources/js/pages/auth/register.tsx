import React from 'react';

export default function Register() {
  return (
    <div className="flex items-center justify-center min-h-screen bg-gray-100">
      <div className="bg-white shadow-md rounded-2xl p-8 w-full max-w-md">
        <h2 className="text-2xl text-black font-semibold text-center mb-2">Selamat Datang</h2>
        <p className="text-gray-500 text-center mb-6">
          Silahkan daftarkan akun SIP-KIB anda!
        </p>

        <form>
          <div className="mb-4">
            <label className="block text-sm font-medium text-gray-700 mb-1">
              Nama
            </label>
            <input
              type="text"
              placeholder="Masukkan nama anda"
              className="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white 
                            placeholder-gray-500 text-gray-800 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
          </div>

          <div className="mb-4">
            <label className="block text-sm font-medium text-gray-700 mb-1">
              Email
            </label>
            <input
              type="email"
              placeholder="Masukkan email anda"
              className="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white 
                            placeholder-gray-500 text-gray-800 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
          </div>

          <div className="mb-4">
            <label className="block text-sm font-medium text-gray-700 mb-1">
              Username
            </label>
            <input
              type="text"
              placeholder="Masukkan username anda"
              className="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white 
                            placeholder-gray-500 text-gray-800 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
          </div>

          <div className="mb-6">
            <label className="block text-sm font-medium text-gray-700 mb-1">
              Password
            </label>
            <input
              type="password"
              placeholder="Masukkan setidaknya 8 karakter"
              className="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white 
                            placeholder-gray-500 text-gray-800 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
          </div>

          <button
            type="submit"
            className="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition"
          >
            Buat Akun
          </button>
        </form>

        <p className="text-center text-sm text-gray-600 mt-4">
          Sudah punya akun?{' '}
          <a href="/login" className="text-blue-600 font-medium hover:underline">
            Masuk disini
          </a>
        </p>
      </div>
    </div>
  );
}
