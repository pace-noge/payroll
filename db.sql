/*
SQLyog Ultimate v9.50 
MySQL - 5.1.28-rc-community : Database - payroll
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`payroll` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `payroll`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `kd_user` varchar(4) NOT NULL,
  `user_name` varchar(12) NOT NULL,
  `user_pass` varchar(60) NOT NULL,
  PRIMARY KEY (`kd_user`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`kd_user`,`user_name`,`user_pass`) values ('0001','admin','rahasia');

/*Table structure for table `golongan` */

DROP TABLE IF EXISTS `golongan`;

CREATE TABLE `golongan` (
  `kd_gol` varchar(1) NOT NULL,
  `nm_gol` varchar(5) NOT NULL,
  PRIMARY KEY (`kd_gol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `golongan` */

insert  into `golongan`(`kd_gol`,`nm_gol`) values ('1','I'),('2','II'),('3','III'),('4','IV');

/*Table structure for table `golongan_sub` */

DROP TABLE IF EXISTS `golongan_sub`;

CREATE TABLE `golongan_sub` (
  `kd_sub` varchar(1) NOT NULL,
  `nm_sub` varchar(1) NOT NULL,
  PRIMARY KEY (`kd_sub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `golongan_sub` */

insert  into `golongan_sub`(`kd_sub`,`nm_sub`) values ('1','A'),('2','B'),('3','C'),('4','X');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `kd_jbt` varchar(2) NOT NULL,
  `nm_jbt` varchar(30) NOT NULL,
  `kd_gol` varchar(1) NOT NULL,
  `bobot_jbt` int(11) NOT NULL,
  PRIMARY KEY (`kd_jbt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jabatan` */

insert  into `jabatan`(`kd_jbt`,`nm_jbt`,`kd_gol`,`bobot_jbt`) values ('01','Direktur Utama','1',8),('02','Manajer Pemasaran','2',6),('03','Manajer Personalia','2',4000);

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `nik` varchar(3) NOT NULL,
  `nm_karyawan` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `kd_jbt` varchar(2) NOT NULL,
  `kd_sub` varchar(1) NOT NULL,
  `msk_krj` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `karyawan` */

insert  into `karyawan`(`nik`,`nm_karyawan`,`alamat`,`telp`,`kd_jbt`,`kd_sub`,`msk_krj`,`foto`) values ('001','Himawan','Jl. Mangga 34 Banguntapan','0274123412','02','1','2012-04-27',NULL),('002','Umar','Jl. Embar 55 Yogyakarta','027411223344','03','1','2000-04-27',NULL),('003','H. Damijo','Jl. Suratmaja 34, Yogya','0274928472','01','1','2007-03-01',NULL);

/*Table structure for table `kebijakan` */

DROP TABLE IF EXISTS `kebijakan`;

CREATE TABLE `kebijakan` (
  `kd_bijak` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `jml_hari_kerja` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  PRIMARY KEY (`kd_bijak`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `kebijakan` */

insert  into `kebijakan`(`kd_bijak`,`jml_hari_kerja`,`jam_mulai`) values (01,6,'09:00:00');

/*Table structure for table `komponen` */

DROP TABLE IF EXISTS `komponen`;

CREATE TABLE `komponen` (
  `kd_komp` varchar(3) NOT NULL,
  `nm_komp` varchar(30) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `nilai` varchar(50) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0=G Pokok, 1=Tj Tetap, 2=Tj Tidak Tetap, 3=potongan',
  PRIMARY KEY (`kd_komp`),
  UNIQUE KEY `nm_komp` (`nm_komp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `komponen` */

insert  into `komponen`(`kd_komp`,`nm_komp`,`ket`,`nilai`,`status`) values ('001','Gaji Pokok','-','BOBOT_JABATAN*1000','0'),('002','Tunjangan Makan','-','4000*HARI_MASUK','1'),('003','Tunj Transportasi','-','6000*HARI_MASUK','1'),('004','Asuransi Kesehatan','-','GP*0,02','3'),('005','Tunjangan Prestasi','-','(5000*POIN)+(BOBOT_JABATAN*1000)','2'),('006','Tunjangan hari raya','tunjangan setiap hari raya besar','GP+(MASA_KERJA*5000)','2');

/*Table structure for table `komponen_jabatan` */

DROP TABLE IF EXISTS `komponen_jabatan`;

CREATE TABLE `komponen_jabatan` (
  `kd_gaji` varchar(4) NOT NULL,
  `kd_jbt` varchar(2) NOT NULL,
  `kd_sub` varchar(1) NOT NULL,
  PRIMARY KEY (`kd_gaji`),
  UNIQUE KEY `jbt_sub` (`kd_jbt`,`kd_sub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `komponen_jabatan` */

insert  into `komponen_jabatan`(`kd_gaji`,`kd_jbt`,`kd_sub`) values ('0001','01','1'),('0002','02','1');

/*Table structure for table `komponen_jabatan_detil` */

DROP TABLE IF EXISTS `komponen_jabatan_detil`;

CREATE TABLE `komponen_jabatan_detil` (
  `kd_gaji` varchar(4) NOT NULL,
  `kd_komp` varchar(3) NOT NULL,
  PRIMARY KEY (`kd_gaji`,`kd_komp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `komponen_jabatan_detil` */

insert  into `komponen_jabatan_detil`(`kd_gaji`,`kd_komp`) values ('0001','001'),('0001','002'),('0001','003'),('0001','004'),('0001','005'),('0001','006'),('0002','001'),('0002','002'),('0002','003'),('0002','004'),('0002','006');

/*Table structure for table `lembur` */

DROP TABLE IF EXISTS `lembur`;

CREATE TABLE `lembur` (
  `kd_lembur` char(1) NOT NULL,
  `jam_mulai` int(11) NOT NULL,
  `jam_akhir` int(11) NOT NULL,
  `f_kali` double NOT NULL,
  `sts_hari` varchar(1) NOT NULL DEFAULT '0' COMMENT '0=hari kerja, 1= hari libur',
  PRIMARY KEY (`kd_lembur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lembur` */

insert  into `lembur`(`kd_lembur`,`jam_mulai`,`jam_akhir`,`f_kali`,`sts_hari`) values ('1',0,1,1.5,'0'),('2',1,24,2,'0'),('3',0,7,2,'1'),('4',7,8,3,'1'),('5',9,24,4,'1');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `kd_bayar` varchar(4) NOT NULL,
  `nik` varchar(3) NOT NULL,
  `priode_awal` date NOT NULL,
  `priode_akhir` date NOT NULL,
  `tot_jam_normal` double NOT NULL,
  `tot_jam_lembur` double NOT NULL,
  `tot_index_lembur` double NOT NULL,
  `take_home_pay` double NOT NULL,
  PRIMARY KEY (`kd_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`kd_bayar`,`nik`,`priode_awal`,`priode_akhir`,`tot_jam_normal`,`tot_jam_lembur`,`tot_index_lembur`,`take_home_pay`) values ('0001','001','2012-04-01','2012-05-13',29,0,0,12145000),('0002','002','2012-05-01','2012-05-31',16,49,222,18402890.1734104),('0003','003','2012-10-02','2012-10-02',0,0,0,24165000);

/*Table structure for table `pembayaran_detil` */

DROP TABLE IF EXISTS `pembayaran_detil`;

CREATE TABLE `pembayaran_detil` (
  `kd_bayar` varchar(4) NOT NULL,
  `kd_komp` varchar(3) NOT NULL,
  `nilai` double NOT NULL,
  PRIMARY KEY (`kd_bayar`,`kd_komp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pembayaran_detil` */

insert  into `pembayaran_detil`(`kd_bayar`,`kd_komp`,`nilai`) values ('0001','001',6000000),('0001','002',8000),('0001','003',12000),('0001','004',120000),('0001','006',6005000),('0002','001',4000000),('0002','002',24000),('0002','003',36000),('0002','005',4000000),('0003','001',8000000),('0003','002',0),('0003','003',0),('0003','004',160000),('0003','005',8000000),('0003','006',8005000);

/*Table structure for table `presensi` */

DROP TABLE IF EXISTS `presensi`;

CREATE TABLE `presensi` (
  `kd_pres` varchar(4) NOT NULL,
  `nik` varchar(3) NOT NULL,
  `tgl` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `sts_kerja` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=jam kerja, 1=lembur pd hr kerja, 2=lembur hr libur',
  PRIMARY KEY (`kd_pres`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `presensi` */

insert  into `presensi`(`kd_pres`,`nik`,`tgl`,`jam_mulai`,`jam_selesai`,`sts_kerja`) values ('0001','001','2012-05-05','08:00:00','23:30:00','0'),('0002','003','2012-05-01','17:00:00','21:00:00','1'),('0003','001','2012-05-04','08:00:00','22:00:00','0'),('0004','002','2012-05-01','08:00:00','21:00:00','1'),('0005','002','2012-05-02','07:00:00','20:30:00','1'),('0006','002','2012-05-04','09:00:00','16:30:00','1'),('0007','002','2012-05-03','08:30:00','16:30:00','2'),('0008','002','2012-05-04','09:00:00','16:30:00','2'),('0009','002','2012-05-05','08:00:00','16:30:00','0'),('0010','002','2012-05-06','08:00:00','16:15:00','0'),('0011','002','2012-06-06','08:00:00','16:00:00','1');

/*Table structure for table `prestasi` */

DROP TABLE IF EXISTS `prestasi`;

CREATE TABLE `prestasi` (
  `kd_pres` varchar(4) NOT NULL,
  `tgl` date NOT NULL,
  `nik` varchar(3) NOT NULL,
  `poin` double NOT NULL,
  PRIMARY KEY (`kd_pres`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `prestasi` */

insert  into `prestasi`(`kd_pres`,`tgl`,`nik`,`poin`) values ('0001','2012-05-04','001',10),('0002','2012-05-01','001',5),('0003','2012-11-08','002',20),('0004','2012-11-01','002',8),('0005','2012-09-12','002',4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
