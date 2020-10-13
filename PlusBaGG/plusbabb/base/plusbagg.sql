-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2019 at 05:27 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plusbagg`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(57, 'Bileteras cortas'),
(58, 'Billeteras largas'),
(17, 'Blusa cola de pato'),
(12, 'Blusa con abertura'),
(15, 'Blusa cruzada'),
(16, 'Blusa de amarre'),
(13, 'Blusa manga corta'),
(14, 'Blusa manga larga'),
(9, 'Blusa mesh'),
(7, 'Blusa princess vest'),
(4, 'Blusa sleeveless'),
(8, 'Blusa sports'),
(2, 'Blusa sports bra'),
(10, 'Blusa straple'),
(6, 'Blusa t-shirt'),
(3, 'Blusa tank top'),
(11, 'Blusa tres cuartos'),
(1, 'Blusa tube top'),
(5, 'Blusa v-neck'),
(61, 'Body manga corta'),
(62, 'Body manga larga'),
(46, 'Bolso casual'),
(47, 'Bolso deportivo'),
(48, 'Bolso elegante'),
(59, 'Canguros'),
(51, 'Carteras'),
(31, 'Chamarra de cuero'),
(34, 'Chaqueta acolchada'),
(35, 'Chaqueta baxter'),
(32, 'Chaqueta de jeans'),
(36, 'Chaqueta lantana'),
(33, 'Chaqueta sports'),
(55, 'Cosmetiqueras grandes'),
(56, 'Cosmetiqueras pequeñas'),
(29, 'Gabanes cortos'),
(28, 'Gabanes largos'),
(44, 'Jeans boyfriends'),
(40, 'Jeans descaderado'),
(45, 'Jeans mom'),
(43, 'Jeans skinny'),
(42, 'Jeans strainght'),
(41, 'Jeans tiro alto'),
(30, 'Kimonos'),
(52, 'Llaveros grandes'),
(53, 'Llaveros pequeños'),
(50, 'Mochila casual'),
(49, 'Mochila con lentejuelas'),
(54, 'Monederos'),
(37, 'Pantalon bombacho'),
(39, 'Pantalon recto'),
(38, 'Pantalon tubo'),
(26, 'saco con escote joya'),
(27, 'saco con frente asimetrico'),
(25, 'saco cuello convertible'),
(24, 'saco cuello mandarin'),
(21, 'saco cuello redondo'),
(22, 'saco cuello sastre'),
(23, 'saco cuello sin solapa'),
(19, 'saco cuello tortuga'),
(20, 'saco escote v');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(3, 'Billetera corta.jpg', 'image/jpeg'),
(4, 'Billetera larga.jpeg', 'image/jpeg'),
(5, 'Blusa con abertura.jpg', 'image/jpeg'),
(6, 'Blusa princess vest.jpg', 'image/jpeg'),
(7, 'Blusa sleeveless.jpg', 'image/jpeg'),
(8, 'Blusa sport bra.jpg', 'image/jpeg'),
(9, 'Blusa sports.jpg', 'image/jpeg'),
(10, 'Blusa straple.jpg', 'image/jpeg'),
(11, 'Blusa tank top.jpg', 'image/jpeg'),
(12, 'Blusa t-shirt.jpg', 'image/jpeg'),
(13, 'Blusa tube top.jpg', 'image/jpeg'),
(14, 'Blusa v-neck.jpg', 'image/jpeg'),
(16, 'Bolso elegante.jpg', 'image/jpeg'),
(17, 'Canguros.jpg', 'image/jpeg'),
(18, 'Carteras.jpg', 'image/jpeg'),
(19, 'Chaqueta lantana.jpg', 'image/jpeg'),
(20, 'Cosmetiquera pequeña.png', 'image/png'),
(21, 'Jeans boyfriends.jpeg', 'image/jpeg'),
(22, 'Jeans descaderado.jpg', 'image/jpeg'),
(23, 'Jeans mom.jpg', 'image/jpeg'),
(24, 'Jeans skinny.jpg', 'image/jpeg'),
(25, 'Jeans strainght.jpg', 'image/jpeg'),
(26, 'Jeans tiro alto.jpg', 'image/jpeg'),
(27, 'Llaveros grandes.jpg', 'image/jpeg'),
(28, 'Llaveros pequeños.jpg', 'image/jpeg'),
(29, 'Mochila con lentejuelas.jpg', 'image/jpeg'),
(30, 'Monederos.jpg', 'image/jpeg'),
(31, 'Pantalon bombacho.jpg', 'image/jpeg'),
(32, 'Pantalon recto.jpg', 'image/jpeg'),
(33, 'Pantalon tubo.jpg', 'image/jpeg'),
(34, 'Blusa mesh.jpg', 'image/jpeg'),
(35, 'Blusa tres cuartos.jpg', 'image/jpeg'),
(36, 'Cosmetiquera grande.jpg', 'image/jpeg'),
(37, 'Mochila casual.jpg', 'image/jpeg'),
(38, 'Bolso casual.jpg', 'image/jpeg'),
(39, 'Bodys.jpg', 'image/jpeg'),
(40, 'Saco cuello tortuga.jpg', 'image/jpeg'),
(41, 'Gabanes largos.jpg', 'image/jpeg'),
(42, 'Gabanes cortos.jpg', 'image/jpeg'),
(43, 'Kimonos.jpg', 'image/jpeg'),
(44, 'Chamarra de cuero.jpg', 'image/jpeg'),
(45, 'Chaqueta de jeans.jpg', 'image/jpeg'),
(46, 'Bolso deportivo.jpg', 'image/jpeg'),
(47, 'Blusa manga corta.jpg', 'image/jpeg'),
(48, 'Blusa manga larga.jpg', 'image/jpeg'),
(49, 'Blusa cruzada.jpg', 'image/jpeg'),
(50, 'Blusa de amarre.jpg', 'image/jpeg'),
(51, 'Blusa cola de pato.jpg', 'image/jpeg'),
(52, 'Saco escote v.jpg', 'image/jpeg'),
(53, 'Saco cuello redondo.jpg', 'image/jpeg'),
(54, 'Saco cuello sin solapa.jpg', 'image/jpeg'),
(55, 'Saco cuello mandarin.jpg', 'image/jpeg'),
(56, 'Saco cuello convertible.jpg', 'image/jpeg'),
(57, 'Saco con escote joya.jpg', 'image/jpeg'),
(58, 'Saco con frente asimetrico.jpg', 'image/jpeg'),
(60, 'Chaqueta acoholchada.jpg', 'image/jpeg'),
(61, 'Chaqueta sports.jpg', 'image/jpeg'),
(62, 'Body manga corta.jpg', 'image/jpeg'),
(63, 'Body manga larga.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` mediumint(200) DEFAULT NULL,
  `sale_price` mediumint(200) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL,
  `status` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `status`) VALUES
