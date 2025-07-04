-- Buat database
CREATE DATABASE IF NOT EXISTS manajemen_pengguna;
USE manajemen_pengguna;

-- Tabel roles
CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL
);

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role_id INT,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Isi data awal
INSERT INTO roles (name) VALUES ('admin');

-- Password: admin123 (di-hash dengan bcrypt)
INSERT INTO users (username, password, role_id)
VALUES (
  'admin',
  '$2y$10$ghecWw1rCIyMd.8/7sflEOaF2oPqY2q6pKZHyiMkPAkz4B8m0bt1C',
  1
);
