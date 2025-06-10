Aplikasi Data Pasien
Sebuah aplikasi web sederhana untuk mengelola data pasien, dibangun menggunakan framework Laravel. Aplikasi ini menyediakan fitur dasar Create, Read, Update, Delete (CRUD) untuk data pasien, dilengkapi dengan penanganan alamat bertingkat, riwayat penyakit dan asuransi dinamis, serta upload foto pasien.

Fitur Utama
Manajemen Pasien (CRUD):

Tambah Pasien: Input data pasien baru dengan validasi lengkap.

Lihat Detail Pasien: Menampilkan informasi lengkap pasien, termasuk riwayat penyakit, asuransi, dan foto.

Edit Pasien: Memperbarui data pasien yang sudah ada, dengan mempertahankan data riwayat dan asuransi yang dinamis. Tanggal lahir pasien tidak dapat diubah setelah input awal.

Hapus Pasien: Menghapus data pasien beserta riwayat dan data asuransi terkait.

Alamat Bertingkat: Dropdown dinamis untuk Provinsi, Kota/Kabupaten, Kecamatan, dan Desa/Kelurahan, memastikan input alamat yang akurat.

Riwayat Penyakit Dinamis: Kemampuan untuk menambahkan lebih dari satu riwayat penyakit (nama penyakit dan tahun) pada setiap pasien.

Data Asuransi Dinamis: Kemampuan untuk menambahkan lebih dari satu data asuransi (jenis asuransi dan nomor asuransi) pada setiap pasien.

Upload Foto Pasien: Fitur upload gambar (.jpg/.png) untuk foto pasien, dengan penanganan penyimpanan file yang aman.

Validasi Formulir: Validasi sisi server yang komprehensif untuk memastikan integritas data.

Teknologi yang Digunakan
PHP

Laravel Framework (versi terbaru)

MySQL / MariaDB (sebagai database)

Composer (untuk manajemen dependensi PHP)

Tailwind CSS (untuk styling UI yang responsif)

JavaScript / AJAX (untuk fungsionalitas dropdown alamat dinamis)

Panduan Instalasi dan Setup
Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di lingkungan lokal Anda:

Clone Repositori:

git clone https://github.com/USERNAME_ANDA/NAMA_REPOSITORI_ANDA.git
cd NAMA_REPOSITORI_ANDA

(Ganti USERNAME_ANDA dan NAMA_REPOSITORI_ANDA sesuai dengan repositori GitHub Anda).

Instal Dependensi Composer:

composer install

Buat File .env:

cp .env.example .env

Atur Kunci Aplikasi:

php artisan key:generate

Konfigurasi Database di .env:
Buka file .env dan sesuaikan pengaturan database Anda:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pasien-app # Pastikan nama database ini sudah Anda buat di phpMyAdmin/MariaDB
DB_USERNAME=root      # Sesuaikan dengan username database Anda
DB_PASSWORD=          # Sesuaikan dengan password database Anda
APP_URL=http://127.0.0.1:8000 # Atau sesuaikan dengan URL local Anda (misal: http://localhost/pasien-app/public)
SESSION_DRIVER=database # Pastikan ini diatur ke 'database'

Buat Database di phpMyAdmin/MariaDB:
Buka http://localhost/phpmyadmin (atau sejenisnya) dan buat database baru dengan nama yang sama dengan DB_DATABASE di .env (contoh: pasien-app).

Jalankan Migrasi Database dan Seeder:
Perintah ini akan membuat semua tabel yang diperlukan dan mengisi data awal (pekerjaan, jenis asuransi, data alamat Kalimantan Barat):

php artisan migrate:fresh --seed

Catatan: Jika Anda mengalami error Table 'pasien-app.sessions' doesn't exist, jalankan php artisan session:table terlebih dahulu, lalu ulangi php artisan migrate:fresh --seed.

Buat Symlink untuk Penyimpanan Foto:
Ini memungkinkan foto yang di-upload dapat diakses melalui web. Jalankan Command Prompt/PowerShell sebagai Administrator jika Anda di Windows.

php artisan storage:link

Jika ada error The [public/storage] link already exists., abaikan saja, berarti symlink sudah ada.

Bersihkan Cache Laravel:

php artisan optimize:clear

Jalankan Server Pengembangan:

php artisan serve

Cara Menggunakan Aplikasi
Setelah server berjalan, buka browser Anda dan akses URL berikut:

http://127.0.0.1:8000

(Atau sesuai dengan URL yang diberikan oleh php artisan serve atau konfigurasi server web Anda).

Anda akan diarahkan langsung ke halaman daftar pasien. Dari sana, Anda dapat:

Melihat daftar pasien yang sudah ada.

Mengklik "Tambah Pasien Baru" untuk mengisi formulir input.

Mengklik "Detail", "Edit", atau "Hapus" pada setiap baris pasien untuk mengelola data.

Kontribusi
Kontribusi disambut baik! Jika Anda memiliki ide atau perbaikan, silakan:

Fork repositori ini.

Buat branch baru (git checkout -b feature/nama-fitur).

Lakukan perubahan Anda dan commit (git commit -m 'Tambahkan fitur X').

Push ke branch Anda (git push origin feature/nama-fitur).

Buat Pull Request.

Lisensi
Proyek ini dilisensikan di bawah Lisensi MIT.
