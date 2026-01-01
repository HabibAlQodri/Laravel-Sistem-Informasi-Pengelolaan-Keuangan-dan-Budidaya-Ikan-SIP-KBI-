# Sistem Informasi Pengelolaan Keuangan dan Budidaya Ikan (SIP-KBI)

Sistem informasi berbasis web untuk mengelola keuangan dan budidaya ikan yang dibangun dengan Laravel dan Blade templating engine.

## 📋 Tentang Sistem

SIP-KBI adalah aplikasi web yang dirancang untuk membantu pembudidaya ikan dalam mengelola aspek keuangan dan operasional budidaya ikan mereka. Sistem ini menyediakan fitur-fitur lengkap untuk:

- **Manajemen Keuangan** - Pencatatan pemasukan, pengeluaran, dan laporan keuangan
- **Manajemen Kolam** - Monitoring kolam budidaya dan kapasitas
- **Manajemen Pakan** - Tracking stok pakan dan jadwal pemberian pakan
- **Manajemen Panen** - Pencatatan hasil panen dan analisis produktivitas
- **Monitoring Kesehatan Ikan** - Pemantauan kondisi dan kesehatan ikan
- **Laporan & Analisis** - Dashboard dan laporan komprehensif untuk pengambilan keputusan

## 🚀 Fitur Utama

- ✅ Dashboard interaktif dengan statistik real-time
- 📊 Laporan keuangan lengkap (neraca, laba rugi, arus kas)
- 📈 Analisis produktivitas dan efisiensi budidaya
- 🔔 Notifikasi dan reminder otomatis
- 👥 Multi-user dengan role & permission management
- 📱 Responsive design untuk akses mobile
- 🖨️ Export data ke PDF dan Excel
- 🔒 Keamanan data dengan enkripsi

## 💻 Teknologi yang Digunakan

- **Framework:** Laravel 10.x
- **Template Engine:** Blade
- **Database:** MySQL/MariaDB
- **Frontend:** Bootstrap 5, jQuery, Chart.js
- **Authentication:** Laravel Breeze/Sanctum
- **Icons:** Font Awesome
- **Datatables:** Laravel Yajra Datatables

## 📦 Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL >= 5.7 atau MariaDB >= 10.3
- Node.js & NPM (untuk asset compilation)
- Apache/Nginx web server

## 🔧 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/laravel-sip-kbi.git
cd laravel-sip-kbi
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file .env.example
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sip_kbi
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database & Seeder

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder (optional)
php artisan db:seed
```

### 6. Compile Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Jalankan Aplikasi

```bash
# Development server
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## 👤 Default Login

Setelah menjalankan seeder, Anda dapat login dengan:

- **Admin**
  - Email: admin@sipkbi.com
  - Password: password

- **Manager**
  - Email: manager@sipkbi.com
  - Password: password

- **Staff**
  - Email: staff@sipkbi.com
  - Password: password

## 📁 Struktur Direktori

```
laravel-sip-kbi/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controllers untuk logika bisnis
│   │   └── Middleware/      # Custom middleware
│   ├── Models/              # Eloquent models
│   └── Services/            # Business logic services
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── public/
│   ├── css/                 # Compiled CSS
│   ├── js/                  # Compiled JavaScript
│   └── images/              # Images & assets
├── resources/
│   ├── views/               # Blade templates
│   │   ├── layouts/         # Layout templates
│   │   ├── components/      # Reusable components
│   │   ├── auth/            # Authentication views
│   │   ├── dashboard/       # Dashboard views
│   │   ├── keuangan/        # Financial views
│   │   ├── kolam/           # Pond management views
│   │   ├── pakan/           # Feed management views
│   │   └── panen/           # Harvest views
│   ├── css/                 # Source CSS/SCSS
│   └── js/                  # Source JavaScript
└── routes/
    ├── web.php              # Web routes
    └── api.php              # API routes
```

## 🎨 Blade Components

Sistem ini menggunakan Blade components untuk reusability:

```blade
<!-- Card Component -->
<x-card title="Judul Card" icon="fas fa-chart-line">
    Konten card
</x-card>

<!-- Modal Component -->
<x-modal id="modalExample" title="Judul Modal">
    Konten modal
</x-modal>

<!-- Alert Component -->
<x-alert type="success" message="Operasi berhasil!" />
```

## 🔐 Keamanan

- Password di-hash menggunakan bcrypt
- CSRF protection di semua form
- SQL injection prevention dengan Eloquent ORM
- XSS protection dengan Blade escaping
- Role-based access control (RBAC)
- Secure session management

## 📊 Database Schema

### Tabel Utama

- `users` - Data pengguna sistem
- `kolam` - Informasi kolam budidaya
- `pakan` - Master data pakan
- `stok_pakan` - Inventori pakan
- `jadwal_pakan` - Jadwal pemberian pakan
- `panen` - Data hasil panen
- `keuangan` - Transaksi keuangan
- `monitoring_kesehatan` - Log kesehatan ikan

## 🛠️ Development

### Menjalankan Tests

```bash
php artisan test
```

### Code Style

```bash
# Check code style
./vendor/bin/pint --test

# Fix code style
./vendor/bin/pint
```

### Database Refresh

```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed
```

## 📱 API Endpoints

Sistem menyediakan RESTful API untuk integrasi:

```
GET    /api/kolam                 - List semua kolam
POST   /api/kolam                 - Tambah kolam baru
GET    /api/panen/{id}            - Detail panen
POST   /api/keuangan/transaksi    - Catat transaksi
GET    /api/dashboard/stats       - Statistik dashboard
```

Dokumentasi API lengkap: `http://localhost:8000/api/documentation`

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan ikuti langkah berikut:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/FiturBaru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin feature/FiturBaru`)
5. Buat Pull Request

## 📝 Changelog

### Version 1.0.0 (2024-01-01)
- ✨ Rilis awal sistem
- ✅ Implementasi manajemen keuangan
- ✅ Implementasi manajemen kolam
- ✅ Implementasi manajemen pakan
- ✅ Implementasi manajemen panen

## 📧 Kontak & Support

- **Email:** support@sipkbi.com
- **Website:** https://sipkbi.com
- **Dokumentasi:** https://docs.sipkbi.com
- **Issues:** https://github.com/username/laravel-sip-kbi/issues

## 👥 Tim Pengembang

- **Project Lead:** [Nama Anda]
- **Backend Developer:** [Nama Developer]
- **Frontend Developer:** [Nama Developer]
- **UI/UX Designer:** [Nama Designer]

## 📄 Lisensi

Sistem ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

## 🙏 Ucapan Terima Kasih

Terima kasih kepada:

- [Laravel](https://laravel.com) - Framework PHP terbaik
- [Bootstrap](https://getbootstrap.com) - CSS framework
- [Chart.js](https://www.chartjs.org) - Charting library
- Semua kontributor dan pengguna sistem ini

---

**Dibuat dengan ❤️ untuk pembudidaya ikan Indonesia**
