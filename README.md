markdown
# Aplikasi Data Pasien

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

Aplikasi web sederhana untuk mengelola data pasien secara efisien dengan fitur CRUD lengkap, dibangun menggunakan Laravel.

## ✨ Fitur Utama

- **Manajemen Pasien (CRUD)**
  - Tambah pasien baru dengan validasi komprehensif
  - Lihat detail pasien termasuk riwayat penyakit dan asuransi
  - Edit data pasien (kecuali tanggal lahir)
  - Hapus pasien beserta data terkait

- **Fitur Tambahan**
  - Alamat bertingkat dinamis (Provinsi → Kota → Kecamatan → Desa)
  - Multi-input riwayat penyakit dan data asuransi
  - Upload foto pasien (.jpg, .png)
  - Validasi formulir komprehensif

## 🛠️ Teknologi

- PHP 8.0+
- Laravel 10+
- MySQL/MariaDB
- Tailwind CSS
- JavaScript/AJAX

## 🚀 Instalasi

1. **Clone repositori**
   ```bash
   git clone https://github.com/USERNAME_ANDA/aplikasi-data-pasien.git
   cd aplikasi-data-pasien
   
2. **Instal dependensi**
    ```bash
    composer install
    
3. **Setup environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    
4. **Konfigurasi database**
    Sesuaikan pengaturan di .env:

    env
    DB_DATABASE=pasien-app
    DB_USERNAME=root
    DB_PASSWORD=
   
6. **Jalankan migrasi**
    ```bash
    php artisan migrate:fresh --seed
    php artisan storage:link
    
6.**Jalankan server**
    ```bash
    
    php artisan serve   
    Buka http://localhost:8000 di browser Anda.

📂 Struktur Proyek
text
aplikasi-data-pasien/
├── app/               # Logic aplikasi
│   ├── Models/        # Model database
│   └── Http/          # Controller dan request
├── database/          # Migrasi dan seeder
├── public/            # Assets publik
├── resources/         # View dan assets
├── routes/            # Definisi route
└── storage/           # File upload
🤝 Kontribusi
Fork project

Buat branch fitur (git checkout -b feature/nama-fitur)

Commit perubahan (git commit -m 'Tambahkan fitur')

Push ke branch (git push origin feature/nama-fitur)

Buat Pull Request

📄 Lisensi
Dilisensikan di bawah MIT License.
