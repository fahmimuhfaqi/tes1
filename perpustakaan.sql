-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.21 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for perpustakaan_master
CREATE DATABASE IF NOT EXISTS `perpustakaan_master` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `perpustakaan_master`;

-- Dumping structure for table perpustakaan_master.tb_anggota
CREATE TABLE IF NOT EXISTS `tb_anggota` (
  `id_anggota` int NOT NULL AUTO_INCREMENT,
  `nim` int NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `prodi` varchar(75) NOT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table perpustakaan_master.tb_anggota: ~2 rows (approximately)
DELETE FROM `tb_anggota`;
/*!40000 ALTER TABLE `tb_anggota` DISABLE KEYS */;
INSERT INTO `tb_anggota` (`id_anggota`, `nim`, `nama_anggota`, `tempat_lahir`, `tgl_lahir`, `jk`, `prodi`) VALUES
	(2, 323432111, 'watiq', 'bandung', '1998-01-01', 'P', 'Teknik Management'),
	(3, 3432123, 'Rudi Tabuti', 'Palembang', '1998-07-02', 'L', 'Sistem Operasi');
/*!40000 ALTER TABLE `tb_anggota` ENABLE KEYS */;

-- Dumping structure for table perpustakaan_master.tb_buku
CREATE TABLE IF NOT EXISTS `tb_buku` (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul_buku` varchar(200) NOT NULL,
  `pengarang_buku` varchar(100) NOT NULL,
  `penerbit_buku` varchar(150) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `jumlah_buku` int NOT NULL,
  `lokasi` enum('Rak 1','Rak 2','Rak 3') NOT NULL,
  `cover` varchar(200) NOT NULL DEFAULT '',
  `tgl_input` date NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table perpustakaan_master.tb_buku: ~2 rows (approximately)
DELETE FROM `tb_buku`;
/*!40000 ALTER TABLE `tb_buku` DISABLE KEYS */;
INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `pengarang_buku`, `penerbit_buku`, `tahun_terbit`, `isbn`, `jumlah_buku`, `lokasi`, `cover`, `tgl_input`) VALUES
	(4, 'Belajar HTML', 'surya', 'Erlangga', '2018', '234312', 4, 'Rak 3', '', '2020-07-21'),
	(6, 'Belajar Codeigniter', 'Ridho', 'budi store', '2019', '45234521', 11, 'Rak 2', '', '2020-07-27'),
	(19, 'Cinta', 'Cinta', 'CInta', '1991', '123', 21, 'Rak 1', 'uploads/Cinta/software-store.jpg', '2020-10-16');
/*!40000 ALTER TABLE `tb_buku` ENABLE KEYS */;

-- Dumping structure for table perpustakaan_master.tb_transaksi
CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_buku` int NOT NULL,
  `nim_transaksi` int NOT NULL,
  `id_anggota` int NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table perpustakaan_master.tb_transaksi: ~3 rows (approximately)
DELETE FROM `tb_transaksi`;
/*!40000 ALTER TABLE `tb_transaksi` DISABLE KEYS */;
INSERT INTO `tb_transaksi` (`id_transaksi`, `id_buku`, `nim_transaksi`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
	(7, 4, 2, 2, '01-07-2020', '23-07-2020', 'kembali'),
	(8, 6, 3, 3, '01-07-2020', '5-07-2020', 'kembali'),
	(11, 4, 3, 3, '13-07-2020', '20-07-2020', 'kembali'),
	(12, 4, 3, 3, '16-10-2020', '30-10-2020', 'kembali'),
	(13, 4, 3, 3, '16-10-2020', '23-10-2020', 'kembali'),
	(14, 4, 3, 3, '16-10-2020', '23-10-2020', 'pinjam');
/*!40000 ALTER TABLE `tb_transaksi` ENABLE KEYS */;

-- Dumping structure for table perpustakaan_master.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table perpustakaan_master.tb_user: ~0 rows (approximately)
DELETE FROM `tb_user`;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `foto`) VALUES
	(1, 'admin', '$2y$10$x9zT.vZCNhVglerJ8b7PaeSu8XJl9pnoHQtxo9cthpQHQHAUk4cA2', 'Admin', ''),
	(2, 'fahmi', '$2y$10$dMVels48uSbonGAunnAnvuK6NIW2pAlTojM4A9lYquWGbl32EZNei', 'Fahmi', '5f0b28b0c14b3.jpg');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
