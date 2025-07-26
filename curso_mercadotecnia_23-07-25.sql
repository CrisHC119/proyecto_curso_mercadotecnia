-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: curso_mercadotecnia
-- ------------------------------------------------------
-- Server version	5.7.44-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id_usuario` int(11) NOT NULL,
  `nocontrol` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `horas_U1` bigint(20) DEFAULT NULL,
  `horas_U2` bigint(20) DEFAULT NULL,
  `horas_U3` bigint(20) DEFAULT NULL,
  `horas_U4` bigint(20) DEFAULT NULL,
  `horas_U5` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `Alumnos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (1,21380393,8,236,NULL,NULL,NULL,NULL),(13,21380394,9,3132,NULL,NULL,NULL,NULL),(14,21380395,7,205,NULL,NULL,NULL,NULL),(15,21380396,1,328,NULL,NULL,NULL,NULL),(16,21380397,9,329,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnos_calificacion`
--

DROP TABLE IF EXISTS `alumnos_calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos_calificacion` (
  `id_usuario` int(11) NOT NULL,
  `calf_1` int(11) DEFAULT NULL,
  `calf_2` int(11) DEFAULT NULL,
  `calf_3` int(11) DEFAULT NULL,
  `calf_4` int(11) DEFAULT NULL,
  `calf_5` int(11) DEFAULT NULL,
  `examen_U1` tinyint(1) DEFAULT '0',
  `examen_U2` tinyint(1) DEFAULT '0',
  `examen_U3` tinyint(1) DEFAULT '0',
  `examen_U4` tinyint(1) DEFAULT '0',
  `examen_U5` tinyint(1) DEFAULT '0',
  `tipo_examen_U1` int(11) DEFAULT NULL,
  `tipo_examen_U2` int(11) DEFAULT NULL,
  `tipo_examen_U3` int(11) DEFAULT NULL,
  `tipo_examen_U4` int(11) DEFAULT NULL,
  `tipo_examen_U5` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_usuario_calificacion` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos_calificacion`
--

LOCK TABLES `alumnos_calificacion` WRITE;
/*!40000 ALTER TABLE `alumnos_calificacion` DISABLE KEYS */;
INSERT INTO `alumnos_calificacion` VALUES (1,0,NULL,NULL,NULL,NULL,0,0,0,0,0,2,NULL,NULL,NULL,NULL),(13,20,NULL,NULL,NULL,NULL,0,0,0,0,0,2,NULL,NULL,NULL,NULL),(14,100,NULL,NULL,NULL,NULL,0,0,0,0,0,1,NULL,NULL,NULL,NULL),(15,40,NULL,NULL,NULL,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `alumnos_calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen_pregunta`
--

DROP TABLE IF EXISTS `examen_pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examen_pregunta` (
  `id_pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pregunta`),
  KEY `id_examen` (`id_examen`),
  CONSTRAINT `examen_pregunta_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examen_unidad` (`id_examen`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen_pregunta`
--

LOCK TABLES `examen_pregunta` WRITE;
/*!40000 ALTER TABLE `examen_pregunta` DISABLE KEYS */;
INSERT INTO `examen_pregunta` VALUES (1,1,'U1P1'),(2,1,'U1P2'),(3,1,'U1P3'),(4,1,'U1P4'),(5,1,'U1P5'),(6,1,'U1P6'),(7,1,'U1P7'),(8,1,'U1P8'),(9,1,'U1P9'),(10,1,'U1P10'),(11,1,'U1P11'),(12,1,'U1P12'),(13,1,'U1P13'),(14,1,'U1P14'),(15,1,'U1P15');
/*!40000 ALTER TABLE `examen_pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen_respuesta`
--

DROP TABLE IF EXISTS `examen_respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examen_respuesta` (
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `correcto` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_respuesta`),
  KEY `id_pregunta` (`id_pregunta`),
  CONSTRAINT `examen_respuesta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `examen_pregunta` (`id_pregunta`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen_respuesta`
--

LOCK TABLES `examen_respuesta` WRITE;
/*!40000 ALTER TABLE `examen_respuesta` DISABLE KEYS */;
INSERT INTO `examen_respuesta` VALUES (1,1,'U1P1_R1',0),(2,1,'U1P1_R2',0),(3,1,'U1P1_R3',1),(4,1,'U1P1_R4',0),(5,2,'U1P2_R1',1),(6,2,'U1P2_R2',0),(7,2,'U1P2_R3',0),(8,2,'U1P2_R4',0),(9,3,'U1P3_R1',0),(10,3,'U1P3_R2',0),(11,3,'U1P3_R3',1),(12,3,'U1P3_R4',0),(13,4,'U1P4_R1',0),(14,4,'U1P4_R2',1),(15,4,'U1P4_R3',0),(16,4,'U1P4_R4',0),(17,5,'U1P5_R1',0),(18,5,'U1P5_R2',1),(19,5,'U1P5_R3',0),(20,5,'U1P5_R4',0),(21,6,'U1P6_R1',0),(22,6,'U1P6_R2',1),(23,6,'U1P6_R3',0),(24,6,'U1P6_R4',0),(25,7,'U1P7_R1',0),(26,7,'U1P7_R2',1),(27,7,'U1P7_R3',0),(28,7,'U1P7_R4',0),(29,8,'U1P8_R1',0),(30,8,'U1P8_R2',1),(31,8,'U1P8_R3',0),(32,8,'U1P8_R4',0),(33,9,'U1P9_R1',0),(34,9,'U1P9_R2',1),(35,9,'U1P9_R3',0),(36,9,'U1P9_R4',0),(37,10,'U1P10_R1',0),(38,10,'U1P10_R2',1),(39,10,'U1P10_R3',0),(40,10,'U1P10_R4',0),(41,11,'U1P11_R1',1),(42,11,'U1P11_R2',0),(43,11,'U1P11_R3',0),(44,11,'U1P11_R4',0),(45,12,'U1P12_R1',0),(46,12,'U1P12_R2',1),(47,12,'U1P12_R3',0),(48,12,'U1P12_R4',0),(49,13,'U1P13_R1',0),(50,13,'U1P13_R2',1),(51,13,'U1P13_R3',0),(52,13,'U1P13_R4',0),(53,14,'U1P14_R1',1),(54,14,'U1P14_R2',0),(55,14,'U1P14_R3',0),(56,14,'U1P14_R4',0),(57,15,'U1P15_R1',0),(58,15,'U1P15_R2',1),(59,15,'U1P15_R3',0),(60,15,'U1P15_R4',0);
/*!40000 ALTER TABLE `examen_respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen_unidad`
--

DROP TABLE IF EXISTS `examen_unidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examen_unidad` (
  `id_examen` int(11) NOT NULL AUTO_INCREMENT,
  `id_unidad` int(11) NOT NULL,
  `fecha_disponible` datetime DEFAULT NULL,
  PRIMARY KEY (`id_examen`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen_unidad`
--

LOCK TABLES `examen_unidad` WRITE;
/*!40000 ALTER TABLE `examen_unidad` DISABLE KEYS */;
INSERT INTO `examen_unidad` VALUES (1,1,'2025-07-23 19:05:00'),(2,2,NULL),(3,3,NULL),(4,4,NULL),(5,5,NULL);
/*!40000 ALTER TABLE `examen_unidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesores`
--

DROP TABLE IF EXISTS `profesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesores` (
  `id_usuario` int(11) NOT NULL,
  `matricula` bigint(20) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `Profesores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesores`
--

LOCK TABLES `profesores` WRITE;
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
INSERT INTO `profesores` VALUES (2,8341314052),(3,8341314050);
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'root'),(2,'Profesor'),(3,'Alumno');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellido_paterno` varchar(40) NOT NULL,
  `apellido_materno` varchar(40) NOT NULL,
  `campus` varchar(150) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `idioma` varchar(2) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Cristian Yahir','Hernández','de la Cruz','itcv','$2y$12$H44lpcTVqhNs6KbgLVzyr.1mOaGuv2cBVaRK8yidM/bbeGhLBfqZe','en',3,'2025-06-27 11:36:07','avatar_21380393.jpg'),(2,'Andres Manuel','Lopéz','Obrador','itcv','$2y$12$bKNvvR6MtjAqiHGEFGwuVuJrvqMjFTK8az.NA5TpfgCEcVx9rIg9a','en',2,'2025-06-27 11:36:07','avatar_8341314052.jpg'),(3,'Claudia','Sheinbaum','Pardo','itcv','$2y$12$bKNvvR6MtjAqiHGEFGwuVuJrvqMjFTK8az.NA5TpfgCEcVx9rIg9a','es',1,'2025-06-27 11:36:07','avatar_8341314050.jpg'),(13,'Leon','Garcia','Garcia','itcv','$2y$12$KFhAwkZ2I019OfrCgUxL5u9DnZ3z8eJZ/pvolXNhWobjfH5viwVmK','es',3,'2025-07-16 11:46:32','avatar_21380394.jpg'),(14,'Juan','Martinez','Treviño','itcm','$2y$12$bKNvvR6MtjAqiHGEFGwuVuJrvqMjFTK8az.NA5TpfgCEcVx9rIg9a','es',3,'2025-07-16 11:51:24','avatar_default.jpg'),(15,'Luis','Morales','Fernandez','itsac','$2y$12$2FkPPkZniCm4giHLhP0jlezkgWH3axqynMIzzyT7S9X2.x1ggcd6u','es',3,'2025-07-16 13:22:58','avatar_21380396.jpg'),(16,'Armando','Hoyos','Derbez','tesoem','$2y$12$03iU/hsABzB/Ox8nQuC/pOxcO1R1sfL1U.7uzmZTz/gJcpDqqERmS','es',3,'2025-07-16 19:13:42','avatar_21380397.jpg');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-23 18:22:25
