CREATE TABLE tb_produk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_produk VARCHAR(20) NOT NULL UNIQUE,
  nama_produk VARCHAR(100) NOT NULL,
  kategori VARCHAR(50),
  deskripsi TEXT,
  harga DECIMAL(12,2) NOT NULL,
  stok INT DEFAULT 0,
  satuan VARCHAR(20),
  berat DECIMAL(10,2),
  gambar VARCHAR(255)
);

INSERT INTO tb_produk 
(kode_produk, nama_produk, kategori, deskripsi, harga, stok, satuan, berat, gambar)
VALUES
('PRD001', 'Kopi Arabika Gayo 250gr', 'Minuman', 'Kopi arabika asli Gayo, aroma kuat dan cita rasa khas.', 65000, 25, 'Paket', 0.25, 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG'),
('PRD002', 'Teh Hijau Organik 200gr', 'Minuman', 'Teh hijau organik dengan aroma segar dan menenangkan.', 45000, 40, 'Paket', 0.20, 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG'),
('PRD003', 'Madu Hutan Sumatera 500ml', 'Makanan', 'Madu alami dari hutan Sumatera tanpa campuran.', 85000, 15, 'Botol', 0.50, 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG'),
('PRD004', 'Minyak Kelapa Murni 1L', 'Kesehatan', 'Minyak kelapa murni (VCO) 100% alami, cocok untuk konsumsi dan perawatan rambut.', 95000, 10, 'Botol', 1.00, 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG')

