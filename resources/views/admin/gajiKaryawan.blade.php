<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaji Karyawan | SIP-KBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <style>
        .modal-transition {
            transition: opacity 0.2s ease-out, transform 0.2s ease-out;
        }
        .modal-hidden {
            opacity: 0;
            transform: scale(0.95);
        }
        .modal-visible {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col justify-between fixed h-full z-50 transform transition-transform duration-300 lg:translate-x-0 -translate-x-full">
            <div class="overflow-y-auto">
                <div class="p-5 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-sipkbi-green rounded-lg flex items-center justify-center text-white font-bold">
                            KBI
                        </div>
                        <h1 class="font-bold text-lg text-sipkbi-green">SIP-KBI</h1>
                    </div>
                    <button id="close-sidebar" class="lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <nav class="mt-6 px-3">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.dashboard') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Manajemen
                            Keuangan</p>
                        <a href="{{ route('admin.keuangan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.keuangan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('admin.biaya') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.biaya') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            Biaya Operasional
                        </a>
                        <a href="{{ route('admin.pengeluaran') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.pengeluaran') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Pengeluaran
                        </a>
                        <a href="{{ route('admin.penjualan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.penjualan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Penjualan
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Manajemen
                            Budidaya</p>
                        <a href="{{ route('admin.kolam') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.kolam') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            Kolam
                        </a>
                        <a href="{{ route('admin.ikan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.ikan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                </path>
                            </svg>
                            Jenis Ikan
                        </a>
                        <a href="{{ route('admin.pakan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Pakan
                        </a>
                        <a href="{{ route('admin.jadwal-pakan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.jadwal-pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Jadwal Pakan
                        </a>
                        <a href="{{ route('admin.panen') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.panen') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            Panen
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">SDM</p>
                        <a href="{{ route('admin.pegawai') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.pegawai') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            Pegawai
                        </a>
                        <a href="{{ route('admin.gaji') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.gaji') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Gaji Karyawan
                        </a>
                        <a href="{{ route('admin.users') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.users') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Kelola User
                        </a>
                    </div>
                </nav>
            </div>

            <div class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <span class="text-sm">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12" />
                        </svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay untuk mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Top Bar -->
            <div class="bg-white dark:bg-gray-800 shadow-sm p-4 flex items-center justify-between sticky top-0 z-30">
                <button id="open-sidebar" class="lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl font-bold">Gaji Karyawan</h1>
                <div class="flex items-center space-x-3">
                    <button id="theme-toggle"
                        class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        🌞
                    </button>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                <!-- Header Controls -->
                <div class="flex justify-between flex-wrap items-center gap-4">
                    <!-- Button Tambah -->
                    <button onclick="openModal('add')"
                        class="bg-sipkbi-green hover:bg-sipkbi-dark text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span>Tambah Gaji</span>
                    </button>

                    <!-- Search & Filter Controls -->
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Search Input -->
                        <input type="text" id="search-input" placeholder="Cari nama pegawai atau jabatan..."
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10 w-64
                                    bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sipkbi-green">

                        <!-- Filter Gaji -->
                        <select id="filter-gaji"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10
                                    bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sipkbi-green">
                            <option value="">Semua Gaji</option>
                            <option value="high">Tertinggi</option>
                            <option value="low">Terendah</option>
                        </select>

                        <!-- Filter Status -->
                        <select id="filter-status"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10
                                    bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sipkbi-green">
                            <option value="">Semua Status</option>
                            <option value="Belum Lunas">Belum Lunas</option>
                            <option value="Lunas">Lunas</option>
                        </select>

                        <!-- Search Button -->
                        <button onclick="applyFilters()"
                            class="bg-sipkbi-green text-white px-4 h-10 rounded-lg hover:bg-sipkbi-dark transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>

                        <!-- Reset Button -->
                        <button onclick="resetFilters()"
                            class="bg-gray-500 text-white px-4 h-10 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden mr-6 ml-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-sipkbi-green text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Pegawai</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Bulan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Gaji Pokok</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Bonus</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Potongan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Total Diterima</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Data akan dimuat di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Form -->
    <div id="modal-root" class="fixed inset-0 z-50 hidden">
        <div id="modal-overlay" class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div id="modal" class="modal-transition modal-hidden fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 id="modal-title" class="text-2xl font-bold">Tambah Gaji Karyawan</h2>
                        <button id="modal-close-btn"
                            class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="gaji-form" class="space-y-4">
                        <input type="hidden" id="id">

                        <div>
                            <label class="block text-sm font-medium mb-2">Pegawai</label>
                            <select id="pegawai_id" required onchange="loadGajiPokok()"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                                <option value="">Pilih Pegawai</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Bulan</label>
                            <input type="month" id="bulan" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Gaji Pokok (Rp)</label>
                            <input type="number" step="0.01" id="jumlah_gaji" required readonly
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Bonus (Rp)</label>
                                <input type="number" step="0.01" id="bonus" value="0"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Potongan (Rp)</label>
                                <input type="number" step="0.01" id="potongan" value="0"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Total Diterima (Rp)</label>
                            <input type="number" step="0.01" id="total_diterima" readonly
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Status Pembayaran</label>
                            <select id="status_bayar" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" id="modal-cancel-btn"
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-sipkbi-green hover:bg-sipkbi-dark text-white rounded-lg transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Dark Mode Toggle
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
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

        // Mobile Sidebar Toggle
        const openSidebar = document.getElementById('open-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        openSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Modal Controls
        const modalRoot = document.getElementById('modal-root');
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const modalCloseBtn = document.getElementById('modal-close-btn');
        const modalCancelBtn = document.getElementById('modal-cancel-btn');
        const modalOverlay = document.getElementById('modal-overlay');
        const gajiForm = document.getElementById('gaji-form');

        let isEditMode = false;
        let pegawaiList = [];

        // Auto calculate total diterima
        document.getElementById('jumlah_gaji').addEventListener('input', calculateTotal);
        document.getElementById('bonus').addEventListener('input', calculateTotal);
        document.getElementById('potongan').addEventListener('input', calculateTotal);

        function calculateTotal() {
            const gaji = parseFloat(document.getElementById('jumlah_gaji').value) || 0;
            const bonus = parseFloat(document.getElementById('bonus').value) || 0;
            const potongan = parseFloat(document.getElementById('potongan').value) || 0;
            document.getElementById('total_diterima').value = (gaji + bonus - potongan).toFixed(2);
        }

        function loadGajiPokok() {
            const pegawaiId = document.getElementById('pegawai_id').value;
            const pegawai = pegawaiList.find(p => p.id == pegawaiId);
            if (pegawai) {
                document.getElementById('jumlah_gaji').value = pegawai.gaji_pokok;
                calculateTotal();
            }
        }

        function openModal(mode, data = null) {
            isEditMode = mode === 'edit';
            modalTitle.textContent = isEditMode ? 'Edit Gaji Karyawan' : 'Tambah Gaji Karyawan';

            if (isEditMode && data) {
                document.getElementById('id').value = data.id;
                document.getElementById('pegawai_id').value = data.pegawai_id;

                // Format bulan untuk input type="month" (YYYY-MM)
                let bulanValue = data.bulan;
                if (bulanValue && bulanValue.length === 10) {
                    bulanValue = bulanValue.substring(0, 7); // Ambil YYYY-MM saja
                }
                document.getElementById('bulan').value = bulanValue;

                document.getElementById('jumlah_gaji').value = data.jumlah_gaji;
                document.getElementById('bonus').value = data.bonus;
                document.getElementById('potongan').value = data.potongan;
                document.getElementById('total_diterima').value = data.total_diterima;
                document.getElementById('status_bayar').value = data.status_bayar;
            } else {
                gajiForm.reset();
                document.getElementById('id').value = '';
                document.getElementById('bonus').value = '0';
                document.getElementById('potongan').value = '0';
            }

            modalRoot.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('modal-hidden');
                modal.classList.add('modal-visible');
            }, 10);
        }

        function closeModal() {
            modal.classList.remove('modal-visible');
            modal.classList.add('modal-hidden');
            setTimeout(() => {
                modalRoot.classList.add('hidden');
                gajiForm.reset();
            }, 200);
        }

        modalCloseBtn.addEventListener('click', closeModal);
        modalCancelBtn.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', closeModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modalRoot.classList.contains('hidden')) {
                closeModal();
            }
        });

        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        }

        async function loadPegawai() {
            try {
                const response = await fetch('/api/pegawai');
                const result = await response.json();
                pegawaiList = result.data || [];

                const select = document.getElementById('pegawai_id');
                select.innerHTML = '<option value="">Pilih Pegawai</option>' +
                    pegawaiList.map(p => `<option value="${p.id}">${p.nama} - ${p.jabatan}</option>`).join('');
            } catch (error) {
                console.error('Error loading pegawai:', error);
            }
        }

        async function loadGaji(search = '', gaji = '', status = '') {
            try {
                const params = new URLSearchParams();

                if (search) params.append('search', search);
                if (gaji) params.append('filter_gaji', gaji);
                if (status) params.append('status', status);

                const queryString = params.toString();
                const url = `/api/gaji-karyawan${queryString ? '?' + queryString : ''}`;

                const response = await fetch(url);

                if (!response.ok) throw new Error('Gagal memuat data');

                const result = await response.json();
                const data = result.data || [];
                renderTable(data);
            } catch (error) {
                console.error('Error:', error);
                showAlert('Gagal memuat data gaji karyawan', 'error');
            }
        }

        function applyFilters() {
            const search = document.getElementById('search-input').value.trim();
            const gaji = document.getElementById('filter-gaji').value;
            const status = document.getElementById('filter-status').value;

            loadGaji(search, gaji, status);
        }

        function resetFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('filter-gaji').value = '';
            document.getElementById('filter-status').value = '';
            loadGaji();
        }

        function renderTable(data) {
            const tbody = document.getElementById('table-body');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data gaji karyawan
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map((item, index) => {
                const pegawai = pegawaiList.find(p => p.id == item.pegawai_id);

                // Parse bulan dengan benar
                let bulanStr = item.bulan;
                if (bulanStr && !bulanStr.includes(' ')) {
                    if (bulanStr.match(/^\d{4}-\d{2}$/)) {
                        bulanStr = bulanStr + '-01';
                    }
                }

                const bulanDate = new Date(bulanStr);
                const bulanFormatted = bulanDate.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long'
                });

                // Status badge dengan warna yang tepat
                const statusClass = item.status_bayar === 'Lunas'
                    ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100'
                    : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100';

                return `
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 text-sm">${index + 1}</td>
                        <td class="px-6 py-4 text-sm font-medium">${pegawai ? pegawai.nama : '-'}</td>
                        <td class="px-6 py-4 text-sm">${bulanFormatted}</td>
                        <td class="px-6 py-4 text-sm">Rp ${parseFloat(item.jumlah_gaji).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4 text-sm text-green-600">Rp ${parseFloat(item.bonus).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4 text-sm text-red-600">Rp ${parseFloat(item.potongan).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4 text-sm font-semibold">Rp ${parseFloat(item.total_diterima).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full ${statusClass}">
                                ${item.status_bayar}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button onclick='editGaji(${JSON.stringify(item)})' class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteGaji(${item.id})" class="text-red-600 hover:text-red-800" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        document.getElementById('search-input').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        document.getElementById('filter-gaji').addEventListener('change', applyFilters);
        document.getElementById('filter-status').addEventListener('change', applyFilters);

        gajiForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                pegawai_id: document.getElementById('pegawai_id').value,
                bulan: document.getElementById('bulan').value,
                jumlah_gaji: document.getElementById('jumlah_gaji').value,
                bonus: document.getElementById('bonus').value,
                potongan: document.getElementById('potongan').value,
                total_diterima: document.getElementById('total_diterima').value,
                status_bayar: document.getElementById('status_bayar').value
            };

            try {
                let url = '/api/gaji-karyawan';
                let method = 'POST';

                if (isEditMode) {
                    const id = document.getElementById('id').value;
                    url = `/api/gaji-karyawan/${id}`;
                    method = 'PUT';
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menyimpan data');
                }

                showAlert(result.message || 'Data berhasil disimpan', 'success');
                closeModal();
                loadGaji();
            } catch (error) {
                console.error('Error:', error);
                showAlert(error.message || 'Gagal menyimpan data', 'error');
            }
        });

        function editGaji(data) {
            openModal('edit', data);
        }

        async function deleteGaji(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus data gaji ini?')) {
                return;
            }

            try {
                const response = await fetch(`/api/gaji-karyawan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menghapus data');
                }

                showAlert(result.message || 'Data berhasil dihapus', 'success');
                loadGaji();
            } catch (error) {
                console.error('Error:', error);
                showAlert(error.message || 'Gagal menghapus data', 'error');
            }
        }

        function showAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';

            alertDiv.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300`;
            alertDiv.textContent = message;

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.style.opacity = '0';
                setTimeout(() => alertDiv.remove(), 300);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await loadPegawai();
            await loadGaji();
        });
    </script>
</body>

</html>
