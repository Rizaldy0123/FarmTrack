-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: db_peternakan
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_kandang`
--

DROP TABLE IF EXISTS `tb_kandang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_kandang` (
  `id_kandang` varchar(10) NOT NULL,
  `nama_kandang` varchar(20) DEFAULT NULL,
  `status` enum('Aktif','Panen','Kosong') DEFAULT NULL,
  `jumlah_ayam` int DEFAULT NULL,
  `id_karyawan` varchar(10) DEFAULT NULL,
  `umur_ayam` int DEFAULT NULL,
  PRIMARY KEY (`id_kandang`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `tb_kandang_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kandang`
--

LOCK TABLES `tb_kandang` WRITE;
/*!40000 ALTER TABLE `tb_kandang` DISABLE KEYS */;
INSERT INTO `tb_kandang` VALUES ('KD01','4P','Aktif',500,'K01',97),('KD02','7','Panen',876,'K02',97),('KD03','14','Kosong',323,'K03',95),('KD04','2P','Aktif',625,'K04',92),('KD05','6','Aktif',763,'K05',92);
/*!40000 ALTER TABLE `tb_kandang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_karyawan`
--

DROP TABLE IF EXISTS `tb_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `status` enum('Aktif','Panen','Cuti') DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_karyawan`
--

LOCK TABLES `tb_karyawan` WRITE;
/*!40000 ALTER TABLE `tb_karyawan` DISABLE KEYS */;
INSERT INTO `tb_karyawan` VALUES ('K01','Ghazan','Produksi','Aktif'),('K02','Jannah','Produksi','Panen'),('K03','Azman','Kebersihan','Aktif'),('K04','Sucipto','Kebersihan','Cuti'),('K05','Mohammad','Produksi','Aktif'),('K06','Khosim','Kebersihan','Aktif'),('K07','Ezra','Produksi','Panen'),('K08','Alif','Kebersihan','Panen'),('K09','Adit','Kebersihan','Cuti'),('K10','Aldi','Produksi','Aktif');
/*!40000 ALTER TABLE `tb_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pakan`
--

DROP TABLE IF EXISTS `tb_pakan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_pakan` (
  `id_pakan` varchar(10) NOT NULL,
  `nama_pakan` varchar(50) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `stok` varchar(20) DEFAULT NULL,
  `id_kandang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_pakan`),
  KEY `id_kandang` (`id_kandang`),
  CONSTRAINT `tb_pakan_ibfk_1` FOREIGN KEY (`id_kandang`) REFERENCES `tb_kandang` (`id_kandang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pakan`
--

LOCK TABLES `tb_pakan` WRITE;
/*!40000 ALTER TABLE `tb_pakan` DISABLE KEYS */;
INSERT INTO `tb_pakan` VALUES ('1P','Sentrat','Butir','5 TON','KD01'),('2P','Sentrat','Butir','5 TON','KD02'),('3P','Sentrat','Butir','5 TON','KD03');
/*!40000 ALTER TABLE `tb_pakan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_produksi`
--

DROP TABLE IF EXISTS `tb_produksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_produksi` (
  `id_produksi` varchar(10) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_kandang` varchar(10) DEFAULT NULL,
  `id_karyawan` varchar(10) DEFAULT NULL,
  `jumlah_ayam` int DEFAULT NULL,
  PRIMARY KEY (`id_produksi`),
  KEY `id_kandang` (`id_kandang`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `tb_produksi_ibfk_1` FOREIGN KEY (`id_kandang`) REFERENCES `tb_kandang` (`id_kandang`),
  CONSTRAINT `tb_produksi_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_produksi`
--

LOCK TABLES `tb_produksi` WRITE;
/*!40000 ALTER TABLE `tb_produksi` DISABLE KEYS */;
INSERT INTO `tb_produksi` VALUES ('14','2026-06-16','KD03','K03',323),('2P','2026-06-22','KD04','K04',625),('4P','2026-06-09','KD01','K01',500),('6','2026-06-19','KD05','K05',763),('7','2026-06-10','KD02','K02',876);
/*!40000 ALTER TABLE `tb_produksi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-27  5:29:5
