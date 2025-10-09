import React from 'react';

export default function Login() {
  return (
    <div className="flex items-center justify-center min-h-screen bg-gray-100">
      <div className="bg-white shadow-md rounded-2xl p-8 w-full max-w-md">
        <h2 className="text-black text-2xl font-semibold text-center mb-2">Selamat Datang</h2>
        <p className="text-gray-500 text-center mb-6">
          Silahkan login dengan akun SIP-KIB
        </p>

        <form>
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                Username
                </label>
                <input
                type="text"
                placeholder="Masukkan Username anda"
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
                placeholder="Masukkan password anda"
                className="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white 
                            placeholder-gray-500 text-gray-800 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
            </div>
          
          <button
            type="submit"
            className="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
          >
            Masuk
          </button>

          <p className='text-gray-500 text-center mt-2'>atau login menggunakan</p>

          <div className='mt-4'>    
            <a
                href="/auth/google/redirect"
                className="w-full flex items-center justify-center gap-2 bg-gray-300 text-white py-2 rounded hover:bg-gray-400"
                >
                <img src="img/google-icon.png" alt="Google" className="w-5 h-5" />
                Google
            </a>
            </div>
        </form>

        <p className="text-center text-sm text-gray-600 mt-4">
          Belum punya akun?{' '}
          <a href="/register" className="text-blue-600 font-medium hover:underline">
            Daftar disini
          </a>
        </p>
      </div>
    </div>
  );
}
