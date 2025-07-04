CREATE DATABASE IF NOT EXISTS penjualan_pelanggan;
USE penjualan_pelanggan;

CREATE TABLE pelanggan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  alamat TEXT NOT NULL,
  no_hp VARCHAR(20)
);

CREATE TABLE penjualan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tanggal DATE NOT NULL,
  pelanggan_id INT NOT NULL,
  produk VARCHAR(100) NOT NULL,
  jumlah INT NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);
