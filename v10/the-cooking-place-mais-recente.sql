CREATE DATABASE  IF NOT EXISTS `the-cooking-place` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
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
  `nome` varchar(32) NOT NULL,
  `descricao` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Peixe ?','Categoria destinad a pratos de peixe'),(5,'Comida Italiana ?','Categoria destinada a pratos da culinária Italiana');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo`
--

DROP TABLE IF EXISTS `conteudo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conteudo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `conteudo_id` char(36) NOT NULL,
  `membro_id` int NOT NULL,
  `tipo` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conteudo_id` (`conteudo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo`
--

LOCK TABLES `conteudo` WRITE;
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
/*!40000 ALTER TABLE `conteudo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `conteudo_id` char(36) NOT NULL,
  `membro_id` int NOT NULL,
  KEY `conteudo_id` (`conteudo_id`),
  KEY `membro_id` (`membro_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`conteudo_id`) REFERENCES `conteudo` (`conteudo_id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membro`
--

DROP TABLE IF EXISTS `membro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `forename` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `nascimento` varchar(16) NOT NULL,
  `genero` enum('M','F','D') NOT NULL,
  `email` varchar(96) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `password` varchar(80) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bio` varchar(64) DEFAULT '',
  `picture` varchar(256) DEFAULT 'blank.jpg',
  `role` varchar(48) DEFAULT 'member',
  `seo_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telefone` (`telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membro`
--

LOCK TABLES `membro` WRITE;
/*!40000 ALTER TABLE `membro` DISABLE KEYS */;
INSERT INTO `membro` VALUES (1,'Tiago','Daniel','2005-12-29','M','tiagoamdaniel488@gmail.com','927599484','$2y$10$NuEYVI4bbkGPfMRodmNRVOVkIsKVNmuzBGiZpwjFHqpyRFGHafRRO','2025-03-27 11:50:10','Hey, eu sou o fundador to The Cooking Place ? ?','tiago-g1.png','imperador_supremo_do_universo','tiagodaniel');
/*!40000 ALTER TABLE `membro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacao`
--

DROP TABLE IF EXISTS `notificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emissor_id` int NOT NULL,
  `recetor_id` int NOT NULL,
  `mensagem` varchar(256) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `recetor_id` (`recetor_id`),
  KEY `emissor_id` (`emissor_id`),
  CONSTRAINT `notificacao_ibfk_1` FOREIGN KEY (`recetor_id`) REFERENCES `membro` (`id`),
  CONSTRAINT `notificacao_ibfk_2` FOREIGN KEY (`emissor_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacao`
--

LOCK TABLES `notificacao` WRITE;
/*!40000 ALTER TABLE `notificacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opiniao`
--

DROP TABLE IF EXISTS `opiniao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opiniao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `opiniao` varchar(1024) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conteudo_id` char(36) NOT NULL,
  `membro_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `opiniao_ibfk_1` (`conteudo_id`),
  KEY `opiniao_ibfk_2` (`membro_id`),
  CONSTRAINT `opiniao_ibfk_1` FOREIGN KEY (`conteudo_id`) REFERENCES `conteudo` (`conteudo_id`),
  CONSTRAINT `opiniao_ibfk_2` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opiniao`
--

LOCK TABLES `opiniao` WRITE;
/*!40000 ALTER TABLE `opiniao` DISABLE KEYS */;
/*!40000 ALTER TABLE `opiniao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacao_simples`
--

DROP TABLE IF EXISTS `publicacao_simples`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publicacao_simples` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `imagem_file` varchar(256) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descricao` varchar(2048) DEFAULT NULL,
  `membro_id` int NOT NULL,
  KEY `publicacao_ibfk_1` (`membro_id`),
  CONSTRAINT `publicacao_ibfk_1` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacao_simples`
--

LOCK TABLES `publicacao_simples` WRITE;
/*!40000 ALTER TABLE `publicacao_simples` DISABLE KEYS */;
INSERT INTO `publicacao_simples` VALUES ('6994463c-0bfa-11f0-b3e1-32850793ca3b','imagem1.png','2025-03-28 17:30:58','Teste',1),('bfb7bd9e-0bfc-11f0-b3e1-32850793ca3b','bacalhau.jpg','2025-03-28 17:47:42','Bacalhau de natas',1),('cab96976-0bfd-11f0-b3e1-32850793ca3b','bacalhau1.jpg','2025-03-28 17:55:10','Teste',1),('f303f8c4-0bfd-11f0-b3e1-32850793ca3b','Pizza-3007395.jpg','2025-03-28 17:56:18','Pizza',1);
/*!40000 ALTER TABLE `publicacao_simples` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quik`
--

DROP TABLE IF EXISTS `quik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quik` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `titulo` varchar(256) NOT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` text NOT NULL,
  `receita_acoplada_id` varchar(36) DEFAULT '0',
  `membro_id` int NOT NULL,
  `seo_title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quik`
--

LOCK TABLES `quik` WRITE;
/*!40000 ALTER TABLE `quik` DISABLE KEYS */;
INSERT INTO `quik` VALUES ('5a99e07c-0b5c-11f0-9fb9-ab1770ec50cd','Como fazer Pizza em 60 segundos','Aprende a fazer uma piazza deliciosa em menos de 1 minuto','2025-03-27 22:39:33','video-2.mp4','d47ce8d6-0bc9-11f0-b3e1-32850793ca3b',1,'como-fazer-pizza-em-60-segundos');
/*!40000 ALTER TABLE `quik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receita`
--

DROP TABLE IF EXISTS `receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receita` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `token` int NOT NULL AUTO_INCREMENT,
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
  `video_longo_file` text,
  `quik_file` text,
  `categoria_id` int NOT NULL,
  `membro_id` int NOT NULL,
  `seo_title` varchar(64) NOT NULL,
  PRIMARY KEY (`token`),
  UNIQUE KEY `id` (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `membro_id` (`membro_id`),
  CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receita`
--

LOCK TABLES `receita` WRITE;
/*!40000 ALTER TABLE `receita` DISABLE KEYS */;
INSERT INTO `receita` VALUES ('a801408c-0b28-11f0-9fb9-ab1770ec50cd',27,'Bacalhau de Natas','Como fazer bacalhau de natas','2025-03-27 16:29:29',3,'hr',8,'Bacalhau,Batata,Natas,Cebolas,Alho','1.5kg,3kg,200ml,4,1 cabeça inteira','Cozer o bacalhau#\"Fritar\" as batatas#Alourar no forno#Servir','bacalhaudenatas#comidaportuguesa#comidatuga#','bacalhau-natas18.jpg',NULL,NULL,1,1,'bacalhau-de-natas'),('96ac0798-0b2a-11f0-9fb9-ab1770ec50cd',28,'Bife à portuguesa','Como fazer um belo bife à portuguesa','2025-03-27 16:43:19',45,'min',1,'Bife de Vazia,Alho,Batata frita','4,1 cabeça,500g','Cozinhar o bife#Fritar a batata#Servir','bifeaportuguesa#comidaportuguesa#comidatradicional#comidacaseira#bife','bife-portuguesa1.jpg',NULL,NULL,1,1,'bife-a-portuguesa'),('d0f51904-0b5b-11f0-9fb9-ab1770ec50cd',29,'Hamburger','Como fazer um hamburger','2025-03-27 22:35:42',30,'min',2,'Carne ,Pão,Cebola','1.5kg,2,2','Grelhar a carne#Adicionar molhos à escolha#Colocar dentro do pão#Servir','hamburger#comidaamericana#fastfood','hamburger21.jpg',NULL,NULL,1,1,'hamburger'),('d47ce8d6-0bc9-11f0-b3e1-32850793ca3b',30,'Pizza','Como fazer uma pizza deliciosa','2025-03-28 11:43:12',90,'min',4,'água,açúcar,fermento de padeiro fresco,farinha de trigo tipo 55,farinha de trigo tipo 56,azeite,sal','100ml,1 c. de café,10 g,200 g,1 c. de sopa,10 ml,1 c. de café','Coloque numa tigela a água, o açúcar e o fermento. Envolva delicadamente até diluir o fermento.#Adicione o azeite, o sal e a farinha. Amasse com as mãos até obter uma massa fofa e homogénea.#Tape a tigela com película aderente e reserve à temperatura ambiente até dobrar de volume.#Coloque a massa numa bancada polvilhada com a farinha, e está pronta para estender com um rolo da forma pretendida.','pizza#massapizza','Pizza-3007395.jpg',NULL,NULL,5,1,'pizza');
/*!40000 ALTER TABLE `receita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguir`
--

DROP TABLE IF EXISTS `seguir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguir` (
  `membro_id_1` int NOT NULL,
  `membro_id_2` int NOT NULL,
  PRIMARY KEY (`membro_id_1`,`membro_id_2`),
  KEY `membro_id_1` (`membro_id_1`),
  KEY `membro_id_2` (`membro_id_2`),
  CONSTRAINT `seguir-1` FOREIGN KEY (`membro_id_1`) REFERENCES `membro` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `seguir-2` FOREIGN KEY (`membro_id_2`) REFERENCES `membro` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguir`
--

LOCK TABLES `seguir` WRITE;
/*!40000 ALTER TABLE `seguir` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `member_id` int NOT NULL,
  `expires` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_longo`
--

DROP TABLE IF EXISTS `video_longo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video_longo` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `titulo` varchar(96) NOT NULL,
  `descricao` text,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `video_file` text NOT NULL,
  `quik_associado` text,
  `membro_id` int NOT NULL,
  KEY `mvideo_longo_ibfk_1` (`membro_id`),
  CONSTRAINT `mvideo_longo_ibfk_1` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_longo`
--

LOCK TABLES `video_longo` WRITE;
/*!40000 ALTER TABLE `video_longo` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_longo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-29  9:20:05
