CREATE TABLE tb_customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  phone VARCHAR(20),
  address VARCHAR(255),
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO tb_customers (name, email, phone, address)
VALUES
('Roni Putra', 'roni@example.com', '081234567890', 'Padang, Sumatera Barat'),
('Siti Aminah', 'siti@example.com', '081298765432', 'Jakarta Selatan'),
('Budi Santoso', 'budi@example.com', '085212345678', 'Bandung, Jawa Barat');

