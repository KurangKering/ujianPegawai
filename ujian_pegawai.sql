-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5169
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ujian_pegawai
CREATE DATABASE IF NOT EXISTS `ujian_pegawai` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ujian_pegawai`;

-- Dumping structure for table ujian_pegawai.calon_pegawai
CREATE TABLE IF NOT EXISTS `calon_pegawai` (
  `no_ktp` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `bagian` enum('Administrator','Keamanan') NOT NULL,
  PRIMARY KEY (`no_ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.calon_pegawai: ~0 rows (approximately)
/*!40000 ALTER TABLE `calon_pegawai` DISABLE KEYS */;
/*!40000 ALTER TABLE `calon_pegawai` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.file_lamaran
CREATE TABLE IF NOT EXISTS `file_lamaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ktp_calon_pegawai` varchar(16) NOT NULL,
  `file_cv` int(11) DEFAULT NULL,
  `file_ijazah` int(11) DEFAULT NULL,
  `file_photo` int(11) DEFAULT NULL,
  `file_surat_lamaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_file_lamaran_calon_pegawai` (`ktp_calon_pegawai`),
  CONSTRAINT `FK_file_lamaran_calon_pegawai` FOREIGN KEY (`ktp_calon_pegawai`) REFERENCES `calon_pegawai` (`no_ktp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.file_lamaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `file_lamaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_lamaran` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.file_lamaran_sertifikat
CREATE TABLE IF NOT EXISTS `file_lamaran_sertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ktp_calon_pegawai` varchar(50) NOT NULL,
  `file_sertifikat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_file_lamaran_sertifikat_calon_pegawai` (`ktp_calon_pegawai`),
  CONSTRAINT `FK_file_lamaran_sertifikat_calon_pegawai` FOREIGN KEY (`ktp_calon_pegawai`) REFERENCES `calon_pegawai` (`no_ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.file_lamaran_sertifikat: ~0 rows (approximately)
/*!40000 ALTER TABLE `file_lamaran_sertifikat` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_lamaran_sertifikat` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.konfig_lamaran
CREATE TABLE IF NOT EXISTS `konfig_lamaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kuota_administrasi` int(11) NOT NULL,
  `kuota_keamanan` int(11) NOT NULL,
  `tanggal_ujian_akademik` date NOT NULL,
  `tanggal_ujian_psikotest` date NOT NULL,
  `tanggal_ujian_wawancara` date NOT NULL,
  `tanggal_buka_lamaran` datetime NOT NULL,
  `tanggal_tutup_lamaran` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.konfig_lamaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `konfig_lamaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `konfig_lamaran` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.master_pelajaran_akademik
CREATE TABLE IF NOT EXISTS `master_pelajaran_akademik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelajaran` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.master_pelajaran_akademik: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_pelajaran_akademik` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_pelajaran_akademik` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.nilai_calon_pegawai
CREATE TABLE IF NOT EXISTS `nilai_calon_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_ktp` varchar(50) NOT NULL,
  `nilai_akademik` int(11) DEFAULT '0',
  `nilai_psikotest` int(11) DEFAULT '0',
  `nilai_wawancara` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_nilai_calon_pegawai_calon_pegawai` (`no_ktp`),
  CONSTRAINT `FK_nilai_calon_pegawai_calon_pegawai` FOREIGN KEY (`no_ktp`) REFERENCES `calon_pegawai` (`no_ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.nilai_calon_pegawai: ~0 rows (approximately)
/*!40000 ALTER TABLE `nilai_calon_pegawai` DISABLE KEYS */;
/*!40000 ALTER TABLE `nilai_calon_pegawai` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.personalia
CREATE TABLE IF NOT EXISTS `personalia` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.personalia: ~0 rows (approximately)
/*!40000 ALTER TABLE `personalia` DISABLE KEYS */;
REPLACE INTO `personalia` (`username`, `password`, `nama`) VALUES
	('admin', 'admin', 'admin');
/*!40000 ALTER TABLE `personalia` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.soal_ujian_akademik
CREATE TABLE IF NOT EXISTS `soal_ujian_akademik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_pelajaran` int(11) NOT NULL,
  `soal` int(11) NOT NULL,
  `pilihan_A` int(11) NOT NULL,
  `pilihan_B` int(11) NOT NULL,
  `pilihan_C` int(11) NOT NULL,
  `pilihan_D` int(11) NOT NULL,
  `jawaban` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_soal_ujian_akademik_master_pelajaran_akademik` (`id_master_pelajaran`),
  CONSTRAINT `FK_soal_ujian_akademik_master_pelajaran_akademik` FOREIGN KEY (`id_master_pelajaran`) REFERENCES `master_pelajaran_akademik` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.soal_ujian_akademik: ~0 rows (approximately)
/*!40000 ALTER TABLE `soal_ujian_akademik` DISABLE KEYS */;
/*!40000 ALTER TABLE `soal_ujian_akademik` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
