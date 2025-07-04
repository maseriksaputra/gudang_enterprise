# SIMDB Enterprise: Sistem Informasi Manufaktur & Distribusi

SIMDB Enterprise adalah sebuah platform terpusat yang dirancang untuk mengelola seluruh proses bisnis manufaktur dan distribusi, mulai dari perencanaan produksi, pengelolaan gudang bahan baku dan produk jadi, hingga distribusi, penjualan, dan pelaporan kinerja.

## Fitur Utama

* **Dashboard Interaktif**: Menyediakan tampilan dashboard utama yang intuitif untuk mengakses berbagai modul.
* **Perencanaan Produksi**: Modul untuk mengelola rencana dan jadwal produksi.
* **Proses Produksi**: Memantau dan mengelola proses produksi secara *real-time*.
* **Gudang Bahan Baku**: Manajemen stok bahan mentah yang digunakan dalam proses produksi.
* **Gudang Produk Jadi**: Pengelolaan inventori produk jadi yang siap untuk didistribusikan.
* **Distribusi & Pengiriman**: Melacak dan mengelola proses logistik serta pengiriman produk.
* **Penjualan & Pelanggan**: Mengelola hubungan pelanggan (CRM) dan transaksi penjualan.
* **Laporan Bisnis & KPI**: Menyediakan analitik dan laporan kinerja utama (Key Performance Indicators) untuk pengambilan keputusan bisnis.
* **Sistem Login**: Mekanisme autentikasi pengguna untuk memastikan akses yang aman ke sistem.
* **Notifikasi & Status Sistem**: Indikator status sistem online/loading dan notifikasi pop-up untuk umpan balik pengguna.
* **Pintasan Keyboard**: Navigasi cepat antar modul menggunakan pintasan keyboard.

## Teknologi yang Digunakan

* **Frontend**:
    * HTML5 & CSS3 (dengan gaya yang mirip Tailwind CSS untuk desain responsif dan modern).
    * JavaScript (untuk interaktivitas dashboard, AJAX calls, dan manajemen sesi).
* **Backend (Integrasi API)**:
    * PHP (untuk modul login dan kemungkinan modul-modul lainnya di masing-masing folder).
    * Sistem ini dirancang untuk mengonsumsi API dari modul-modul terpisah yang berjalan di alamat IP yang berbeda (misalnya, `http://192.168.1.14/user_management_module/login.php`, `http://192.168.1.7/manajemen_barang/perencanaan_produksi/public/index.php`, dll.).
* **Database**:
    * MySQL (berdasarkan adanya file `dbsiakad` meskipun nama filenya menunjukkan sistem akademik, perlu dikonfirmasi apakah ini relevan atau ada database lain untuk SIMDB).
* **Library Eksternal**:
    * Font Awesome (untuk ikon-ikon yang memperkaya UI).

## Struktur Proyek