CREATE DATABASE  IF NOT EXISTS `the-cooking-place` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `the-cooking-place`;
-- MySQL dump 10.13  Distrib 8.0.36, for macos14 (arm64)
--
-- Host: localhost    Database: the-cooking-place
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Carnes','Categoria destinada a pratos feitos principalmente com carne'),(2,'Peixe','Categoria destinada a pratos feitos principalmente com peixe'),(3,'Sushi & Comida Japonesa','Categoria destinada a pratos de sushi e comida japonesa');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membro`
--

DROP TABLE IF EXISTS `membro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `forename` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bio` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `picture` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `role` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telefone` (`telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membro`
--

LOCK TABLES `membro` WRITE;
/*!40000 ALTER TABLE `membro` DISABLE KEYS */;
INSERT INTO `membro` VALUES (1,'Tiago','Daniel','tiagoamdaniel488@gmail.com','+351927599484','$2b$12$oT4GLuoakOE6OERj5j8CouVmh6.Qbjo1ku70gPsQ.jhQZ7JWcT7Ka','2025-02-09 23:12:09','Uma pequena bio só para não ficar muito cluterd','tiago-daniel.jpg','admin_supremo'),(2,'Inês','Bastos','inesbastos1998@gmail.com','+351926359930','$2b$12$Ac2K5rH9WszaLxqpZxhnweySme228XTdlI2I3E5G1WeciEgLBBNg6','2025-02-09 23:12:09','Segue-me para veres as melhores receitas','ines-bastos.jpg','member'),(3,'Tomás','Dias','tomasbrancodias2005@gmail.com','+351926039255','$2b$12$49FLIdLm0pI5JYPXiTfwgunFVXcvvUc0y90FLA4pY.u13zjvJUbPq','2025-02-09 23:12:09','Segue-me para veres os melhores fails de cozinha','tomas-dias.jpg','member'),(4,'Rodrigo','Reis','rodrigoreis2005@gmail.com','+351910820428','$2b$12$49FLIdLm0pI5JYPXiTfwgunFVXcvvUc0y90FLA4pY.u13zjvJUbPq','2025-02-09 23:12:09','Como fazer boa comida','rodrigo-reis.jpg','member');
/*!40000 ALTER TABLE `membro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receita`
--

DROP TABLE IF EXISTS `receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(64) NOT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tempo_preparo` int NOT NULL,
  `unidade_tempo` enum('min','hr') DEFAULT NULL,
  `numero_pessoas` int NOT NULL,
  `ingredientes` varchar(1024) NOT NULL,
  `quantidades` varchar(1024) NOT NULL,
  `passos_preparacao` text NOT NULL,
  `keywords` varchar(1024) DEFAULT NULL,
  `imagem_file` varchar(256) NOT NULL,
  `imagem_alt_text` varchar(1024) NOT NULL,
  `video_file` varchar(256) DEFAULT NULL,
  `video_alt_text` varchar(256) DEFAULT NULL,
  `categoria_id` int NOT NULL,
  `membro_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `membro_id` (`membro_id`),
  CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receita`
--

LOCK TABLES `receita` WRITE;
/*!40000 ALTER TABLE `receita` DISABLE KEYS */;
INSERT INTO `receita` VALUES (1,'Sushi','Como fazer sushi clássico de maneira simples e rápida','2025-02-09 23:33:52',45,'min',6,'Salmão, Abacate, Alga Nori, Molho Soja, Arroz Sushi, Vinagre, Açúcar, Sal','500g, 350g, 150g, 350ml, 400g, 150ml, 100g, 50g','#Lorem ipsum dolor sit amet consectetur adipisicing elit. Est fugiat totam error, aperiam dolores repellat sequi tenetur dolor incidunt nostrum soluta quia possimus! Pariatur aspernatur hic mollitia laudantium sapiente quisquam!#Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam eum quae voluptates quis, id cumque ab animi iste labore blanditiis dignissimos soluta cupiditate nesciunt magnam tempore atque expedita beatae officia.#Lorem ipsum dolor sit amet consectetur adipisicing elit. Est fugiat totam error, aperiam dolores repellat sequi tenetur dolor incidunt nostrum soluta quia possimus! Pariatur aspernatur hic mollitia laudantium sapiente quisquam!','#sushi#fácil#comida#japones','sushi.jpg','Imagem de sushi','sushi.mp4','',3,1);
/*!40000 ALTER TABLE `receita` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-09 22:39:34
