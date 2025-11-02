-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_simplecrud
CREATE DATABASE IF NOT EXISTS `db_scmascrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `db_scmascrud`;

-- Tabel karyawan (pengganti tb_Kariyawan)
CREATE TABLE IF NOT EXISTS `tb_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_produk` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` text COLLATE utf8mb4_unicode_ci NOT NULL,
 
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_mahasiswa: ~0 rows (approximately)

-- Dumping structure for table db_simplecrud.tb_prodi
CREATE TABLE IF NOT EXISTS `tb_kategory` (
  `id_kategory` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategory` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_prodi: ~9 rows (approximately)
INSERT INTO `tb_produk` (`id_kategory`, `nama_kategory`) VALUES ### nama_produk 
('456', 'sirih hitam'),
('789', 'tunas sirih'),
('10012', 'sirih wangi'),
('48210', 'sirih daun'),

