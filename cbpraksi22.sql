-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cbpraksi22
CREATE DATABASE IF NOT EXISTS `cbpraksi22` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cbpraksi22`;

-- Dumping structure for table cbpraksi22.alternatif
CREATE TABLE IF NOT EXISTS `alternatif` (
  `idalternatif` int(11) NOT NULL AUTO_INCREMENT,
  `nmalternatif` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idalternatif`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cbpraksi22.alternatif: ~2 rows (approximately)
/*!40000 ALTER TABLE `alternatif` DISABLE KEYS */;
/*!40000 ALTER TABLE `alternatif` ENABLE KEYS */;

-- Dumping structure for table cbpraksi22.bobot
CREATE TABLE IF NOT EXISTS `bobot` (
  `idbobot` int(11) NOT NULL AUTO_INCREMENT,
  `idkriteria` int(11) DEFAULT NULL,
  `values` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idbobot`),
  KEY `FK_idkriteria` (`idkriteria`),
  CONSTRAINT `FK_idkriteria` FOREIGN KEY (`idkriteria`) REFERENCES `kriteria` (`idkriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cbpraksi22.bobot: ~5 rows (approximately)
/*!40000 ALTER TABLE `bobot` DISABLE KEYS */;
INSERT INTO `bobot` (`idbobot`, `idkriteria`, `values`) VALUES
	(1, 1, '0.456'),
	(2, 2, '0.256'),
	(3, 3, '0.156'),
	(4, 4, '0.09'),
	(5, 5, '0.04');
/*!40000 ALTER TABLE `bobot` ENABLE KEYS */;

-- Dumping structure for table cbpraksi22.kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `idkriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nmkriteria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idkriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cbpraksi22.kriteria: ~5 rows (approximately)
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` (`idkriteria`, `nmkriteria`) VALUES
	(1, 'Capacity'),
	(2, 'Character'),
	(3, 'Capital'),
	(4, 'Collateral'),
	(5, 'Condition');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;

-- Dumping structure for table cbpraksi22.matrixkeputusan
CREATE TABLE IF NOT EXISTS `matrixkeputusan` (
  `idmatrix` int(11) NOT NULL AUTO_INCREMENT,
  `idalternatif` int(11) DEFAULT NULL,
  `idbobot` int(11) DEFAULT NULL,
  `idsubkriteria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmatrix`),
  KEY `FK_idalternatif` (`idalternatif`),
  KEY `FK_idbobot` (`idbobot`),
  KEY `FK_idsubkriteria` (`idsubkriteria`),
  CONSTRAINT `FK_idalternatif` FOREIGN KEY (`idalternatif`) REFERENCES `alternatif` (`idalternatif`),
  CONSTRAINT `FK_idbobot` FOREIGN KEY (`idbobot`) REFERENCES `bobot` (`idbobot`),
  CONSTRAINT `FK_idsubkriteria` FOREIGN KEY (`idsubkriteria`) REFERENCES `subkriteria` (`idsubkriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cbpraksi22.matrixkeputusan: ~5 rows (approximately)
/*!40000 ALTER TABLE `matrixkeputusan` DISABLE KEYS */;
/*!40000 ALTER TABLE `matrixkeputusan` ENABLE KEYS */;

-- Dumping structure for table cbpraksi22.skala
CREATE TABLE IF NOT EXISTS `skala` (
  `idskala` int(11) NOT NULL AUTO_INCREMENT,
  `values` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idskala`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cbpraksi22.skala: ~5 rows (approximately)
/*!40000 ALTER TABLE `skala` DISABLE KEYS */;
INSERT INTO `skala` (`idskala`, `values`, `keterangan`) VALUES
	(1, 1, 'Sangat Rendah'),
	(2, 2, 'Rendah'),
	(3, 3, 'Cukup'),
	(4, 4, 'Tinggi'),
	(5, 5, 'Sangat Tinggi');
/*!40000 ALTER TABLE `skala` ENABLE KEYS */;

-- Dumping structure for table cbpraksi22.subkriteria
CREATE TABLE IF NOT EXISTS `subkriteria` (
  `idsubkriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nmsubkriteria` varchar(50) DEFAULT NULL,
  `idskala` int(11) DEFAULT NULL,
  PRIMARY KEY (`idsubkriteria`),
  KEY `FK_idskala` (`idskala`),
  CONSTRAINT `FK_idskala` FOREIGN KEY (`idskala`) REFERENCES `skala` (`idskala`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cbpraksi22.subkriteria: ~21 rows (approximately)
/*!40000 ALTER TABLE `subkriteria` DISABLE KEYS */;
INSERT INTO `subkriteria` (`idsubkriteria`, `nmsubkriteria`, `idskala`) VALUES
	(1, 'Rp1.000.000 - Rp5.000.000 (Capacity)', 1),
	(2, 'Rp5.000.000 - Rp10.000.000 (Capacity)', 2),
	(3, 'Rp10.000.000 - Rp15.000.000 (Capacity)', 3),
	(4, 'Rp15.000.000 - Rp20.000.000 (Capacity)', 4),
	(5, '> Rp20.000.000 (Capacity)', 5),
	(6, '0,5 - 1,5 tahun (Character)', 2),
	(7, '1,6 - 2,5 tahun (Character)', 3),
	(8, '2,6 - 3,6 tahun (Character)', 4),
	(9, '3,6 - 5 tahun (Character)', 5),
	(10, 'Rp5.000.000 - Rp35.000.000 (Capital)', 2),
	(11, 'Rp35.000.000 - Rp70.000.000 (Capital)', 3),
	(12, 'Rp70.000.000 - Rp110.000.000 (Capital)', 4),
	(13, 'Rp110.000.000 - Rp175.000.000 (Capital)', 5),
	(14, 'Aset Kendaraan Bermotor (Collateral)', 2),
	(15, 'Aset Surat Beharga & Saham (Collateral)', 3),
	(16, 'Aset Properti (Collateral)', 4),
	(17, 'Tidak Ada (Condition)', 5),
	(18, '1 Orang (Condition)', 4),
	(19, '2 Orang (Condition)', 3),
	(20, '3 Orang (Condition)', 2),
	(21, '≥ 4 Orang (Condition)', 1);
/*!40000 ALTER TABLE `subkriteria` ENABLE KEYS */;

-- Dumping structure for view cbpraksi22.topsis_maxmin
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `topsis_maxmin` (
	`idmatrix` INT(11) NOT NULL,
	`idkriteria` INT(11) NOT NULL,
	`nmkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`maximum` DOUBLE(23,0) NULL,
	`minimum` DOUBLE(23,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.topsis_nilaiv
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `topsis_nilaiv` (
	`idalternatif` INT(11) NOT NULL,
	`dplus` DOUBLE(23,0) NULL,
	`dmin` DOUBLE(23,0) NULL,
	`nilaiv` DOUBLE(23,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.topsis_normalisasi
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `topsis_normalisasi` (
	`idmatrix` INT(11) NOT NULL,
	`idalternatif` INT(11) NOT NULL,
	`nmalternatif` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idkriteria` INT(11) NOT NULL,
	`nmkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idbobot` INT(11) NOT NULL,
	`values` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idsubkriteria` INT(11) NOT NULL,
	`nmsubkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`nilai` INT(11) NULL,
	`keterangan` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`normalisasi` DOUBLE(23,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.topsis_pembagi
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `topsis_pembagi` (
	`idkriteria` INT(11) NOT NULL,
	`nmkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`bagi` DOUBLE(23,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.topsis_ranking
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `topsis_ranking` (
	`nmalternatif` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`nilaiv` DOUBLE(23,0) NULL,
	`ranking` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.topsis_sipsin
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `topsis_sipsin` (
	`idalternatif` INT(11) NOT NULL,
	`dplus` DOUBLE(23,0) NULL,
	`dmin` DOUBLE(23,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.topsis_terbobot
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `topsis_terbobot` (
	`idmatrix` INT(11) NOT NULL,
	`idalternatif` INT(11) NOT NULL,
	`nmalternatif` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idkriteria` INT(11) NOT NULL,
	`nmkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idbobot` INT(11) NOT NULL,
	`values` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idsubkriteria` INT(11) NOT NULL,
	`nmsubkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`nilai` INT(11) NULL,
	`keterangan` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`normalisasi` DOUBLE(23,0) NULL,
	`terbobot` DOUBLE(23,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.vmatrixkeputusan
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vmatrixkeputusan` (
	`idmatrix` INT(11) NOT NULL,
	`idalternatif` INT(11) NOT NULL,
	`nmalternatif` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idkriteria` INT(11) NOT NULL,
	`nmkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idbobot` INT(11) NOT NULL,
	`values` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`idsubkriteria` INT(11) NOT NULL,
	`nmsubkriteria` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`nilai` INT(11) NULL,
	`keterangan` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view cbpraksi22.topsis_maxmin
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `topsis_maxmin`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `topsis_maxmin` AS SELECT topsis_terbobot.idmatrix,topsis_terbobot.idkriteria,topsis_terbobot.nmkriteria,MAX(topsis_terbobot.terbobot) AS maximum,
MIN(topsis_terbobot.terbobot) AS minimum
FROM topsis_terbobot GROUP BY topsis_terbobot.idkriteria ;

-- Dumping structure for view cbpraksi22.topsis_nilaiv
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `topsis_nilaiv`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `topsis_nilaiv` AS SELECT topsis_sipsin.*,(topsis_sipsin.dmin/(topsis_sipsin.dplus+topsis_sipsin.dmin)) AS nilaiv
FROM topsis_sipsin GROUP BY topsis_sipsin.idalternatif ;

-- Dumping structure for view cbpraksi22.topsis_normalisasi
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `topsis_normalisasi`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `topsis_normalisasi` AS SELECT vmatrixkeputusan.*,(vmatrixkeputusan.nilai/topsis_pembagi.bagi) AS normalisasi FROM vmatrixkeputusan,topsis_pembagi 
WHERE topsis_pembagi.idkriteria=vmatrixkeputusan.idkriteria
GROUP BY vmatrixkeputusan.idmatrix ;

-- Dumping structure for view cbpraksi22.topsis_pembagi
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `topsis_pembagi`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `topsis_pembagi` AS SELECT vmatrixkeputusan.idkriteria,vmatrixkeputusan.nmkriteria, SQRT(SUM(POW(vmatrixkeputusan.nilai,2))) AS bagi FROM vmatrixkeputusan
GROUP BY vmatrixkeputusan.idkriteria ;

-- Dumping structure for view cbpraksi22.topsis_ranking
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `topsis_ranking`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `topsis_ranking` AS SELECT nmalternatif, (topsis_sipsin.dmin/(topsis_sipsin.dplus+topsis_sipsin.dmin)) AS nilaiv, 
RANK() OVER (ORDER BY nilaiv DESC) AS ranking FROM alternatif,topsis_sipsin WHERE alternatif.idalternatif=topsis_sipsin.idalternatif 
GROUP BY topsis_sipsin.idalternatif ;

-- Dumping structure for view cbpraksi22.topsis_sipsin
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `topsis_sipsin`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `topsis_sipsin` AS SELECT topsis_terbobot.idalternatif, SQRT(SUM(POW((topsis_maxmin.maximum-topsis_terbobot.terbobot),2))) AS dplus,
SQRT(SUM(POW((topsis_maxmin.minimum-topsis_terbobot.terbobot),2))) AS dmin 
FROM topsis_terbobot,topsis_maxmin
WHERE topsis_terbobot.idkriteria=topsis_maxmin.idkriteria
GROUP BY topsis_terbobot.idalternatif ;

-- Dumping structure for view cbpraksi22.topsis_terbobot
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `topsis_terbobot`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `topsis_terbobot` AS SELECT topsis_normalisasi.*,(bobot.values*topsis_normalisasi.normalisasi) AS terbobot 
FROM topsis_normalisasi,bobot WHERE bobot.idkriteria=topsis_normalisasi.idkriteria
GROUP BY topsis_normalisasi.idmatrix ;

-- Dumping structure for view cbpraksi22.vmatrixkeputusan
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vmatrixkeputusan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vmatrixkeputusan` AS SELECT matrixkeputusan.idmatrix,alternatif.*,kriteria.*,bobot.idbobot,bobot.values,subkriteria.idsubkriteria,
subkriteria.nmsubkriteria,skala.values AS nilai,skala.keterangan FROM matrixkeputusan,skala,bobot,kriteria,subkriteria,
alternatif WHERE matrixkeputusan.idalternatif=alternatif.idalternatif AND 
matrixkeputusan.idbobot=bobot.idbobot AND matrixkeputusan.idsubkriteria=subkriteria.idsubkriteria
AND kriteria.idkriteria=bobot.idkriteria AND subkriteria.idskala=skala.idskala ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
