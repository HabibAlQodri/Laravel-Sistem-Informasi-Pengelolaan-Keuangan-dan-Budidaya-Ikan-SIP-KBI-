<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan | SIP-KBI</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'sipkbi-green': '#16a34a',
                        'sipkbi-dark': '#064e3b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">

    <!-- Sidebar + Konten Utama -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col justify-between">
            <div>
                <div class="p-5 flex items-center space-x-3 border-b border-gray-200 dark:border-gray-700">
                    <img src="{{ asset('images/logo-sipkbi.png') }}" class="w-10 h-10" alt="Logo SIP-KBI">
                    <h1 class="font-bold text-lg text-sipkbi-green">SIP-KBI</h1>
                </div>

                <nav class="mt-6">
                    <a href="#" class="flex items-center px-6 py-3 text-sm font-medium hover:bg-sipkbi-green hover:text-white transition">
                        <span class="material-symbols-outlined mr-3">dashboard</span>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 text-sm font-medium bg-sipkbi-green text-white rounded-r-full">
                        <span class="material-symbols-outlined mr-3">payments</span>
                        Kelola Keuangan
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 text-sm font-medium hover:bg-sipkbi-green hover:text-white transition">
                        <span class="material-symbols-outlined mr-3">science</span>
                        Kelola Budidaya
                    </a>
                </nav>
            </div>

            <!-- Tombol Dark Mode -->
            <div class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <button id="theme-toggle" class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">🌞</button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline text-sm bg-transparent border-none cursor-pointer">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4">Kelola Keuangan</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Pantau pendapatan dan pengeluaran harian Anda</p>

            <!-- Kartu Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pendapatan</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">Rp 8.800.000</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pengeluaran</h3>
                    <p class="text-3xl font-bold text-red-500 mt-2">Rp 1.300.000</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Saldo</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">Rp 7.500.000</p>
                </div>
            </div>

            <!-- Form Tambah Transaksi -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md mb-8">
                <h3 class="text-lg font-semibold mb-4">Tambah Transaksi Baru</h3>
                <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm mb-1">Tanggal</label>
                        <input type="date" class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Tipe</label>
                        <select class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none">
                            <option>Pendapatan</option>
                            <option>Pengeluaran</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Kategori</label>
                        <input type="text" placeholder="Contoh: Penjualan Ikan, Pakan, Pemeliharaan..." class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Jumlah (Rp)</label>
                        <input type="number" step="0.01" placeholder="0.00" class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm mb-1">Deskripsi</label>
                        <textarea rows="2" placeholder="Tambahkan detail tentang transaksi ini..." class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none"></textarea>
                    </div>
                    <div class="flex space-x-3 mt-3">
                        <button type="submit" class="bg-sipkbi-green text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Simpan</button>
                        <button type="reset" class="border border-gray-400 dark:border-gray-600 px-4 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition">Batal</button>
                    </div>
                </form>
            </div>

            <!-- Tabel Riwayat Transaksi -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-2 px-3 text-left">Tanggal</th>
                            <th class="py-2 px-3 text-left">Tipe</th>
                            <th class="py-2 px-3 text-left">Kategori</th>
                            <th class="py-2 px-3 text-left">Deskripsi</th>
                            <th class="py-2 px-3 text-right">Jumlah (Rp)</th>
                            <th class="py-2 px-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-2 px-3">09/10/2025</td>
                            <td class="py-2 px-3">Pendapatan</td>
                            <td class="py-2 px-3">Penjualan Ikan</td>
                            <td class="py-2 px-3">Penjualan ikan nila</td>
                            <td class="py-2 px-3 text-right text-green-600">+Rp 1.000.000</td>
                            <td class="py-2 px-3 text-center">
                                <button class="text-blue-500 hover:underline">Edit</button>
                                <button class="text-red-500 hover:underline ml-2">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Dark Mode Script -->
    <script>
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            toggle.textContent = '🌙';
        } else {
            html.classList.remove('dark');
            toggle.textContent = '🌞';
        }

        toggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            toggle.textContent = isDark ? '🌙' : '🌞';
            localStorage.theme = isDark ? 'dark' : 'light';
        });
    </script>
</body>
</html>
