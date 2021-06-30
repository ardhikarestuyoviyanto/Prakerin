/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - db_prakerin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_prakerin` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_prakerin`;

/*Table structure for table `absensi` */

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `status` enum('hadir','sakit','ijin','alfa') DEFAULT NULL,
  `id_penempatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_absen`),
  KEY `IdPenempatan` (`id_penempatan`),
  CONSTRAINT `IdPenempatan` FOREIGN KEY (`id_penempatan`) REFERENCES `penempatan` (`id_penempatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `absensi` */

insert  into `absensi`(`id_absen`,`tgl`,`status`,`id_penempatan`) values 
(1,'2021-06-23','sakit',9),
(2,'2021-06-23','hadir',8),
(5,'2021-06-24','hadir',9),
(6,'2021-06-24','hadir',8),
(7,'2021-06-23','hadir',12),
(8,'2021-06-23','alfa',7),
(9,'2021-06-23','hadir',6),
(10,'2021-06-24','hadir',12),
(11,'2021-06-24','alfa',7),
(12,'2021-06-24','hadir',6),
(13,'2021-06-25','hadir',9),
(14,'2021-06-25','hadir',8),
(15,'2021-06-26','ijin',9),
(16,'2021-06-26','ijin',8),
(17,'2021-06-25','hadir',12),
(18,'2021-06-25','alfa',7),
(19,'2021-06-25','hadir',6),
(20,'2021-06-26','sakit',12),
(21,'2021-06-26','alfa',7),
(22,'2021-06-26','sakit',6);

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `admin` */

insert  into `admin`(`username`,`password`,`nama`,`id`) values 
('admin','$2y$10$gKOq3g/rWca/C9Mwsb1J8eq2nNDpz2kwCFyakH47Co6vO3.Swk1H2','Ardhika Restu Yoviyanto',1),
('admin2','$2y$10$5hGyU756H7XcRPS24EqUaO8Qw95A3wNXI.K2pOlgraoF8.N7RNIvW','Admin2',4);

/*Table structure for table `agenda` */

DROP TABLE IF EXISTS `agenda`;

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategoriagenda` int(11) DEFAULT NULL,
  `judul` varchar(225) DEFAULT NULL,
  `slug` varchar(226) DEFAULT NULL,
  `isi` mediumtext DEFAULT NULL,
  `gambar` varchar(225) DEFAULT NULL,
  `file` varchar(225) DEFAULT NULL,
  `dilihat` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  PRIMARY KEY (`id_agenda`),
  KEY `IdKategoriAgenda` (`id_kategoriagenda`),
  CONSTRAINT `IdKategoriAgenda` FOREIGN KEY (`id_kategoriagenda`) REFERENCES `kategori_agenda` (`id_kategoriagenda`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `agenda` */

insert  into `agenda`(`id_agenda`,`id_kategoriagenda`,`judul`,`slug`,`isi`,`gambar`,`file`,`dilihat`,`tgl`) values 
(7,3,'Manfaat Prakerin Bagi Siswa Siswa SMK','manfaat-prakerin-bagi-siswa-siswa-smk','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br></p>','1031827164p.jpg','kosong',0,'2021-06-28 10:32:56'),
(8,2,'Tips Melakukan Prakerin','tips-melakukan-prakerin','<div>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</div><div><div>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</div><div><div>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</div><div><br></div></div></div>','WhatsApp Image 2018-12-27 at 8.47.35 PM_1.jpeg','ABSTRAK_SOLO LEARN_PENGUASAAN IPTEK_1.pdf',0,'2021-06-28 10:34:39'),
(10,3,'Cara Pendaftaran Prakerin','cara-pendaftaran-prakerin','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br></p>','WhatsApp Image 2018-12-27 at 8.47.35 PM.jpeg','ABSTRAK_SOLO LEARN_PENGUASAAN IPTEK.pdf',0,'2021-06-28 10:41:02');

/*Table structure for table `aspek_penilaian` */

DROP TABLE IF EXISTS `aspek_penilaian`;

CREATE TABLE `aspek_penilaian` (
  `id_aspek` int(11) NOT NULL AUTO_INCREMENT,
  `id_jurusan` int(11) DEFAULT NULL,
  `nama_aspek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_aspek`),
  KEY `Jurusan` (`id_jurusan`),
  CONSTRAINT `Jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `aspek_penilaian` */

insert  into `aspek_penilaian`(`id_aspek`,`id_jurusan`,`nama_aspek`) values 
(1,1,'Penguasaan Materi'),
(2,1,'Pengetahuan Tentang Perusahaan'),
(3,1,'Instalasi Jaringan Komputer'),
(4,1,'Desain Jaringan Menggunakan Software Cisco Packet Tracker'),
(5,1,'Routing Statis dan Dinamis'),
(6,1,'Nilai Etika dan Tanggung Jawab'),
(10,5,'Pengetahuan Tentang Profil Perusahaan'),
(11,5,'Praktek Jadi Teller Bank'),
(12,5,'Kejujuran, Kedisiplinan, Kecakapan');

/*Table structure for table `chat` */

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `isi` mediumtext DEFAULT NULL,
  `lampiran` varchar(225) DEFAULT NULL,
  `id_pembimbing` int(11) DEFAULT NULL,
  `tujuan` enum('admin','pembimbing') DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  PRIMARY KEY (`id_chat`),
  KEY `IdPembimbing` (`id_pembimbing`),
  CONSTRAINT `IdPembimbing` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id_pembimbing`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `chat` */

/*Table structure for table `industri` */

DROP TABLE IF EXISTS `industri`;

CREATE TABLE `industri` (
  `id_industri` int(11) NOT NULL AUTO_INCREMENT,
  `nama_industri` varchar(225) DEFAULT NULL,
  `alamat_industri` varchar(250) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `kuota` int(5) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `bidang_kerja` varchar(200) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `syarat` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id_industri`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `industri` */

insert  into `industri`(`id_industri`,`nama_industri`,`alamat_industri`,`deskripsi`,`kuota`,`foto`,`bidang_kerja`,`telp`,`email`,`syarat`) values 
(2,'PT NIRWANA JAYA','Jl Magelang Km 08 Jogjakarta','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br></p>',23,'1.jpg','Komputer dan Jaringan','0876767621123','nirawanacomputer@company.com','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br></p>'),
(3,'PT ASTRA SAVE ENERGY','Jln Pegangsaan Timur, Jakarta Selatan','<ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; text-align: justify;\"><li style=\"margin: 0px; padding: 0px;\"><font color=\"#000000\" face=\"Open Sans, Arial, sans-serif\"><span style=\"font-size: 14px; font-family: Verdana;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></font><br></li></ul>',20,'89106_620.jpg','Teknik Mesin','0876543212342','astrea@company.com','<ol><li><font face=\"Verdana\">normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></li><li><font face=\"Verdana\">normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></li><li><font face=\"Verdana\">normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></li></ol>'),
(6,'PT BANK INDONESIA','Jln. Kebon Jeruk, Km 06 Jakarta Pusat','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br></p>',12,'bank.jpg','Perbankan','087654321235','bank@gmail.com','<ol><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li><li>Praesent faucibus est ut nibh condimentum euismod.</li><li>Fusce sit amet dolor venenatis, sodales felis non, aliquet nibh.</li><li>Praesent eu nulla a massa blandit iaculis.</li><li>Mauris sit amet nibh ac erat eleifend varius ac euismod turpis.</li></ol>');

/*Table structure for table `instansi` */

DROP TABLE IF EXISTS `instansi`;

CREATE TABLE `instansi` (
  `nama_instansi` varchar(100) DEFAULT NULL,
  `notelp` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo_kanan` varchar(200) DEFAULT NULL,
  `logo_kiri` varchar(200) DEFAULT NULL,
  `nama_app` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `instansi` */

insert  into `instansi`(`nama_instansi`,`notelp`,`alamat`,`email`,`logo_kanan`,`logo_kiri`,`nama_app`) values 
('SMA Percobaan','082313104589','Jln Jumapolo Km 01, Karanganyar Jawa Tengah','smkpercobaan@gmail.com','kanan.png','kiri.png','Sistem Praktek Kerja Industri');

/*Table structure for table `jurnal` */

DROP TABLE IF EXISTS `jurnal`;

CREATE TABLE `jurnal` (
  `id_jurnal` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(225) DEFAULT NULL,
  `judul` varchar(225) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `tgl_kumpul` datetime DEFAULT NULL,
  `id_penempatan` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  PRIMARY KEY (`id_jurnal`),
  KEY `_IdPenempatan` (`id_penempatan`),
  CONSTRAINT `_IdPenempatan` FOREIGN KEY (`id_penempatan`) REFERENCES `penempatan` (`id_penempatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jurnal` */

insert  into `jurnal`(`id_jurnal`,`file`,`judul`,`keterangan`,`tgl_kumpul`,`id_penempatan`,`nilai`) values 
(1,'jurnal.pdf','PERMASALAHAN YANG DIHADAPI TELLER BANK BESERTA SOLUSINYA','JURNAL PERTAMA','2021-06-24 17:24:36',6,86),
(2,'jurnal.pdf','PENGARUH TEKNOLOGI INFORMASI UNTUK BERTRANSAKSI','JURNAL KEDUA','2021-06-24 17:25:23',6,88),
(3,'jurnal.pdf','PENGARUH KINERJA BANK TERHADAP KEPUASAN MASYARAKAT','JURNAL PERTAMA','2021-06-24 18:11:43',7,77);

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jurusan` */

insert  into `jurusan`(`id_jurusan`,`nama_jurusan`) values 
(1,'TKJ'),
(4,'TKR'),
(5,'PERBANKAN');

/*Table structure for table `kategori_agenda` */

DROP TABLE IF EXISTS `kategori_agenda`;

CREATE TABLE `kategori_agenda` (
  `id_kategoriagenda` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategoriagenda` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kategoriagenda`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori_agenda` */

insert  into `kategori_agenda`(`id_kategoriagenda`,`nama_kategoriagenda`) values 
(1,'Pengumuman Prakerin'),
(2,'Tips Prakerin'),
(3,'Berita Harian');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(200) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `IdJurusan` (`id_jurusan`),
  CONSTRAINT `IdJurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kelas` */

insert  into `kelas`(`id_kelas`,`nama_kelas`,`id_jurusan`) values 
(4,'XII TKR',4),
(7,'XII TKJ',1),
(10,'XII PERBANKAN',5);

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_penempatan` int(11) DEFAULT NULL,
  `id_aspek` int(11) DEFAULT NULL,
  `nilai_angka` double DEFAULT NULL,
  `nilai_huruf` enum('A','B','C','D','E') DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `_Id_Penempatan` (`id_penempatan`),
  KEY `_Id_Aspek` (`id_aspek`),
  CONSTRAINT `_Id_Aspek` FOREIGN KEY (`id_aspek`) REFERENCES `aspek_penilaian` (`id_aspek`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `_Id_Penempatan` FOREIGN KEY (`id_penempatan`) REFERENCES `penempatan` (`id_penempatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

/*Data for the table `nilai` */

insert  into `nilai`(`id_nilai`,`id_penempatan`,`id_aspek`,`nilai_angka`,`nilai_huruf`) values 
(20,8,1,100,'A'),
(21,8,2,100,'A'),
(22,8,3,90,'A'),
(23,8,4,90,'A'),
(24,8,5,95,'A'),
(25,8,6,100,'A'),
(32,9,1,98,'A'),
(33,9,2,88,'A'),
(34,9,3,88,'A'),
(35,9,4,88,'A'),
(36,9,5,88,'A'),
(37,9,6,88,'A'),
(38,12,10,90,'A'),
(39,12,11,88,'A'),
(40,12,12,89,'A'),
(44,6,10,98,'A'),
(45,6,11,90,'A'),
(46,6,12,88,'A'),
(47,7,10,77,'B'),
(48,7,11,77,'B'),
(49,7,12,60,'C');

/*Table structure for table `pembimbing` */

DROP TABLE IF EXISTS `pembimbing`;

CREATE TABLE `pembimbing` (
  `id_pembimbing` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `nama_pembimbing` varchar(200) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_industri` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pembimbing`),
  KEY `_IdJurusan` (`id_jurusan`),
  KEY `IdIndustri` (`id_industri`),
  CONSTRAINT `IdIndustri` FOREIGN KEY (`id_industri`) REFERENCES `industri` (`id_industri`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `_IdJurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembimbing` */

insert  into `pembimbing`(`id_pembimbing`,`username`,`password`,`nip`,`nama_pembimbing`,`id_jurusan`,`id_industri`) values 
(5,'101','$2y$10$2MQA3NnrIKPB2imkN.yrIuWaY6TeoPI4W00UPAhcasSabEVEa/SLi','101','ROY ANANDA , ST',4,2),
(6,'102','$2y$10$5icde0FJMxIStQ3MUPjQGum4PgfabC/fo36H6RQfLPK1UlzlGcoMS','102','DEDY KUSNANDAR, S.KOM',4,3),
(7,'103','$2y$10$TEWfEJG29gUax/wSNIYu5ekMcbJbnWAZmmdoXbdoq4jwQ8Z9lbaFu','103','DIYAN SEFTIYANA, S.KOM',1,2),
(8,'104','$2y$10$CfkcDny1MpJHoEEyTBp1LuM3pGzYau7eiN4yzmVDQZUCkr3/G..TS','104','ARDHIKA RESTU YOVIYANTO, M.CS',1,3),
(9,'105','$2y$10$udBwXQ/gBtUBWIWwhBs1Y.VKhLTQJMMjIddBGano1nPztH7j1ifuC','105','REZA ANINDITA PRATAMA, S.CS',4,2),
(10,'andreas','$2y$10$asuie8gV7h8L0PpdlN0kIOkC.z9diaE5hJF4kZkvgVT6NS8GudRmW','108','DR. ANDREAS WILIAM',5,6);

/*Table structure for table `penempatan` */

DROP TABLE IF EXISTS `penempatan`;

CREATE TABLE `penempatan` (
  `id_penempatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) DEFAULT NULL,
  `id_industri` int(11) DEFAULT NULL,
  `tgl_request` datetime DEFAULT NULL,
  `status` enum('diterima','ditolak','pending') DEFAULT NULL,
  `surat` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_penempatan`),
  KEY `Id_Siswa` (`id_siswa`),
  KEY `Id_Industri` (`id_industri`),
  CONSTRAINT `Id_Industri` FOREIGN KEY (`id_industri`) REFERENCES `industri` (`id_industri`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Id_Siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penempatan` */

insert  into `penempatan`(`id_penempatan`,`id_siswa`,`id_industri`,`tgl_request`,`status`,`surat`) values 
(6,10,6,'2021-06-21 16:08:12','diterima','kosong'),
(7,9,6,'2021-06-21 16:08:12','diterima','kosong'),
(8,2,2,'2021-06-21 21:49:56','diterima','kosong'),
(9,1,2,'2021-06-21 21:49:56','diterima','kosong'),
(12,8,6,'2021-06-23 07:36:18','diterima','surat.pdf');

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `nama_siswa` varchar(200) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  KEY `IdKelas` (`id_kelas`),
  CONSTRAINT `IdKelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `siswa` */

insert  into `siswa`(`id_siswa`,`nis`,`alamat`,`password`,`nama_siswa`,`id_kelas`,`username`,`jenis_kelamin`) values 
(1,'100','Ndlangin, Jumapolo','$2y$10$toMdNimhIyphhkD/emYG4OEjlJPx6SbJ6vs2THyWo.EZxR.TRBimq','PUTRI INDAH LESTARI',7,'@putri','P'),
(2,'101','Sleman, Jogjakarta','$2y$10$mjBO4VoeHbtJcwMsDL2wReuOjLPvyMwYaOFEt5TyPp9LyGbcCOdHG','AGUNG CAHYO SUMIRAT',7,'@agung','L'),
(8,'102','Solo, Jawa Tengah','$2y$10$wovb9qwiqlCysevpGe4/kelFfPgwE7zB1SlVklRTurviStCbY6.9u','ANDIKA BAGASKARA',10,'@andika','L'),
(9,'103','Kedawung, Karanganyar','$2y$10$3tkHRcPEOIAPOQ0XKBE0MeEg9oow2Op4kf2Ug.bz/CNfNYip7H7iK','ARTIKA EVA',10,'@eva','P'),
(10,'104','Giriwondo, Jumapolo','$2y$10$Mfaj/28e9ODk3I/ELRIxg.BChVpBTRBi9n3Mlaj.JQ1.6CkZqJUp.','RIO ALEXANDER',10,'@rio','L');

/*Table structure for table `tolak_penempatan` */

DROP TABLE IF EXISTS `tolak_penempatan`;

CREATE TABLE `tolak_penempatan` (
  `id_penolakan` int(11) NOT NULL AUTO_INCREMENT,
  `id_penempatan` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `alasan` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_penolakan`),
  KEY `PenempatanId` (`id_penempatan`),
  CONSTRAINT `PenempatanId` FOREIGN KEY (`id_penempatan`) REFERENCES `penempatan` (`id_penempatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tolak_penempatan` */

insert  into `tolak_penempatan`(`id_penolakan`,`id_penempatan`,`tgl`,`alasan`) values 
(1,12,'2021-06-23 09:34:48','Portofolio Kurang');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
