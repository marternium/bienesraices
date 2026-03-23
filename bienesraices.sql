CREATE DATABASE  IF NOT EXISTS `bienesraices` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bienesraices`;
-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedores_idx` (`vendedor_id`) USING BTREE,
  CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (7,'Casa de lujo en el lago',3000000.00,'50aef8fd95dfdae5948067036decef39.jpg','Casa en el lago con excelente vista, acabados de lujo a un excelente precio',4,3,3,'2026-03-22',1),(8,'Casa terminados de lujo',2000000.00,'411967a65a7396293c9ab42e8959a97b.jpg','Casa con diseño moderno, así como tecnología inteligente y amueblada',4,3,3,'2026-03-22',1),(9,'Casa con alberca',4000000.00,'f894e04e60b5316737532423f431d255.jpg','Casa con alberca y acabados de lujo en la ciudad, excelente oportunidad!',4,3,3,'2026-03-22',2),(10,'Casa de lujo en el lago',3000000.00,'f5e8e4d043cdcfd4196fb0d44b1e4427.jpg','Casa en el lago con excelente vista, acabados de lujo a un excelente precio',4,3,3,'2026-03-22',3),(11,'Casa terminados de lujo',2500000.00,'d163ad27c768f38b47f9243df5ba12b1.jpg','Casa con diseño moderno, así como tecnología inteligente y amueblada',4,3,3,'2026-03-22',2),(12,'Casa con alberca',2900000.00,'fe9a4ab787c867c68b2c33093d07d035.jpg','Casa con alberca y acabados de lujo en la ciudad, excelente oportunidad',4,3,3,'2026-03-22',3),(13,'Casa de 2 dormitorios en barrio La Fortuna',240000.00,'130c89133be3a5157aa6f0ee6b540dcd.jpg','Casa en excelentes condiciones de mantenimiento ubicada a minutos del centro de Maldonado, que consta de estar comedor con kitchenette y estufa de alto rendimiento, un baño completo y 2 dormitorios.\r\nEl inmueble además cuenta con cochera, pérgola, patio con parrillero y dependencia de servicio.',2,1,1,'2026-03-23',2),(14,'Casa de construcción tradicional',200000.00,'c8fb7438787352a3e5397b107edd2b8a.jpg','Casa de construcción tradicional ubicada a metros de Campus Departamental de Maldonado que consta de estar comedor con estufa a leña, cocina, 3 dormitorios y 2 baños.\r\nEl padrón consta de 174 metros cuadrados edificados en 937 metros cuadrados de terreno y dispone de 21 metros de frente a calle a la calle San Carlos.\r\nApto para construcción de Bloque medio ( planta baja más 9 pisos ) de Vivienda Promovida, con un FOT del 480% y un FOS del 50%.\r\nEn planta baja y primer piso destinado a usos no residenciales podrán tener un FOS del 100%, el incremento no será tenido en cuenta para el cálculo del FOT del resto del edificio.',3,2,1,'2026-03-23',1);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Juan','Vendedor','123456789'),(2,'Pedro','Picapiedra','444555111'),(3,'Vilma','Palma','789789789');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-23  0:24:39
