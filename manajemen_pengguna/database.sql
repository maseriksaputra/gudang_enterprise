CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin') NOT NULL DEFAULT 'admin'
);

-- Isi data awal
INSERT INTO users (username, password, role)
VALUES ('admin', '$2y$10$ghecWw1rCIyMd.8/7sflEOaF2oPqY2q6pKZHyiMkPAkz4B8m0bt1C', 'admin');
-- Password hash dari: admin123
