# 🏥 Aplikasi Data Pasien

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

Aplikasi web sederhana untuk mengelola data pasien dengan fitur CRUD lengkap, dibangun menggunakan Laravel. Dirancang untuk memudahkan pencatatan, pencarian, dan pengelolaan informasi pasien secara efisien.

---

## ✨ Fitur Utama

- **Manajemen Pasien**
  - Tambah pasien baru dengan validasi data yang ketat
  - Lihat detail pasien lengkap, termasuk riwayat penyakit dan data asuransi
  - Edit data pasien (kecuali tanggal lahir)
  - Hapus data pasien beserta relasi terkait

- **Fitur Tambahan**
  - Alamat dinamis bertingkat: Provinsi → Kota/Kabupaten → Kecamatan → Desa
  - Input ganda untuk riwayat penyakit dan informasi asuransi
  - Upload foto pasien (.jpg, .png)
  - Validasi formulir menyeluruh di sisi klien dan server

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP 8.0+, Laravel 10+
- **Frontend**: Tailwind CSS, JavaScript (AJAX)
- **Database**: MySQL / MariaDB

---

## 🚀 Instalasi & Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lokal:

### 1. Clone Repositori

```bash
git clone https://github.com/USERNAME_ANDA/aplikasi-data-pasien.git
cd aplikasi-data-pasien
```

### 2. Instal Dependensi

```bash
composer install
```

### 3. Setup File Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` sesuai konfigurasi lokal Anda:

```env
DB_DATABASE=pasien-app
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migrasi & Seeder

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### 6. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi melalui [http://localhost:8000](http://localhost:8000)

---

## 📂 Struktur Proyek

```
aplikasi-data-pasien/
├── app/               # Logika aplikasi (model, controller, request)
│   ├── Models/
│   └── Http/
├── database/          # File migrasi & seeder
├── public/            # Aset publik
├── resources/         # View (Blade) dan file Tailwind
├── routes/            # Definisi route Laravel
└── storage/           # Media & file upload
```

---

## 🤝 Kontribusi

Kontribusi sangat terbuka! Ikuti langkah berikut:

1. Fork repositori ini
2. Buat branch baru: `git checkout -b feature/nama-fitur`
3. Commit perubahan: `git commit -m 'Tambahkan fitur'`
4. Push ke branch Anda: `git push origin feature/nama-fitur`
5. Buat Pull Request

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
