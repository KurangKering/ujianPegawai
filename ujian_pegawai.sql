-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ujian_pegawai
DROP DATABASE IF EXISTS `ujian_pegawai`;
CREATE DATABASE IF NOT EXISTS `ujian_pegawai` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ujian_pegawai`;

-- Dumping structure for table ujian_pegawai.daftar_nilai
DROP TABLE IF EXISTS `daftar_nilai`;
CREATE TABLE IF NOT EXISTS `daftar_nilai` (
  `nik` char(16) NOT NULL,
  `nilai_akademik` decimal(10,0) NOT NULL DEFAULT '0',
  `nilai_psikotest` decimal(10,0) NOT NULL DEFAULT '0',
  `nilai_w_rektor` decimal(10,0) NOT NULL DEFAULT '0',
  `nilai_w_wr_1` decimal(10,0) NOT NULL DEFAULT '0',
  `nilai_w_wr_2` decimal(10,0) NOT NULL DEFAULT '0',
  `nilai_w_wr_3` decimal(10,0) NOT NULL DEFAULT '0',
  `nilai_w_yayasan` decimal(10,0) NOT NULL DEFAULT '0',
  KEY `FK_daftar_nilai_pelamar` (`nik`),
  CONSTRAINT `FK_daftar_nilai_pelamar` FOREIGN KEY (`nik`) REFERENCES `pelamar` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.daftar_nilai: ~0 rows (approximately)
DELETE FROM `daftar_nilai`;
/*!40000 ALTER TABLE `daftar_nilai` DISABLE KEYS */;
INSERT INTO `daftar_nilai` (`nik`, `nilai_akademik`, `nilai_psikotest`, `nilai_w_rektor`, `nilai_w_wr_1`, `nilai_w_wr_2`, `nilai_w_wr_3`, `nilai_w_yayasan`) VALUES
	('1471101009950001', 100, 88, 20, 20, 20, 20, 20);
/*!40000 ALTER TABLE `daftar_nilai` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.detail_jabatan_periode
DROP TABLE IF EXISTS `detail_jabatan_periode`;
CREATE TABLE IF NOT EXISTS `detail_jabatan_periode` (
  `id_periode` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_subbag` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  UNIQUE KEY `id_periode_id_fakultas_id_subbag` (`id_periode`,`id_fakultas`,`id_subbag`),
  KEY `FK_detail_jabatan_periode_mst_fakultas` (`id_fakultas`),
  KEY `FK_detail_jabatan_periode_mst_subbag` (`id_subbag`),
  CONSTRAINT `FK_detail_jabatan_periode_konfig_periode` FOREIGN KEY (`id_periode`) REFERENCES `konfig_periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detail_jabatan_periode_mst_fakultas` FOREIGN KEY (`id_fakultas`) REFERENCES `mst_fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detail_jabatan_periode_mst_subbag` FOREIGN KEY (`id_subbag`) REFERENCES `mst_subbag` (`id_subbag`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.detail_jabatan_periode: ~28 rows (approximately)
DELETE FROM `detail_jabatan_periode`;
/*!40000 ALTER TABLE `detail_jabatan_periode` DISABLE KEYS */;
INSERT INTO `detail_jabatan_periode` (`id_periode`, `id_fakultas`, `id_subbag`, `jumlah`) VALUES
	(19, 1, 1, 2),
	(19, 1, 2, 2),
	(21, 1, 1, 2),
	(21, 1, 2, 3),
	(22, 1, 1, 2),
	(22, 1, 2, 3),
	(23, 1, 1, 2),
	(23, 1, 2, 3),
	(24, 1, 1, 2),
	(24, 1, 2, 3),
	(25, 1, 1, 2),
	(25, 1, 2, 3),
	(26, 1, 1, 2),
	(26, 1, 2, 3),
	(27, 1, 1, 2),
	(27, 1, 2, 3),
	(28, 1, 1, 2),
	(28, 1, 2, 3),
	(29, 1, 1, 2),
	(29, 1, 2, 3),
	(30, 1, 1, 2),
	(30, 1, 2, 3),
	(31, 1, 1, 2),
	(31, 1, 2, 3),
	(32, 1, 1, 2),
	(32, 1, 2, 3),
	(33, 1, 1, 2),
	(33, 1, 2, 3);
/*!40000 ALTER TABLE `detail_jabatan_periode` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.konfig_periode
DROP TABLE IF EXISTS `konfig_periode`;
CREATE TABLE IF NOT EXISTS `konfig_periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_ujian_akademik` datetime NOT NULL,
  `tanggal_ujian_psikotest` datetime NOT NULL,
  `tanggal_ujian_wawancara` datetime NOT NULL,
  `tanggal_buka_lamaran` datetime NOT NULL,
  `tanggal_tutup_lamaran` datetime NOT NULL,
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.konfig_periode: ~18 rows (approximately)
DELETE FROM `konfig_periode`;
/*!40000 ALTER TABLE `konfig_periode` DISABLE KEYS */;
INSERT INTO `konfig_periode` (`id_periode`, `tanggal_ujian_akademik`, `tanggal_ujian_psikotest`, `tanggal_ujian_wawancara`, `tanggal_buka_lamaran`, `tanggal_tutup_lamaran`) VALUES
	(16, '2018-02-14 09:00:00', '2018-02-15 09:00:00', '2018-02-16 09:00:00', '2018-02-10 00:00:00', '2018-02-13 00:00:00'),
	(17, '2018-02-14 09:00:00', '2018-02-15 09:00:00', '2018-02-16 09:00:00', '2018-02-10 00:00:00', '2018-02-13 00:00:00'),
	(18, '2018-02-14 09:00:00', '2018-02-15 09:00:00', '2018-02-16 09:00:00', '2018-02-10 00:00:00', '2018-02-13 00:00:00'),
	(19, '2018-02-14 09:00:00', '2018-02-15 09:00:00', '2018-02-16 09:00:00', '2018-02-10 00:00:00', '2018-02-13 00:00:00'),
	(20, '2018-02-14 09:00:00', '2018-02-15 09:00:00', '2018-02-16 09:00:00', '2018-02-10 00:00:00', '2018-02-13 00:00:00'),
	(21, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(22, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(23, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(24, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(25, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(26, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(27, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(28, '2018-03-05 10:51:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(29, '2018-03-05 10:00:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(30, '2018-03-05 10:00:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(31, '2018-03-05 10:00:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(32, '2018-03-05 10:00:00', '2018-03-06 10:00:00', '2018-03-08 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00'),
	(33, '2018-03-12 15:00:00', '2018-03-13 10:00:00', '2018-03-14 10:00:00', '2018-03-01 00:00:00', '2018-03-04 00:00:00');
/*!40000 ALTER TABLE `konfig_periode` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.konfig_umum
DROP TABLE IF EXISTS `konfig_umum`;
CREATE TABLE IF NOT EXISTS `konfig_umum` (
  `persyaratan_umum` text,
  `lokasi_ujian_akademik` varchar(50) DEFAULT NULL,
  `lokasi_ujian_psikotest` varchar(50) DEFAULT NULL,
  `lokasi_ujian_wawancara` varchar(50) DEFAULT NULL,
  `durasi_ujian_akademik` tinyint(4) DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.konfig_umum: ~0 rows (approximately)
DELETE FROM `konfig_umum`;
/*!40000 ALTER TABLE `konfig_umum` DISABLE KEYS */;
INSERT INTO `konfig_umum` (`persyaratan_umum`, `lokasi_ujian_akademik`, `lokasi_ujian_psikotest`, `lokasi_ujian_wawancara`, `durasi_ujian_akademik`, `aktif`) VALUES
	('> Warga Negara Republik Indonesia \r\n> Berusia Minimal 18 Tahun \r\n> Sehat Jamani dan Rohani serta Bebas Narkoba \r\n> Berkelakuan Baik \r\n> Tidak Pernah diberhentikan secara Tidak Hormat \r\n> Tidak berkedudukan sebagai CPNS atau PNS \r\n> Pendidikan Minimal S1 Dengan IPK Minimal 3.00 \r\n\r\nMengunggah Berkas Lamaran Yang Terdiri Dari : \r\n> Surat Lamaran \r\n> Fotokopi Ijazah dan transkrip nilai yang sudah dilegalisir \r\n> Fotokopi KTP \r\n> Surat Keterangan Sehat dari Rumah Sakit/Dokter \r\n> Surat Bebas Narkoba dari Rumah Sakit/Dokter \r\n> Surat Berkelakuan Baik dari Kepolisian \r\n\r\nSemua Berkas Lamaran Dijadikan 1 File Berformat PDF Dan Di Upload Pada Saat Pengajuan. ', 'Laboratorium IT', 'Ruang Psikologi', 'Rektor Lantai 222', 50, 'Y');
/*!40000 ALTER TABLE `konfig_umum` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.log_ujian_akademik
DROP TABLE IF EXISTS `log_ujian_akademik`;
CREATE TABLE IF NOT EXISTS `log_ujian_akademik` (
  `nik` char(16) NOT NULL,
  `jawaban_dipilih` text NOT NULL,
  `list_matpel` text NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`nik`),
  CONSTRAINT `FK_log_ujian_akademik_pelamar` FOREIGN KEY (`nik`) REFERENCES `pelamar` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.log_ujian_akademik: ~0 rows (approximately)
DELETE FROM `log_ujian_akademik`;
/*!40000 ALTER TABLE `log_ujian_akademik` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_ujian_akademik` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.mst_fakultas
DROP TABLE IF EXISTS `mst_fakultas`;
CREATE TABLE IF NOT EXISTS `mst_fakultas` (
  `id_fakultas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(100) NOT NULL,
  PRIMARY KEY (`id_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.mst_fakultas: ~10 rows (approximately)
DELETE FROM `mst_fakultas`;
/*!40000 ALTER TABLE `mst_fakultas` DISABLE KEYS */;
INSERT INTO `mst_fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
	(1, 'Fakultas Hukum'),
	(2, 'Fakultas Agama Islam'),
	(3, 'Fakultas Teknik'),
	(4, 'Fakultas Pertanian'),
	(5, 'Fakultas Ekonomi'),
	(6, 'Fakultas Ilmu Keguruan dan Ilmu Pendidikan'),
	(7, 'Fakultas Ilmu Sosial Dan Ilmu Politik'),
	(8, 'Fakultas Psikologi'),
	(9, 'Fakultas Ilmu Komunikasi'),
	(10, 'Pascasarjana');
/*!40000 ALTER TABLE `mst_fakultas` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.mst_pelajaran_akademik
DROP TABLE IF EXISTS `mst_pelajaran_akademik`;
CREATE TABLE IF NOT EXISTS `mst_pelajaran_akademik` (
  `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelajaran` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pelajaran`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.mst_pelajaran_akademik: ~5 rows (approximately)
DELETE FROM `mst_pelajaran_akademik`;
/*!40000 ALTER TABLE `mst_pelajaran_akademik` DISABLE KEYS */;
INSERT INTO `mst_pelajaran_akademik` (`id_pelajaran`, `nama_pelajaran`) VALUES
	(1, 'Agama'),
	(2, 'Bahasa Indonesia'),
	(3, 'Bahasa Inggris'),
	(4, 'Pancasila'),
	(5, 'Matematika');
/*!40000 ALTER TABLE `mst_pelajaran_akademik` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.mst_subbag
DROP TABLE IF EXISTS `mst_subbag`;
CREATE TABLE IF NOT EXISTS `mst_subbag` (
  `id_subbag` int(11) NOT NULL AUTO_INCREMENT,
  `nama_subbag` varchar(100) NOT NULL,
  PRIMARY KEY (`id_subbag`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.mst_subbag: ~5 rows (approximately)
DELETE FROM `mst_subbag`;
/*!40000 ALTER TABLE `mst_subbag` DISABLE KEYS */;
INSERT INTO `mst_subbag` (`id_subbag`, `nama_subbag`) VALUES
	(1, 'Akademis & Kemahasiswaan'),
	(2, 'Umum & Kepegawaian'),
	(3, 'Ekspedisi & Agenda'),
	(4, 'Pelayanan Perpustakaan'),
	(5, 'Sekretariat Dekanat');
/*!40000 ALTER TABLE `mst_subbag` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.mst_tingkatan
DROP TABLE IF EXISTS `mst_tingkatan`;
CREATE TABLE IF NOT EXISTS `mst_tingkatan` (
  `id_tingkatan` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tingkatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.mst_tingkatan: ~6 rows (approximately)
DELETE FROM `mst_tingkatan`;
/*!40000 ALTER TABLE `mst_tingkatan` DISABLE KEYS */;
INSERT INTO `mst_tingkatan` (`id_tingkatan`, `keterangan`) VALUES
	(-1, 'Ditolak'),
	(0, 'Belum Verifikasi'),
	(1, 'Tahap 1'),
	(2, 'Tahap 2'),
	(3, 'Tahap 3'),
	(4, 'Diterima');
/*!40000 ALTER TABLE `mst_tingkatan` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.pelamar
DROP TABLE IF EXISTS `pelamar`;
CREATE TABLE IF NOT EXISTS `pelamar` (
  `nik` char(16) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `id_subbag` int(11) NOT NULL,
  `file_photo` varchar(50) NOT NULL,
  `file_lamaran` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`nik`),
  KEY `FK_pelamar_konfig_periode` (`id_periode`),
  KEY `FK_pelamar_tingkatan` (`status`),
  KEY `FK_pelamar_jabatan` (`id_subbag`),
  KEY `FK_pelamar_mst_fakultas` (`id_fakultas`),
  CONSTRAINT `FK_pelamar_jabatan` FOREIGN KEY (`id_subbag`) REFERENCES `mst_subbag` (`id_subbag`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pelamar_konfig_periode` FOREIGN KEY (`id_periode`) REFERENCES `konfig_periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pelamar_mst_fakultas` FOREIGN KEY (`id_fakultas`) REFERENCES `mst_fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pelamar_tingkatan` FOREIGN KEY (`status`) REFERENCES `mst_tingkatan` (`id_tingkatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.pelamar: ~1 rows (approximately)
DELETE FROM `pelamar`;
/*!40000 ALTER TABLE `pelamar` DISABLE KEYS */;
INSERT INTO `pelamar` (`nik`, `id_periode`, `id_fakultas`, `nama`, `email`, `status`, `id_subbag`, `file_photo`, `file_lamaran`, `date_created`) VALUES
	('1471101009950001', 33, 1, 'Ilham Rahmadhani', 'cybercature@gmail.com', 4, 2, '1471101009950001_PHOTO.jpg', '1471101009950001_FILE_LAMARAN.pdf', '2018-03-01 02:31:32');
/*!40000 ALTER TABLE `pelamar` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.personalia
DROP TABLE IF EXISTS `personalia`;
CREATE TABLE IF NOT EXISTS `personalia` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.personalia: ~0 rows (approximately)
DELETE FROM `personalia`;
/*!40000 ALTER TABLE `personalia` DISABLE KEYS */;
INSERT INTO `personalia` (`username`, `password`, `keterangan`) VALUES
	('admin', 'admin', '');
/*!40000 ALTER TABLE `personalia` ENABLE KEYS */;

-- Dumping structure for table ujian_pegawai.soal_ujian_akademik
DROP TABLE IF EXISTS `soal_ujian_akademik`;
CREATE TABLE IF NOT EXISTS `soal_ujian_akademik` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelajaran` int(11) NOT NULL,
  `soal` text NOT NULL,
  `pilihan_A` varchar(50) NOT NULL,
  `pilihan_B` varchar(50) NOT NULL,
  `pilihan_C` varchar(50) NOT NULL,
  `pilihan_D` varchar(50) NOT NULL,
  `jawaban` char(1) NOT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `FK_soal_ujian_akademik_mst_pelajaran_akademik` (`id_pelajaran`),
  CONSTRAINT `FK_soal_ujian_akademik_mst_pelajaran_akademik` FOREIGN KEY (`id_pelajaran`) REFERENCES `mst_pelajaran_akademik` (`id_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table ujian_pegawai.soal_ujian_akademik: ~8 rows (approximately)
DELETE FROM `soal_ujian_akademik`;
/*!40000 ALTER TABLE `soal_ujian_akademik` DISABLE KEYS */;
INSERT INTO `soal_ujian_akademik` (`id_soal`, `id_pelajaran`, `soal`, `pilihan_A`, `pilihan_B`, `pilihan_C`, `pilihan_D`, `jawaban`) VALUES
	(3, 1, 'Arti fana adalah', 'Kekal', 'Tidak Kekal', 'Abadi', 'Selamanya', 'B'),
	(11, 3, 'I know Is ', 'hmm', 'hmmmm', 'hmmmmmm', 'hmmmmmmmmmm', 'B'),
	(12, 4, 'sila ke  4 pancasila', 'asfasfas', 'fasfasfas', 'asfasd', 'asdfasf', 'D'),
	(13, 5, '1 + 1 = ', '2', '3', '4', '5', 'A'),
	(15, 1, 'Allah memiliki sifat Al Karim, artinya Allah Maha', 'Pemberi keamanan', 'Akhir', 'Kokoh', 'Adil', 'B'),
	(16, 1, 'Allah memiki sifat Al Karim, yang tercantum dalam surah', 'Al Hadid ayat 3', 'Al A’raf ayat 180', 'An Naml ayt 40', 'Taha ayat 8', 'C'),
	(17, 1, 'Allah memiliki sifat Al Matin, artinya Allah Maha', 'Pemberi Keamanan', 'Mulia', 'Adil', 'Kokoh', 'D'),
	(18, 1, 'Allah memiliki sifat Al Matin, yang tercantum dalam surat', 'Al Hadid ayat 3', 'Al A’raf ayat 180', 'Az Zariyat ayat 58', 'Taha ayat 8', 'C');
/*!40000 ALTER TABLE `soal_ujian_akademik` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