(7, 'Bolso', '15', 60, 55, 46, 38, '2019-10-30 13:43:22', 0),
(10, 'Mochila', '20', 90, 85, 49, 29, '2019-10-30 13:46:40', 0),
(12, 'Carteras', '22', 21, 25, 51, 18, '2019-10-30 13:48:18', 0),
(13, 'Llaveros', '17', 11, 15, 52, 27, '2019-10-30 13:50:05', 0),
(15, 'Monederos', '13', 8, 12, 54, 30, '2019-10-30 13:50:54', 0),
(16, 'Cosmetiqueras', '28', 34, 38, 55, 36, '2019-10-30 13:51:29', 0),
(18, 'Billeteras', '23', 19, 22, 57, 3, '2019-10-30 13:52:07', 0),
(20, 'Canguros', '12', 27, 30, 59, 17, '2019-10-30 13:52:50', 0),
(21, 'Blusas', '24', 57, 60, 1, 13, '2019-10-30 13:53:21', 0),
(38, 'Sacos', '50', 73, 70, 19, 40, '2019-10-30 13:59:58', 0),
(48, 'Gabanes', '25', 86, 89, 28, 41, '2019-10-30 14:04:27', 0),
(50, 'Kimonos', '30', 38, 42, 30, 43, '2019-10-30 14:05:01', 0),
(51, 'Chamarras', '24', 65, 68, 31, 44, '2019-10-30 14:05:25', 0),
(52, 'Chaquetas', '48', 62, 66, 32, 45, '2019-10-30 14:05:44', 0),
(56, 'Pantalones', '17', 79, 83, 37, 31, '2019-10-30 14:07:14', 0),
(59, 'Jeans', '20', 32, 35, 40, 22, '2019-10-30 14:08:06', 0),
(69, 'Body', '12', 27, 30, 61, 62, '2019-10-30 16:51:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) CHARACTER SET armscii8 DEFAULT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `activacion` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `token_password` varchar(40) DEFAULT 'Default Null',
  `password_request` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `user_level`, `image`, `status`, `last_login`, `activacion`, `token`, `token_password`, `password_request`) VALUES
(1, 'Adriana', 'Administrador', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'aanzola5@misena.edu.co', 1, 'x6xw84j1.jpg', 1, '2019-10-30 17:23:44', NULL, NULL, 'Default Null', 0),
(3, 'James', 'Empleado', 'bfe54caa6d483cc3887dce9d1b8eb91408f1ea7a', NULL, 3, 'no_image.jpg', 1, '2019-09-05 02:36:46', NULL, NULL, 'Default Null', 0),
(14, 'Leidy', 'Empleada', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'aanzola5@misena.edu.co', 3, 'no_image.jpg', 1, '2019-10-30 17:24:28', NULL, NULL, 'Default Null', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(3, 'User', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
