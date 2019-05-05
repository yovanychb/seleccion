CREATE DATABASE  IF NOT EXISTS `seleccioncds` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `seleccioncds`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: seleccioncds
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `Dui` varchar(10) NOT NULL,
  `Imagen` varchar(250) NOT NULL,
  `Nombres` varchar(32) NOT NULL,
  `Apellidos` varchar(32) NOT NULL,
  `Telefono` varchar(9) NOT NULL,
  `Cargo` char(1) NOT NULL,
  `Correo` varchar(64) NOT NULL,
  `Contrasea` varchar(72) NOT NULL,
  PRIMARY KEY (`Dui`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('admin','./imagenes/user.png','Administrador','Admin','7777-7777','A','correo@ejemplo.com','MTIz');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `Id_Curso` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(32) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Cantidad_Convocatorias` int(11) NOT NULL,
  `Cantidad_Aprobados` int(11) NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_Curso`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Dui`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convocatorias`
--

DROP TABLE IF EXISTS `convocatorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convocatorias` (
  `Id_Convocatorias` int(11) NOT NULL,
  `Titulo` varchar(32) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Id_Curso` int(11) NOT NULL,
  PRIMARY KEY (`Id_Convocatorias`),
  KEY `Id_Curso` (`Id_Curso`),
  CONSTRAINT `convocatorias_ibfk_1` FOREIGN KEY (`Id_Curso`) REFERENCES `cursos` (`Id_Curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convocatorias`
--

LOCK TABLES `convocatorias` WRITE;
/*!40000 ALTER TABLE `convocatorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `convocatorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aspirantes`
--

DROP TABLE IF EXISTS `aspirantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspirantes` (
  `Nit` varchar(17) NOT NULL,
  `Nombre` varchar(32) NOT NULL,
  `Apellido` varchar(32) NOT NULL,
  `Dui` varchar(10) DEFAULT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo` varchar(64) NOT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Facebook` varchar(32) DEFAULT NULL,
  `Telefono1` varchar(9) NOT NULL,
  `Telefono2` varchar(9) DEFAULT NULL,
  `TelefonoFijo` varchar(9) DEFAULT NULL,
  `NivelAcademico` varchar(16) DEFAULT NULL,
  `NumConvocatoria` int(11) NOT NULL,
  PRIMARY KEY (`Nit`),
  KEY `NumConvocatoria` (`NumConvocatoria`),
  CONSTRAINT `aspirantes_ibfk_1` FOREIGN KEY (`NumConvocatoria`) REFERENCES `convocatorias` (`Id_Convocatorias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aspirantes`
--

LOCK TABLES `aspirantes` WRITE;
/*!40000 ALTER TABLE `aspirantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `aspirantes` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas` (
  `Id_Nota` int(11) NOT NULL AUTO_INCREMENT,
  `Matematica` double NOT NULL,
  `Logica` double NOT NULL,
  `Perseverancia` double NOT NULL,
  `HabComputacionales` double NOT NULL,
  `Promedio` double NOT NULL,
  `Id_Aspirante` varchar(17) NOT NULL,
  PRIMARY KEY (`Id_Nota`),
  KEY `Id_Aspirante` (`Id_Aspirante`),
  CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`Id_Aspirante`) REFERENCES `aspirantes` (`Nit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aprobados`
--

DROP TABLE IF EXISTS `aprobados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aprobados` (
  `Id_Aprobado` int(11) NOT NULL AUTO_INCREMENT,
  `Estado` tinyint(1) NOT NULL,
  `Id_Aspirante` varchar(17) NOT NULL,
  PRIMARY KEY (`Id_Aprobado`),
  KEY `Id_Aspirante` (`Id_Aspirante`),
  CONSTRAINT `aprobados_ibfk_1` FOREIGN KEY (`Id_Aspirante`) REFERENCES `aspirantes` (`Nit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aprobados`
--

LOCK TABLES `aprobados` WRITE;
/*!40000 ALTER TABLE `aprobados` DISABLE KEYS */;
/*!40000 ALTER TABLE `aprobados` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `Id_Bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `Hora` datetime NOT NULL,
  `Descripcion` varchar(250) DEFAULT NULL,
  `Usuario` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_Bitacora`),
  KEY `Usuario` (`Usuario`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Dui`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-13 13:23:38
