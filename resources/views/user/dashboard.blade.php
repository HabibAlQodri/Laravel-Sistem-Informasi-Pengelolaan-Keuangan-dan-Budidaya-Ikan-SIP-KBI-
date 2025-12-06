<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SIP-KBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col justify-between fixed h-full z-50 transform transition-transform duration-300 lg:translate-x-0 -translate-x-full">
            <div class="overflow-y-auto">
                <div class="p-5 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-sipkbi-green rounded-lg flex items-center justify-center text-white font-bold">
                            KBI
                        </div>
                        <h1 class="font-bold text-lg text-sipkbi-green">SIP-KBI</h1>
                    </div>
                    <button id="close-sidebar" class="lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <nav class="mt-6 px-3">
                    <a href="{{ route('user.dashboard') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 bg-sipkbi-green text-white transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Keuangan</p>
                        <a href="{{ route('user.keuangan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('user.biaya') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Biaya Operasional
                        </a>
                        <a href="{{ route('user.penjualan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Penjualan
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Budidaya</p>
                        <a href="{{ route('user.kolam') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Kolam
                        </a>
                        <a href="{{ route('user.ikan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                            </svg>
                            Jenis Ikan
                        </a>
                        <a href="{{ route('user.pakan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Pakan
                        </a>
                        <a href="{{ route('user.jadwal-pakan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Jadwal Pakan
                        </a>
                        <a href="{{ route('user.panen') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 hover:bg-sipkbi-green hover:text-white transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            Panen
                        </a>
                    </div>
                </nav>
            </div>

            <div class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <span class="text-sm">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12" />
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl font-bold">Dashboard SIP-KBI</h1>
                <div class="flex items-center space-x-3">
                    <button id="theme-toggle" class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        🌞
                    </button>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-sipkbi-green to-emerald-600 rounded-xl p-6 mb-8 text-white shadow-lg">
                    <h2 class="text-2xl font-bold mb-2">Selamat Datang di SIP-KBI</h2>
                    <p class="text-emerald-100">Sistem Informasi Pengelolaan Kolam Budidaya Ikan</p>
                    <div class="mt-4 flex items-center text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span id="current-date"></span>
                    </div>
                </div>

                <!-- Ringkasan Kartu -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                    <!-- Total Panen -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Panen</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalPanen, 1) }} <span class="text-base font-normal">kg</span></p>
                        <p class="text-xs text-green-600 mt-2">↑ Data keseluruhan</p>
                    </div>

                    <!-- Total Penjualan -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-green-500 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Penjualan</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalPenjualan / 1000000, 1) }}<span class="text-base font-normal">M</span></p>
                        <p class="text-xs text-green-600 mt-2">↑ Data keseluruhan</p>
                    </div>

                    <!-- Pendapatan -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-indigo-500 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-sm text-gray-600 dark:text-gray-400 mb-1">Pendapatan</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalPendapatan / 1000000, 1) }}<span class="text-base font-normal">M</span></p>
                        <p class="text-xs text-green-600 mt-2">↑ Data keseluruhan</p>
                    </div>

                    <!-- Pengeluaran -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-red-500 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-3 bg-red-100 dark:bg-red-900 rounded-lg">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-sm text-gray-600 dark:text-gray-400 mb-1">Pengeluaran</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalPengeluaran / 1000000, 1) }}<span class="text-base font-normal">M</span></p>
                        <p class="text-xs text-red-600 mt-2">↑ Data keseluruhan</p>
                    </div>

                    <!-- Laba Bersih -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-emerald-500 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-3 bg-emerald-100 dark:bg-emerald-900 rounded-lg">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-sm text-gray-600 dark:text-gray-400 mb-1">Laba Bersih</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($labaBersih / 1000000, 1) }}<span class="text-base font-normal">M</span></p>
                        <p class="text-xs text-{{ $labaBersih >= 0 ? 'green' : 'red' }}-600 mt-2">{{ $labaBersih >= 0 ? '↑' : '↓' }} Data keseluruhan</p>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Grafik Keuangan -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <div class="w-2 h-6 bg-sipkbi-green rounded mr-3"></div>
                            Tren Keuangan 6 Bulan Terakhir
                        </h3>
                        <canvas id="keuanganChart"></canvas>
                    </div>

                    <!-- Status Kolam & Top Ikan -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <div class="w-2 h-6 bg-sipkbi-green rounded mr-3"></div>
                            Status Kolam & Top Ikan
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <canvas id="kolamChart"></canvas>
                            </div>
                            <div>
                                <h4 class="font-semibold text-sm mb-3 text-gray-700 dark:text-gray-300">Top 5 Jenis Ikan</h4>
                                <div class="space-y-2">
                                    @foreach($topIkan as $index => $ikan)
                                    <div>
                                        <div class="flex items-center justify-between text-sm mb-1">
                                            <span class="text-gray-600 dark:text-gray-400">{{ $ikan->nama_ikan }}</span>
                                            <span class="font-semibold">{{ number_format($ikan->total_berat, 1) }} kg</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            <div class="h-2 rounded-full {{ ['bg-sipkbi-green', 'bg-blue-500', 'bg-emerald-500', 'bg-yellow-500', 'bg-orange-500'][$index] }}" style="width: {{ 100 - ($index * 10) }}%"></div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panen Terbaru -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <div class="w-2 h-6 bg-sipkbi-green rounded mr-3"></div>
                        Panen Terbaru
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Kolam</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Jenis Ikan</th>
                                    <th class="text-right py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Berat (kg)</th>
                                    <th class="text-right py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Jumlah</th>
                                    <th class="text-right py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($panenTerbaru as $panen)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="py-3 px-4 text-sm">{{ date('d/m/Y', strtotime($panen->tanggal_panen)) }}</td>
                                    <td class="py-3 px-4 text-sm">{{ $panen->nama_kolam }}</td>
                                    <td class="py-3 px-4 text-sm"><span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-xs">{{ $panen->nama_ikan }}</span></td>
                                    <td class="py-3 px-4 text-sm text-right">{{ number_format($panen->berat_total_kg, 1) }}</td>
                                    <td class="py-3 px-4 text-sm text-right">{{ number_format($panen->jumlah_ikan) }}</td>
                                    <td class="py-3 px-4 text-sm text-right font-semibold text-green-600">Rp {{ number_format($panen->total_pendapatan, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Set tanggal saat ini
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('id-ID', options);

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
            updateChartColors();
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

        // Data dari Controller
        const laporanKeuangan = @json($laporanKeuangan);
        const kolamAktif = {{ $kolamAktif }};
        const kolamNonaktif = {{ $kolamNonaktif }};

        // Chart colors
        let chartColors = getChartColors();

        function getChartColors() {
            const isDark = html.classList.contains('dark');
            return {
                text: isDark ? '#e5e7eb' : '#374151',
                grid: isDark ? '#374151' : '#e5e7eb',
                pendapatan: '#10b981',
                pengeluaran: '#ef4444',
                laba: '#6366f1'
            };
        }

        function updateChartColors() {
            chartColors = getChartColors();
            if (window.keuanganChart) {
                window.keuanganChart.options.scales.x.ticks.color = chartColors.text;
                window.keuanganChart.options.scales.y.ticks.color = chartColors.text;
                window.keuanganChart.options.scales.x.grid.color = chartColors.grid;
                window.keuanganChart.options.scales.y.grid.color = chartColors.grid;
                window.keuanganChart.options.plugins.legend.labels.color = chartColors.text;
                window.keuanganChart.update();
            }
            if (window.kolamChart) {
                window.kolamChart.options.plugins.legend.labels.color = chartColors.text;
                window.kolamChart.update();
            }
        }

        // Grafik Keuangan
        const ctxKeuangan = document.getElementById('keuanganChart').getContext('2d');
        window.keuanganChart = new Chart(ctxKeuangan, {
            type: 'line',
            data: {
                labels: laporanKeuangan.map(item => {
                    const date = new Date(item.bulan);
                    return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                }),
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: laporanKeuangan.map(item => item.total_pendapatan / 1000000),
                        borderColor: chartColors.pendapatan,
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Pengeluaran',
                        data: laporanKeuangan.map(item => item.total_pengeluaran / 1000000),
                        borderColor: chartColors.pengeluaran,
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Laba Bersih',
                        data: laporanKeuangan.map(item => item.laba_bersih / 1000000),
                        borderColor: chartColors.laba,
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: chartColors.text,
                            usePointStyle: true,
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toFixed(1) + 'M';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: chartColors.text,
                            callback: function(value) {
                                return 'Rp ' + value + 'M';
                            }
                        },
                        grid: {
                            color: chartColors.grid
                        }
                    },
                    x: {
                        ticks: {
                            color: chartColors.text
                        },
                        grid: {
                            color: chartColors.grid
                        }
                    }
                }
            }
        });

        // Grafik Status Kolam
        const ctxKolam = document.getElementById('kolamChart').getContext('2d');
        window.kolamChart = new Chart(ctxKolam, {
            type: 'doughnut',
            data: {
                labels: ['Aktif', 'Nonaktif'],
                datasets: [{
                    data: [kolamAktif, kolamNonaktif],
                    backgroundColor: ['#16a34a', '#ef4444'],
                    borderWidth: 2,
                    borderColor: html.classList.contains('dark') ? '#1f2937' : '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: chartColors.text,
                            padding: 10,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = kolamAktif + kolamNonaktif;
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
