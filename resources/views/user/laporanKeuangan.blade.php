<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Laporan keuangan</title>
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
                    <a href="{{ route('user.dashboard') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.dashboard') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Keuangan</p>
                        <a href="{{ route('user.keuangan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.keuangan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('user.biaya') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.biaya') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Biaya Operasional
                        </a>
                        <a href="{{ route('user.penjualan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.penjualan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Penjualan
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Budidaya</p>
                        <a href="{{ route('user.kolam') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.kolam') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Kolam
                        </a>
                        <a href="{{ route('user.ikan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.ikan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                            </svg>
                            Jenis Ikan
                        </a>
                        <a href="{{ route('user.pakan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Pakan
                        </a>
                        <a href="{{ route('user.jadwal-pakan') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.jadwal-pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Jadwal Pakan
                        </a>
                        <a href="{{ route('user.panen') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.panen') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            Panen
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">SDM</p>
                        <a href="{{ route('user.pegawai') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.pegawai') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Pegawai
                        </a>
                        <a href="{{ route('user.gaji') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.gaji') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Gaji Karyawan
                        </a>
                    </div>
                </nav>
            </div>

            <div class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">

                <span class="text-sm">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline text-sm">
                        Keluar
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
                <h1 class="text-xl font-bold">Laporan Keuangan</h1>
                <div class="flex items-center space-x-3">
                <button id="theme-toggle" class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    🌞
                </button>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                <!-- Button Tambah -->
                <div class="mb-6">
                    <button onclick="openModal('add')" class="bg-sipkbi-green hover:bg-sipkbi-dark text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Laporan</span>
                    </button>
                </div>

                

                <!-- Table -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-sipkbi-green text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Bulan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Total Pendapatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Total Pengeluaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Laba Bersih</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Catatan</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- Data akan dimuat di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal Form -->
        <div id="modal-root" class="fixed inset-0 z-50 hidden">
            <div id="modal-overlay" class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div id="modal" class="modal-transition modal-hidden fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 id="modal-title" class="text-2xl font-bold">Tambah Laporan Keuangan</h2>
                            <button id="modal-close-btn" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form id="laporan-form" class="space-y-4">
                            <input type="hidden" id="id">

                            <div>
                                <label class="block text-sm font-medium mb-2">Bulan</label>
                                <input type="month" id="bulan" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Total Pendapatan (Rp)</label>
                                    <input type="number" step="0.01" id="total_pendapatan" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-2">Total Pengeluaran (Rp)</label>
                                    <input type="number" step="0.01" id="total_pengeluaran" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Laba Bersih (Rp)</label>
                                <input type="number" step="0.01" id="laba_bersih" readonly class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Catatan</label>
                                <textarea id="catatan" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent"></textarea>
                            </div>

                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" id="modal-cancel-btn" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                    Batal
                                </button>
                                <button type="submit" class="px-6 py-2 bg-sipkbi-green hover:bg-sipkbi-dark text-white rounded-lg transition">
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

            // Update charts when theme changes
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

        const modalRoot = document.getElementById('modal-root');
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const modalCloseBtn = document.getElementById('modal-close-btn');
        const modalCancelBtn = document.getElementById('modal-cancel-btn');
        const modalOverlay = document.getElementById('modal-overlay');
        const laporanForm = document.getElementById('laporan-form');

        let isEditMode = false;

        // Auto calculate laba bersih
        document.getElementById('total_pendapatan').addEventListener('input', calculateLaba);
        document.getElementById('total_pengeluaran').addEventListener('input', calculateLaba);

        function calculateLaba() {
            const pendapatan = parseFloat(document.getElementById('total_pendapatan').value) || 0;
            const pengeluaran = parseFloat(document.getElementById('total_pengeluaran').value) || 0;
            document.getElementById('laba_bersih').value = (pendapatan - pengeluaran).toFixed(2);
        }

        function openModal(mode, data = null) {
            isEditMode = mode === 'edit';
            modalTitle.textContent = isEditMode ? 'Edit Laporan Keuangan' : 'Tambah Laporan Keuangan';

            if (isEditMode && data) {
                document.getElementById('id').value = data.id;
                document.getElementById('bulan').value = data.bulan;
                document.getElementById('total_pendapatan').value = data.total_pendapatan;
                document.getElementById('total_pengeluaran').value = data.total_pengeluaran;
                document.getElementById('laba_bersih').value = data.laba_bersih;
                document.getElementById('catatan').value = data.catatan || '';
            } else {
                laporanForm.reset();
                document.getElementById('id').value = '';
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
                laporanForm.reset();
            }, 180);
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

        async function loadLaporan() {
            try {
                const response = await fetch('/api/laporan-keuangan');
                if (!response.ok) throw new Error('Gagal memuat data');

                const result = await response.json();
                const data = result.data || [];

                renderTable(data);
            } catch (error) {
                console.error('Error:', error);
                showAlert('Gagal memuat data laporan keuangan', 'error');
            }
        }

        function renderTable(data) {
            const tbody = document.getElementById('table-body');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data laporan keuangan
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map((item, index) => {
                const bulanDate = new Date(item.bulan);
                const labaBersih = parseFloat(item.laba_bersih);
                const isProfit = labaBersih >= 0;

                return `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 text-sm">${index + 1}</td>
                    <td class="px-6 py-4 text-sm font-medium">${bulanDate.toLocaleDateString('id-ID', { year: 'numeric', month: 'long' })}</td>
                    <td class="px-6 py-4 text-sm text-green-600 font-semibold">Rp ${parseFloat(item.total_pendapatan).toLocaleString('id-ID')}</td>
                    <td class="px-6 py-4 text-sm text-red-600 font-semibold">Rp ${parseFloat(item.total_pengeluaran).toLocaleString('id-ID')}</td>
                    <td class="px-6 py-4 text-sm font-bold ${isProfit ? 'text-green-600' : 'text-red-600'}">
                        Rp ${Math.abs(labaBersih).toLocaleString('id-ID')}
                        ${!isProfit ? '(Rugi)' : ''}
                    </td>
                    <td class="px-6 py-4 text-sm">${item.catatan || '-'}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <button onclick='editLaporan(${JSON.stringify(item)})' class="text-blue-600 hover:text-blue-800" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteLaporan(${item.id})" class="text-red-600 hover:text-red-800" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `}).join('');
        }

        laporanForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                bulan: document.getElementById('bulan').value,
                total_pendapatan: document.getElementById('total_pendapatan').value,
                total_pengeluaran: document.getElementById('total_pengeluaran').value,
                laba_bersih: document.getElementById('laba_bersih').value,
                catatan: document.getElementById('catatan').value
            };

            try {
                let url = '/api/laporan-keuangan';
                let method = 'POST';

                if (isEditMode) {
                    const id = document.getElementById('id').value;
                    url = `/api/laporan-keuangan/${id}`;
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
                loadLaporan();
            } catch (error) {
                console.error('Error:', error);
                showAlert(error.message || 'Gagal menyimpan data', 'error');
            }
        });

        function editLaporan(data) {
            openModal('edit', data);
        }

        async function deleteLaporan(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus laporan keuangan ini?')) {
                return;
            }

            try {
                const response = await fetch(`/api/laporan-keuangan/${id}`, {
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
                loadLaporan();
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

        document.addEventListener('DOMContentLoaded', () => {
            loadLaporan();
        });
    </script>
</body>
</html>
