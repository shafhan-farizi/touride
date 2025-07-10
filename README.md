# 🚗 Touride - Aplikasi Sewa Mobil

Sebuah platform web modern untuk menyewa mobil mewah, sport, dan keluarga dengan proses booking yang mudah dan manajemen yang efisien.

## Daftar Isi
- [Tentang Proyek](#tentang-proyek)
- [Fitur Unggulan](#fitur-unggulan)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Mulai Menggunakan](#mulai-menggunakan)
  - [Prasyarat](#prasyarat)
  - [Instalasi](#instalasi)
  - [Setup Lingkungan](#setup-lingkungan)
  - [Database & Seeding](#database--seeding)
- [Penggunaan](#penggunaan)
- [Struktur Proyek](#struktur-proyek)
- [Tangkapan Layar / Demo](#tangkapan-layar--demo)
- [Kontribusi](#kontribusi)
- [Kontak](#kontak)
- [Ucapan Terima Kasih](#ucapan-terima-kasih)

---

## ℹ️ Tentang Proyek

Aplikasi **Touride** adalah solusi web lengkap untuk manajemen dan penyewaan mobil. Dirancang untuk memberikan pengalaman yang mulus bagi pelanggan dalam menemukan dan memesan kendaraan impian mereka, serta menyediakan panel admin yang efisien untuk mengelola kendaraan, booking, pembayaran, dan ulasan.

Proyek ini dibangun menggunakan **Laravel** sebagai framework backend yang kuat, dengan **Livewire** untuk pengalaman frontend yang reaktif tanpa menulis JavaScript yang rumit dan juga **FilamentPHP** digunakan untuk panel admin yang cepat dan intuitif.

---

## ✨ Fitur Unggulan

### Frontend (Pengguna)
- **Pencarian Mobil Interaktif:** Temukan mobil berdasarkan nama, tipe, atau kriteria lainnya secara real-time.
- **Detail Mobil Komprehensif:** Lihat informasi lengkap tentang setiap mobil, termasuk harga sewa, deskripsi, gambar, dan ulasan.
- **Proses Booking Mulus:** Pilih tanggal penjemputan dan pengembalian, lokasi penjemputan/pengembalian, dan konfirmasi pemesanan.
- **Riwayat Booking:** Lacak semua pemesanan yang telah Anda buat.
- **Ulasan & Penilaian:** Berikan ulasan dan rating untuk mobil yang telah Anda sewa.
- **Notifikasi Pelanggan:** Menerima notifikasi terkait status booking.
- **Navigasi Cepat:** Pengalaman seperti SPA berkat Livewire `wire:navigate` pada panel admin.

### Backend (Admin)
- **Dashboard Analisis:** Ringkasan data pendapatan per minggu, jumlah booking, mobil terpopuler, dan pelanggan teratas.
- **Manajemen Mobil:** Tambah, edit, hapus detail mobil, termasuk gambar, harga, dan status (available, rented, maintenance).
- **Manajemen Booking:** Lihat, perbarui status booking (confirm, cancel, ongoing, complete), dan pantau detail pembayaran.
- **Manajemen Pengguna:** Kelola akun pengguna.
- **Manajemen Pembayaran:** Lacak semua transaksi pembayaran.
- **Manajemen Ulasan:** Lihat ulasan dari pelanggan dan balas ulasan (reply).

---

## 🛠️ Teknologi yang Digunakan

* **Backend Framework:** [Laravel](https://laravel.com/) (v12.x atau terbaru)
* **Frontend Interactivity:** [Livewire](https://livewire.laravel.com/) (v3.x atau terbaru)
* **Admin Panel:** [FilamentPHP](https://filamentphp.com/) (v3.x atau terbaru)
* **Database:** [MySQL](https://www.mysql.com/)
* **Database ORM:** [Eloquent ORM](https://laravel.com/docs/eloquent)
* **UI/CSS Framework:** [Bootstrap](https://getbootstrap.com/) (v5.x atau terbaru)
* **Slider/Carousel:** [Swiper.js](https://swiperjs.com/)
* **Charts:** [ApexCharts.js](https://apexcharts.com/)
* **Icon Library:** [Font Awesome](https://fontawesome.com/)
* **Alerts:** [SweetAlert2](https://sweetalert2.github.io/) (via RealRashid/SweetAlert)

---

## 🚀 Mulai Menggunakan

Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek ini di lingkungan lokal Anda.

### Prasyarat

Sebelum memulai, pastikan Anda memiliki perangkat lunak berikut terinstal di sistem Anda:

* [PHP](https://www.php.net/downloads.php) (v8.1 atau terbaru)
* [Composer](https://getcomposer.org/)
* [Node.js & npm](https://nodejs.org/en/download/) (atau Yarn)
* [MySQL](https://www.mysql.com/downloads/) (atau database lain yang didukung Laravel)
* [Git](https://git-scm.com/downloads)

### Instalasi

1.  **Clone repositori:**
    ```bash
    git clone https://github.com/shafhan-farizi/touride.git
    ```

2.  **Instal dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Instal dependensi Node.js:**
    ```bash
    npm install
    # atau yarn install
    ```

### Setup Lingkungan

1.  **Salin file `.env`:**
    ```bash
    cp .env.example .env
    ```

2.  **Buat kunci aplikasi:**
    ```bash
    php artisan key:generate
    ```

3.  **Konfigurasi database di `.env`:**
    Buka file `.env` dan perbarui detail koneksi database Anda:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=touride_db # Ganti dengan nama database Anda
    DB_USERNAME=root      # Ganti dengan username database Anda
    DB_PASSWORD=          # Ganti dengan password database Anda
    ```

### Database & Seeding

1.  **Jalankan migrasi database:**
    ```bash
    php artisan migrate
    ```

2.  **Buat symlink untuk storage:**
    ```bash
    php artisan storage:link
    ```

3.  **Seed database dengan data awal (opsional, tapi disarankan untuk demo):**
    ```bash
    php artisan db:seed
    # Jika ingin refresh database dan seed ulang:
    # php artisan migrate:fresh --seed
    ```
    *(Pastikan seeder Anda membuat user admin, mobil, booking, dan review dummy)*

    **Ada sekitar 5 User yang dibuat dengan role customer dan 1 User dengan role admin, semuanya bisa dilihat di dalam folder*
    ```bash
    database/seeders/DatabaseSeeder.php
    ```

---

## 🚀 Penggunaan

1.  **Jalankan server pengembangan Laravel:**
    ```bash
    php artisan serve
    ```

2.  **Jalankan Vite untuk kompilasi aset frontend:**
    *(Biarkan ini berjalan di terminal terpisah selama pengembangan)*
    ```bash
    npm run dev
    # atau yarn dev
    ```

3.  **Akses aplikasi di browser Anda:**
    * **Halaman Utama (Customer):** `http://127.0.0.1:8000`
    * **Panel Admin (Filament):** `http://127.0.0.1:8000/admin` (Login dengan kredensial user admin yang sudah dibuat)

---

## 📸 Tangkapan Layar / Demo

* **Halaman Beranda:**
![home_2](https://github.com/user-attachments/assets/0b6f487a-51a5-4220-872f-a1a802be0a25)
* **Daftar Mobil:**
![cars](https://github.com/user-attachments/assets/4d356daa-a6c9-4381-83a8-b75aeb4b393a)
* **Form Booking:** [link_to_image_bookingform.png]
![booking](https://github.com/user-attachments/assets/b5457ded-f1cc-4f7f-93de-105d09273d6b)
* **Dashboard Admin (Filament):** [link_to_image_admin_dashboard.png]
![admin](https://github.com/user-attachments/assets/e3793b37-a00d-4754-b474-b70fc3416054)

---

## 🤝 Kontribusi

Kontribusi adalah apa yang membuat komunitas open source menjadi tempat yang luar biasa untuk belajar, menginspirasi, dan berkreasi. Setiap kontribusi yang Anda buat **sangat dihargai**.

Jika Anda memiliki saran yang akan membuat ini lebih baik, fork repo dan buat pull request. Anda juga bisa membuka masalah dengan tag "enhancement".

1.  Fork proyek.
2.  Buat fitur Branch Anda (`git checkout -b feature/AmazingFeature`).
3.  Commit perubahan Anda (`git commit -m 'Add some AmazingFeature'`).
4.  Push ke Branch (`git push origin feature/AmazingFeature`).
5.  Buka Pull Request.

---

## 📧 Kontak

Email - shaf23019ti@student.nurulfikri.ac.id \
Linkedin - [@shafhan farizi](https://www.linkedin.com/in/shafhan-farizi-520552223/)

---

## 🙏 Ucapan Terima Kasih

* [Laravel Documentation](https://laravel.com/docs/)
* [Livewire Documentation](https://livewire.laravel.com/docs/)
* [FilamentPHP Documentation](https://filamentphp.com/docs/)
* [Bootstrap Documentation](https://getbootstrap.com/docs/)
* [Swiper.js Documentation](https://swiperjs.com/docs/)
* [ApexCharts.js Documentation](https://apexcharts.com/docs/)
* Teman-teman yang membantu proses pengembangan (Okta, Hafiz)

---
