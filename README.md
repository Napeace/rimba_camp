# 🌿 Rimba Camp Web App

Sistem Informasi Reservasi dan Edukasi Wisata Alam **Rimba Camp** — berbasis website, dirancang untuk mempermudah promosi destinasi, reservasi cottage, serta penyebaran informasi edukatif kepada pengunjung.

---

## 📌 Deskripsi Proyek

Rimba Camp merupakan destinasi wisata alam dengan potensi besar di bidang ekowisata dan edukasi lingkungan. Website ini dikembangkan untuk:

- Menyediakan informasi destinasi dan kegiatan wisata
- Memberikan panduan lokasi secara interaktif
- Menyediakan fitur reservasi online untuk cottage
- Menyajikan artikel edukatif
- Mengelola testimoni dan data pengunjung

---

## 👥 Anggota Kelompok

- Risma Dwi Anggraini (222410101063)  
- Aji Mahameru Firjatullah (232410101032)  
- Muhammad Najmi Nafis Zuhair (232410101066)

---

## 🔧 Teknologi yang Digunakan

- **Laravel** – Framework backend PHP
- **Tailwind CSS** – Styling modern dan responsif
- **MySQL** – Database relasional

---

## 📌 Fitur Utama

### 👤 Pengunjung
- 🔐 Registrasi & login pengguna
- 🏕️ Melihat informasi lokasi, galeri, artikel, testimoni
- 🛌 Reservasi cottage online & upload bukti pembayaran
- 📈 Lihat status reservasi & histori kunjungan

### 🛠️ Admin
- 📝 CRUD Artikel & Galeri
- 🧾 Verifikasi testimoni & bukti reservasi
- 🏠 Manajemen cottage (CRUD)
- 📊 Statistik kunjungan

---

## ⚙️ Cara Menjalankan Proyek di Windows

### ✅ Prasyarat

Pastikan kamu sudah menginstal hal-hal berikut:

- [PHP 8.x](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [Node.js & NPM](https://nodejs.org/)
- [Git](https://git-scm.com/)
- [MySQL atau Laragon](https://laragon.org/)

> Disarankan menggunakan **Laragon** karena sudah menyediakan PHP, MySQL, Apache/Nginx, dan tools lainnya dalam satu paket praktis.

---

### 🚀 Langkah-langkah Setup

1. **Clone repositori**
```bash
   git clone https://github.com/Napeace/rimba_camp.git
   cd rimba_camp
```
2. **Install dependency PHP**
```bash
composer install
```
3. **Install dependency JavaScript**
```bash
npm install
```
4. **Salin file .env**
```bash
copy .env.example .env
```
5. **Atur konfigurasi database di file .env**
```bash
DB_CONNECTION=mysql
DB_DATABASE=rimba_camp
DB_USERNAME=root
DB_PASSWORD=
```
6. **Generate app key**
```bash
php artisan key:generate
```
7. **Migrasi dan seeding database**
```bash
php artisan migrate --seed
```

8. **Jalankan server lokal**
```bash
php artisan serve
```
Lalu akses di browser:
[http://localhost:8000](http://localhost:8000)

---

## 📎 Lisensi

Proyek ini dikembangkan sebagai tugas akhir Mata Kuliah Pemrograman Website – Fakultas Ilmu Komputer, Universitas Jember, Tahun 2025.
