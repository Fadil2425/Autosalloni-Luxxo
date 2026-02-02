-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2026 at 07:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autosalloni-luxxosql`
--

-- --------------------------------------------------------

--
-- Table structure for table `makinat`
--

CREATE TABLE `makinat` (
  `id` int(11) NOT NULL,
  `emri` varchar(100) NOT NULL,
  `viti` int(4) NOT NULL,
  `kilometrat` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `makinat`
--

INSERT INTO `makinat` (`id`, `emri`, `viti`, `kilometrat`, `foto`, `logo`) VALUES
(19, 'Mercedes S-Class Maybach', 2025, '0 km', '../img/maybach.jpg', '../img/mercedes-benz-logo.png.webp'),
(20, 'Mercedes S-Class', 2018, '90,000 km', '../img/s-class.jpg', '../img/mercedes-benz-logo.png.webp'),
(21, 'Mercedes G-Class', 2025, '0 km', '../img/g-class.webp', '../img/mercedes-benz-logo.png.webp'),
(22, 'BMW 7 Series', 2025, '0 km', '../img/bmw7.avif', '../img/bmw-logo.png.webp'),
(23, 'BMW X7', 2024, '10,000 km', '../img/bmwx7.jpg', '../img/bmw-logo.png.webp'),
(24, 'BMW M4', 2024, '5,000 km', '../img/bmwm4.webp', '../img/bmw-logo.png.webp'),
(25, 'Audi S8', 2023, '20,000 km', '../img/s8.jpg', '../img/alogo.png'),
(26, 'Audi S7', 2022, '70,000 km', '../img/s7.jpg', '../img/alogo.png'),
(27, 'Audi Q8', 2023, '90,000 km', '../img/q8.avif', '../img/alogo.png'),
(28, 'Lamborghini Revuelto', 2025, '0 km', '../img/lambo1.jpg', '../img/lamborghini-logo.png.webp'),
(29, 'Lamborghini Aventador SVJ', 2022, '90,000 km', '../img/lambosvj.webp', '../img/lamborghini-logo.png.webp'),
(30, 'Lamborghini Urus', 2023, '70,000 km', '../img/lambourus.avif', '../img/lamborghini-logo.png.webp'),
(31, 'Ferrari SF90', 2024, '5,000 km', '../img/ferrarisf90.jpg', '../img/2025.png.webp'),
(32, 'Ferrari LaFerrari', 2018, '110,000 km', '../img/ferrarilaferrari.jpg', '../img/2025.png.webp'),
(33, 'Ferrari Superfast', 2020, '60,000 km', '../img/ferrarisuperfast.webp', '../img/2025.png.webp'),
(34, 'Porsche 911 GT3rs', 2023, '20,000 km', '../img/porchegt3rs.jpg', '../img/porsche-logo.png.webp'),
(35, 'Porsche 911 Carrera', 2022, '40,000 km', '../img/porche911carrera.jpg', '../img/porsche-logo.png.webp'),
(36, 'Porsche Cayenne', 2022, '100,000 km', '../img/porchecayenne.webp', '../img/porsche-logo.png.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `makinat`
--
ALTER TABLE `makinat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makinat`
--
ALTER TABLE `makinat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
