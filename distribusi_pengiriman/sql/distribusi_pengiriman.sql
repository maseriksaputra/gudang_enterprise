CREATE DATABASE IF NOT EXISTS distribusi_pengiriman;
USE distribusi_pengiriman;

CREATE TABLE pengiriman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tanggal DATE NOT NULL,
  nama_penerima VARCHAR(100) NOT NULL,
  alamat TEXT NOT NULL,
  status_pengiriman ENUM('diproses', 'dikirim', 'selesai') DEFAULT 'diproses'
);
