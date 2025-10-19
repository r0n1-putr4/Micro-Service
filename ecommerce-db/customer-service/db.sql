CREATE TABLE `tb_customers` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,  
  `avatar` varchar(255) DEFAULT NULL
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO tb_customers (name, email, phone, address,avatar)
VALUES
('Roni Putra', 'roni@example.com', '081234567890', 'Padang, Sumatera Barat',''),
('Siti Aminah', 'siti@example.com', '081298765432', 'Jakarta Selatan',''),
('Budi Santoso', 'budi@example.com', '085212345678', 'Bandung, Jawa Barat','');

