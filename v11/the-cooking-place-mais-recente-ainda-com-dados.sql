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
-- Table structure for table `guardado`
--

DROP TABLE IF EXISTS `guardado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guardado` (
  `conteudo_id` char(36) NOT NULL,
  `membro_id` int NOT NULL,
  `file` varchar(256) NOT NULL,
  `tipo_conteudo` varchar(32) NOT NULL,
  PRIMARY KEY (`conteudo_id`,`membro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardado`
--

LOCK TABLES `guardado` WRITE;
/*!40000 ALTER TABLE `guardado` DISABLE KEYS */;
INSERT INTO `guardado` VALUES ('215cfb0e-2def-11f0-a545-0b589b023814',7,'IMG_1180.jpg','receita'),('37de49a0-0db0-11f0-aef6-c03ae3c3287d',1,'Salada de Salmão.jpg','publicação'),('39a0bb5a-2756-11f0-9dd3-51ad71309970',7,'IMG_1069.HEIC','publicação'),('51b611ec-2dee-11f0-a545-0b589b023814',1,'FBMeUhd8CpU','vídeo longo'),('6e964a5e-1c58-11f0-97d1-812844dd8a1b',1,'gUvAPyalIk4','quik'),('88b52496-327e-11f0-ab01-6dea4cbfda07',1,'LpiSGr-5x38','vídeo longo'),('9f8b63be-0db3-11f0-aef6-c03ae3c3287d',1,'Template-Size-for-Blog-Photos-24.jpg','publicação'),('9f8b63be-0db3-11f0-aef6-c03ae3c3287d',5,'Template-Size-for-Blog-Photos-24.jpg','publicação'),('a3dedcf2-2df2-11f0-a545-0b589b023814',1,'IMG_1181.HEIC','publicação');
/*!40000 ALTER TABLE `guardado` ENABLE KEYS */;
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
  PRIMARY KEY (`conteudo_id`,`membro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES ('0401c7c2-327e-11f0-ab01-6dea4cbfda07',3),('20304fbe-1086-11f0-8176-68ad2bce8a48',1),('20304fbe-1086-11f0-8176-68ad2bce8a48',5),('2eae389c-0cd7-11f0-ad38-c07b28542eea',1),('2eae389c-0cd7-11f0-ad38-c07b28542eea',5),('37de49a0-0db0-11f0-aef6-c03ae3c3287d',1),('51b611ec-2dee-11f0-a545-0b589b023814',1),('55c39e6a-1086-11f0-8176-68ad2bce8a48',1),('55c39e6a-1086-11f0-8176-68ad2bce8a48',5),('6e964a5e-1c58-11f0-97d1-812844dd8a1b',1),('7a52fe14-0cc7-11f0-ad38-c07b28542eea',5),('857fadbe-2928-11f0-a823-f23c55f4c915',1),('8f137cf2-1c3a-11f0-97d1-812844dd8a1b',1),('960587c0-244c-11f0-8d07-c52f987068b8',1),('96d26698-2fee-11f0-a272-cb5b63e242a3',3),('9f8b63be-0db3-11f0-aef6-c03ae3c3287d',1),('9f8b63be-0db3-11f0-aef6-c03ae3c3287d',6),('9f8b63be-0db3-11f0-aef6-c03ae3c3287d',14),('a3dedcf2-2df2-11f0-a545-0b589b023814',1),('a3dedcf2-2df2-11f0-a545-0b589b023814',3),('a801408c-0b28-11f0-9fb9-ab1770ec50cd',1),('c33ef908-1081-11f0-8176-68ad2bce8a48',1),('cab96976-0bfd-11f0-b3e1-32850793ca3b',1),('cedd6ad8-2756-11f0-9dd3-51ad71309970',1),('cedd6ad8-2756-11f0-9dd3-51ad71309970',7),('d0f51904-0b5b-11f0-9fb9-ab1770ec50cd',4),('f15d6650-0cb5-11f0-ad38-c07b28542eea',1),('f15d6650-0cb5-11f0-ad38-c07b28542eea',5),('fe3e1f54-0cb0-11f0-ad38-c07b28542eea',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membro`
--

LOCK TABLES `membro` WRITE;
/*!40000 ALTER TABLE `membro` DISABLE KEYS */;
INSERT INTO `membro` VALUES (1,'Tiago','Daniel','2005-12-29','M','tiagoamdaniel488@gmail.com','927599484','$2y$10$NuEYVI4bbkGPfMRodmNRVOVkIsKVNmuzBGiZpwjFHqpyRFGHafRRO','2025-03-27 11:50:10','Hey, eu sou o fundador to The Cooking Place ? ?','tiago-g1.png','imperador_supremo_do_universo','tiagodaniel'),(3,'Inês','Bastos','2005-06-13','F','inesbastos1998@gmail.com','926359930','$2y$10$ASI7ajKORj0TwzzGGnI1Kuplezk5QwGSyBAenfQXQIFoC0fT1jzJC','2025-03-29 16:13:52','','IMG_0391.jpeg','member','inesbastos'),(4,'martim','daniel','2025-01-01','M','martimluisdaniel.0@gmail.com','961898685','$2y$10$rqVqME5pOOk8cC8t14S6guyKY1akZBrD8YC3pAogIKzZ8CMZqmC/K','2025-03-29 19:47:31','','blank.jpg','member','martimdaniel'),(5,'Sónia','Daniel','1972-05-09','F','sism317@hotmail.com','966174558','$2y$10$7PVeag5vcjJePhQkeh.Bm.6Wq2B7XrQnmddi65RAXayMWqWktonRS','2025-03-30 21:32:03','Olá, adorei esta filosofia ade gastronomia','IMG_7355.jpeg','member','soniadaniel'),(6,'Luís','Daniel','1970-05-22','M','luismanueldaniel@gmail.com','966240395','$2y$10$.Qw5rwvVO7FJSiqKTsPcT.m/f5S/rdmESWXe4zVfZ/JjH1rAlv2Ya','2025-03-30 22:07:00','','Ver fotografias recentes.jpeg','member','luisdaniel'),(7,'Tiago','Silva','1993-12-05','M','tiago.f.simoes.silva@gmail.com','912345678','$2y$10$UsVS8emM2eiD2zoqJLjb0.ocDMVo9gUsv4hO/NYmoIcvxtlN9WHQ2','2025-05-10 22:26:01','Investigador de História da Arte','tiago-simaes-da-silva.jpg','member','tiagosilva'),(8,'Teste','Teste','2025-01-1','M','emailteste@gmail.com','900000000','$2y$10$761E/hSIWm1J0a1A7soP.ujbcoEcGEBIFfkXGud/wLH.YRGxpbO3y','2025-05-15 15:36:56','','blank.jpg','member','testeteste');
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
  `tipo` varchar(32) NOT NULL,
  `emissor_id` int DEFAULT NULL,
  `id_conteudo` char(36) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacao`
--

LOCK TABLES `notificacao` WRITE;
/*!40000 ALTER TABLE `notificacao` DISABLE KEYS */;
INSERT INTO `notificacao` VALUES (23,'envio_post',3,NULL,'2025-05-24 14:25:00',0),(24,'seguir',NULL,NULL,'2025-05-24 14:55:02',0),(25,'seguir',NULL,NULL,'2025-05-24 14:55:31',0),(26,'seguir',NULL,NULL,'2025-05-24 14:55:32',0),(27,'seguir',NULL,NULL,'2025-05-24 14:55:32',0),(28,'seguir',NULL,NULL,'2025-05-24 14:55:33',0),(29,'seguir',NULL,NULL,'2025-05-24 14:55:33',0),(30,'seguir',NULL,NULL,'2025-05-24 14:55:34',0),(31,'seguir',NULL,NULL,'2025-05-24 14:56:01',0);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opiniao`
--

LOCK TABLES `opiniao` WRITE;
/*!40000 ALTER TABLE `opiniao` DISABLE KEYS */;
INSERT INTO `opiniao` VALUES (1,'Parece ser ótimo!!!','2025-03-29 17:55:25','f15d6650-0cb5-11f0-ad38-c07b28542eea',1),(2,'Que bom aspeto','2025-03-29 17:55:37','fe3e1f54-0cb0-11f0-ad38-c07b28542eea',1),(3,'Uau Tiago, és incrível','2025-03-29 17:55:56','f15d6650-0cb5-11f0-ad38-c07b28542eea',3),(4,'comida de gorda','2025-03-29 19:49:30','d0f51904-0b5b-11f0-9fb9-ab1770ec50cd',4),(5,'Se tu conseguisse fazer isso era muito bom, mas não consegues ahahaha','2025-03-29 19:53:04','2eae389c-0cd7-11f0-ad38-c07b28542eea',1),(6,'Ganda parva','2025-03-30 17:16:10','2eae389c-0cd7-11f0-ad38-c07b28542eea',1),(7,'Tiago és maravilhoso!!! Parabéns ?','2025-03-30 21:33:48','f15d6650-0cb5-11f0-ad38-c07b28542eea',5),(8,'Parece ótimo!','2025-03-30 22:05:26','37de49a0-0db0-11f0-aef6-c03ae3c3287d',1),(9,'Uau','2025-03-30 22:09:39','9f8b63be-0db3-11f0-aef6-c03ae3c3287d',1),(10,'Teste','2025-04-03 11:34:01','9f8b63be-0db3-11f0-aef6-c03ae3c3287d',1),(11,'Olá','2025-04-03 11:47:05','9f8b63be-0db3-11f0-aef6-c03ae3c3287d',1),(12,'Que gostoso','2025-04-03 11:50:45','c33ef908-1081-11f0-8176-68ad2bce8a48',1),(13,'Parece muito bom❣️','2025-04-03 14:28:47','55c39e6a-1086-11f0-8176-68ad2bce8a48',5),(14,'A pizza é deliciosa\n','2025-04-12 10:20:55','d47ce8d6-0bc9-11f0-b3e1-32850793ca3b',1),(15,'Olá','2025-04-28 17:09:11','',1),(16,'Oi','2025-04-28 17:09:32','86c09a12-2446-11f0-8d07-c52f987068b8',1),(17,'Hey','2025-04-28 17:26:51','960587c0-244c-11f0-8d07-c52f987068b8',1),(18,'Hey','2025-04-28 19:04:44','434d399e-2463-11f0-8d07-c52f987068b8',1),(19,'És lindo Tiago!!','2025-05-04 22:32:00','cedd6ad8-2756-11f0-9dd3-51ad71309970',3),(22,'Gostei ?','2025-05-10 22:25:02','00386388-247a-11f0-8d07-c52f987068b8',1),(23,'Bom vídeo','2025-05-10 22:37:04','51b611ec-2dee-11f0-a545-0b589b023814',1),(24,'Olá','2025-05-13 12:56:51','6e964a5e-1c58-11f0-97d1-812844dd8a1b',1),(25,'Olá\n','2025-05-16 17:49:30','0401c7c2-327e-11f0-ab01-6dea4cbfda07',1),(26,'Olá','2025-05-16 17:49:56','0401c7c2-327e-11f0-ab01-6dea4cbfda07',3);
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
  `keywords` varchar(1024) DEFAULT NULL,
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
INSERT INTO `publicacao_simples` VALUES ('6994463c-0bfa-11f0-b3e1-32850793ca3b','imagem1.png','2025-03-28 17:30:58','Teste',NULL,1),('bfb7bd9e-0bfc-11f0-b3e1-32850793ca3b','bacalhau.jpg','2025-03-28 17:47:42','Bacalhau de natas',NULL,1),('cab96976-0bfd-11f0-b3e1-32850793ca3b','bacalhau1.jpg','2025-03-28 17:55:10','Teste',NULL,1),('f303f8c4-0bfd-11f0-b3e1-32850793ca3b','Pizza-3007395.jpg','2025-03-28 17:56:18','Pizza',NULL,1),('2eae389c-0cd7-11f0-ad38-c07b28542eea','bacalhau3.jpg','2025-03-29 19:51:18','amo',NULL,4),('37de49a0-0db0-11f0-aef6-c03ae3c3287d','Salada de Salmão.jpg','2025-03-30 21:44:55','Saúde e bem estar',NULL,5),('9f8b63be-0db3-11f0-aef6-c03ae3c3287d','Template-Size-for-Blog-Photos-24.jpg','2025-03-30 22:09:17','Cheesecake de morango',NULL,6),('20304fbe-1086-11f0-8176-68ad2bce8a48','image1.jpg','2025-04-03 12:21:10','Salada de Queijos',NULL,1),('55c39e6a-1086-11f0-8176-68ad2bce8a48','IMG_0747.jpeg','2025-04-03 12:22:39','',NULL,1),('8d09b7a0-2464-11f0-8d07-c52f987068b8','image21.jpg','2025-04-28 19:11:13','Tiago',NULL,1),('9b8c3a18-2479-11f0-8d07-c52f987068b8','hamburger-saus-maken1.webp','2025-04-28 21:41:56','Hamburger',NULL,1),('00386388-247a-11f0-8d07-c52f987068b8','hamburger-saus-maken2.webp','2025-04-28 21:44:45','Outro Hamburger',NULL,1),('4947d71c-2753-11f0-9dd3-51ad71309970','IMG_1088.jpg','2025-05-02 12:45:11','PHP&MYSQL do Jon Ducket',NULL,1),('39a0bb5a-2756-11f0-9dd3-51ad71309970','IMG_1069.HEIC','2025-05-02 13:06:13','Cadeiras Novas',NULL,1),('cedd6ad8-2756-11f0-9dd3-51ad71309970','IMG_1089.HEIC','2025-05-02 13:10:23','Tiago',NULL,1),('a3dedcf2-2df2-11f0-a545-0b589b023814','IMG_1181.HEIC','2025-05-10 23:01:00','The Cooking Place',NULL,1),('0401c7c2-327e-11f0-ab01-6dea4cbfda07','IMG_1347.HEIC','2025-05-16 17:48:46','Lache na casa da Inês',NULL,3),('6685bd86-37c4-11f0-a624-9bdb7ad2abe5','Captura de ecrã 2024-12-02, às 10.43.08.png','2025-05-23 10:55:12','Divide Setlist',NULL,1),('a199586a-37c4-11f0-a624-9bdb7ad2abe5','Captura de ecrã 2024-12-02, às 10.41.44.png','2025-05-23 10:56:51','Ed Sheeran',NULL,1),('904863c4-37c6-11f0-a624-9bdb7ad2abe5','Captura de ecrã 2024-09-27, às 01.09.44.png','2025-05-23 11:10:41','Teste',NULL,3),('b1b2458e-37c6-11f0-a624-9bdb7ad2abe5','modelo-de-mapa-ilha-desenho-animado-para-o-jogo-próximo-nível-pirata-com-criaturas-fantasia-antigas-do-tesouro-desenhado-vetor-183651272.webp','2025-05-23 11:11:37','Ilha',NULL,1),('9c2e8adc-37c7-11f0-a624-9bdb7ad2abe5','Captura de ecrã 2022-07-16, às 18.40.38.png','2025-05-23 11:18:10','Shorts',NULL,3),('9708dd4c-37cb-11f0-a624-9bdb7ad2abe5','Captura de ecrã 2024-05-20, às 22.48.56.png','2025-05-23 11:46:40','Ui Super ui A ouvir Patuh',NULL,1),('dec55610-37cb-11f0-a624-9bdb7ad2abe5','Captura de ecrã 2024-05-20, às 17.15.23.png','2025-05-23 11:48:40','Wallpaper',NULL,1),('44f8bbd8-37d2-11f0-a624-9bdb7ad2abe5','Captura de ecrã 2024-05-19, às 20.46.54.png','2025-05-23 12:34:28','Alguém no insta',NULL,1),('ebadf690-38aa-11f0-b20d-eaa67f8c3f99','Captura de ecrã 2024-05-19, às 08.08.22.png','2025-05-24 14:25:19','Irmã da Eva',NULL,3);
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
  `receita_acoplada_id` varchar(36) DEFAULT '0',
  `youtube_id` char(36) DEFAULT NULL,
  `keywords` varchar(1024) DEFAULT NULL,
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
INSERT INTO `quik` VALUES ('6e964a5e-1c58-11f0-97d1-812844dd8a1b','Douradinho','Vídeo com o Douradinho','2025-04-18 13:24:18','0','gUvAPyalIk4','animais',1,'douradinho'),('96d26698-2fee-11f0-a272-cb5b63e242a3','Tiago','Aqui estou eu!','2025-05-13 11:37:02','0','RUxffb8y6kc','tiago',1,'tiago'),('c0ad774e-37ca-11f0-a624-9bdb7ad2abe5','Caramelazinha','','2025-05-23 11:40:40','0','9LEU6VULLVE','',7,'caramelazinha');
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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receita`
--

LOCK TABLES `receita` WRITE;
/*!40000 ALTER TABLE `receita` DISABLE KEYS */;
INSERT INTO `receita` VALUES ('a801408c-0b28-11f0-9fb9-ab1770ec50cd',27,'Bacalhau de Natas','Como fazer bacalhau de natas','2025-03-27 16:29:29',3,'hr',8,'Bacalhau,Batata,Natas,Cebolas,Alho','1.5kg,3kg,200ml,4,1 cabeça inteira','Cozer o bacalhau#\"Fritar\" as batatas#Alourar no forno#Servir','bacalhaudenatas#comidaportuguesa#comidatuga#','bacalhau-natas18.jpg',NULL,NULL,1,1,'bacalhau-de-natas'),('96ac0798-0b2a-11f0-9fb9-ab1770ec50cd',28,'Bife à portuguesa','Como fazer um belo bife à portuguesa','2025-03-27 16:43:19',45,'min',1,'Bife de Vazia,Alho,Batata frita','4,1 cabeça,500g','Cozinhar o bife#Fritar a batata#Servir','bifeaportuguesa#comidaportuguesa#comidatradicional#comidacaseira#bife','bife-portuguesa1.jpg',NULL,NULL,1,1,'bife-a-portuguesa'),('d0f51904-0b5b-11f0-9fb9-ab1770ec50cd',29,'Hamburger','Como fazer um hamburger','2025-03-27 22:35:42',30,'min',2,'Carne ,Pão,Cebola','1.5kg,2,2','Grelhar a carne#Adicionar molhos à escolha#Colocar dentro do pão#Servir','hamburger#comidaamericana#fastfood','hamburger21.jpg',NULL,NULL,1,1,'hamburger'),('d47ce8d6-0bc9-11f0-b3e1-32850793ca3b',30,'Pizza','Como fazer uma pizza deliciosa','2025-03-28 11:43:12',90,'min',4,'água,açúcar,fermento de padeiro fresco,farinha de trigo tipo 55,farinha de trigo tipo 56,azeite,sal','100ml,1 c. de café,10 g,200 g,1 c. de sopa,10 ml,1 c. de café','Coloque numa tigela a água, o açúcar e o fermento. Envolva delicadamente até diluir o fermento.#Adicione o azeite, o sal e a farinha. Amasse com as mãos até obter uma massa fofa e homogénea.#Tape a tigela com película aderente e reserve à temperatura ambiente até dobrar de volume.#Coloque a massa numa bancada polvilhada com a farinha, e está pronta para estender com um rolo da forma pretendida.','pizza#massapizza','Pizza-3007395.jpg',NULL,NULL,5,1,'pizza'),('7a52fe14-0cc7-11f0-ad38-c07b28542eea',31,'Dorayaki','Como fazer os bolos tradicionais do Doraemon','2025-03-29 17:58:53',1,'hr',8,'Massa,Chocolate','200g,200g','Cozer a massa#Derreter o chocolate#Fechar e servir','dorayaki#comidajaponesa#doraemon','dorayaki-1024x1024.jpg',NULL,NULL,5,3,'dorayaki'),('86c09a12-2446-11f0-8d07-c52f987068b8',33,'Temaki','Como fazer Temaki','2025-04-28 15:36:17',45,'min',6,'Salmão,Alga Nori,Arroz','200g,10 unidades,500g','Fazer o temaki','japones','temaki7.jpg',NULL,NULL,1,1,'temaki'),('960587c0-244c-11f0-8d07-c52f987068b8',34,'Hambuger','Como fazer um hamburger','2025-04-28 16:19:40',1,'hr',4,'Carne,Pão','400g,4 fatias','Fazer #Bla Bla','hamburger','hamburger-saus-maken.webp',NULL,NULL,5,1,'hambuger'),('857fadbe-2928-11f0-a823-f23c55f4c915',35,'Bife','Como fazer Bife à Portuguesa','2025-05-04 20:44:06',45,'min',4,'Carne','500g','Deixe a carne descongelar','bife#carne','bife-portuguesa2.jpg',NULL,NULL,1,3,'bife'),('60d55580-3581-11f0-89e1-89f9456d5560',37,'Teste','Teste','2025-05-20 13:50:24',30,'min',1,'Teste','Teste','Teste','Teste','IMG_1180.HEIC',NULL,NULL,1,1,'teste'),('b8249968-3581-11f0-89e1-89f9456d5560',38,'Teste','Teste','2025-05-20 13:52:50',30,'min',1,'Teste','Teste','Teste','Teste','IMG_1347.HEIC',NULL,NULL,1,1,'teste'),('d05279b4-3582-11f0-89e1-89f9456d5560',39,'Teste','Teste','2025-05-20 14:00:40',30,'min',1,'Teste','Teste','Teste','Teste','IMG_1181.HEIC',NULL,NULL,1,1,'teste'),('d8fca000-3585-11f0-89e1-89f9456d5560',42,'Teste','Teste','2025-05-20 14:22:23',30,'min',1,'Teste','Teste','Teste','Teste','IMG_13471.HEIC',NULL,NULL,1,1,'teste'),('ed952b8a-3586-11f0-89e1-89f9456d5560',47,'Teste','Teste','2025-05-20 14:30:07',30,'min',1,'Teste','Teste','Teste','Teste','logo-the-cooking-place4.png',NULL,NULL,1,1,'teste'),('a53cd7ca-358b-11f0-89e1-89f9456d5560',48,'Bom Condutor','Bom Condutor','2025-05-20 15:03:53',27,'min',1,'Bom Condutor','Bom Condutor','Bom Condutor','Bom Condutor','Captura de ecrã 2025-05-12, às 07.44.54.png',NULL,NULL,1,1,'bom-condutor'),('e5038b64-36fe-11f0-a81b-7de5087637b3',49,'U LÁ LÁ','U LÁ LÁ','2025-05-22 11:21:24',1,'min',1,'U LÁ LÁ','U LÁ LÁ','U LÁ LÁ','U LÁ LÁ','Captura de ecrã 2025-05-20, às 14.36.56 1.png',NULL,NULL,1,3,'u-la-la'),('0d1ce62c-36ff-11f0-a81b-7de5087637b3',50,'YOU\'RE SO NAIVE','YOU\'RE SO NAIVE','2025-05-22 11:22:31',30,'min',1,'YOU\'RE SO NAIVE,YOU\'RE SO NAIVE,YOU\'RE SO NAIVE','YOU\'RE SO NAIVE,YOU\'RE SO NAIVE,YOU\'RE SO NAIVE','YOU\'RE SO NAIVE#YOU\'RE SO NAIVE','YOU\'RE SO NAIVE','Captura de ecrã 2025-05-10, às 23.54.36.png',NULL,NULL,1,3,'you\'re-so-naive'),('a693ac6e-36ff-11f0-a81b-7de5087637b3',51,'The Cooking Place','Logo','2025-05-22 11:26:48',3,'hr',1,'Paciência,Dedicação','Muita,Unpressedentent','Ui','','logo-the-cooking-place5.png',NULL,NULL,1,1,'the-cooking-place'),('6acad652-3700-11f0-a81b-7de5087637b3',52,'Teste WebSocket','Teste WebSocket','2025-05-22 11:32:17',30,'min',1,'Teste WebSocket','Teste WebSocket','Teste WebSocket','Teste WebSocket','Captura de ecrã 2025-05-20, às 14.36.56 11.png',NULL,NULL,1,1,'teste-websocket'),('4f0b616c-3704-11f0-a81b-7de5087637b3',53,'ui','ui','2025-05-22 12:00:09',3,'min',1,'pp','pp','ii','ii','Captura de ecrã 2025-05-12, às 07.44.541.png',NULL,NULL,1,1,'ui'),('b3620e9c-37c0-11f0-a624-9bdb7ad2abe5',54,'The Cooking Place','Como fazer uma Rede Social','2025-05-23 10:28:43',3,'hr',1,'Paciência,Dedicação','MUIIIIIIIITA,Ainda mais que MUUUUUITA','Saber Fazer','tiago','logo-the-cooking-place6.png',NULL,NULL,1,1,'the-cooking-place'),('4abc3786-37c1-11f0-a624-9bdb7ad2abe5',55,'Teste','Teste','2025-05-23 10:32:57',5,'min',1,'Teste','Teste','Teste','Teste','Captura de ecrã 2025-05-20, às 14.36.56 12.png',NULL,NULL,1,7,'teste'),('f54b6530-37c3-11f0-a624-9bdb7ad2abe5',56,'Teste','Teste','2025-05-23 10:52:02',30,'min',1,'Teste','Teste','Teste','Teste','Captura de ecrã 2025-03-16, às 23.30.01.png',NULL,NULL,1,1,'teste'),('6690ddf4-37c6-11f0-a624-9bdb7ad2abe5',57,'Ações','Ações','2025-05-23 11:09:31',1,'hr',1,'Ações','Ações','Ações','Ações','Captura de ecrã 2025-01-22, às 14.35.51.png',NULL,NULL,1,1,'acoes'),('c20f8a90-37cb-11f0-a624-9bdb7ad2abe5',58,'Calção Azul','Calção Azul','2025-05-23 11:47:52',23,'min',1,'Calção Azul','Calção Azul','Calção Azul','Calção Azul','Captura de ecrã 2022-07-17, às 19.27.45.png',NULL,NULL,1,3,'calcao-azul');
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
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (135,'a94cdc3d095e3d79c9cfe49e962797546a7c6afde66ebadf3a8c4c9041ba1aa5b8468aa26fe0ce830519c2b56c9f89c21d073f03c7d8b27f8ee6f00acadb0f28',1,'2025-06-11 13:36:01','stay_logged_id'),(136,'801b92dccc98109eb384ba8310b6c11b7e51a7639d4ce41e467ec66f971e8202c895283084b912a390ec03a2a8bdcb029b9bba308b27815d236f4a5f216ce86e',7,'2025-06-11 13:36:12','stay_logged_id'),(137,'55bce2ec786bca7c91d57a2b0fc5a0808edf06a564bd820722e2ebba5a2da9363069e6e9517545699facaefc3f9f0fb10c60166472ba07257cc2e8ffde1fdda7',3,'2025-06-11 13:36:26','stay_logged_id'),(138,'c1334fc91d9b7b25998c91f4cee59c6c192664ec95add93014280f3991733277e366291c2ad55fb8d0411f894685dd092dbd40076032366b5c70f9d29472b971',6,'2025-06-11 13:36:48','stay_logged_id'),(139,'134c5bbbf1d09343bf224d2d62d6d78f34c4d937cc60fbc0f33676a610fd35461c9ea187c7fb23c8e46c7c2b180d0d2e7189fcfc113997eb1b5ef2f625dee842',3,'2025-06-12 12:24:42','stay_logged_id');
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
  `titulo` varchar(96) DEFAULT NULL,
  `descricao` text,
  `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `youtube_id` varchar(32) NOT NULL,
  `membro_id` int DEFAULT NULL,
  `keywords` varchar(1024) DEFAULT NULL,
  `seo_title` varchar(96) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `youtube_id` (`youtube_id`),
  KEY `membro_id` (`membro_id`),
  CONSTRAINT `video_longo_ibfk_1` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_longo`
--

LOCK TABLES `video_longo` WRITE;
/*!40000 ALTER TABLE `video_longo` DISABLE KEYS */;
INSERT INTO `video_longo` VALUES ('3953a24c-194c-11f0-80ca-f7e8a78cc63b','Teste','Descrição teste','2025-04-14 16:19:21','Ya4F8dn4h8Q',1,'','teste'),('4aa52fea-37c7-11f0-a624-9bdb7ad2abe5','Charlie Puth','Yeahs do Charlie Puth','2025-05-23 11:15:53','SbaQzdYBVmw',7,'charlieputh','charlie-puth'),('51b611ec-2dee-11f0-a545-0b589b023814','Teste Tiagos','Acabei de perder toda a descrição que tinha escrito. Vamos lá tentar fazer outra vez uma descrição mais ou menos do mesmo tamanho e esperar que não hajam mais erro por não ter o client_secret.json na pasta do projeto ?. Estou a ouvir Legião Urbana. Para já ainda prefiro o Cazuza. Aquela canção de Portugal na Eurovisão, afinal já não a acho tão má. Pela 13:30 tenho que me começar a preparar para ir à Sandra cortar o cabelo. Também, mais para a frente, comelar a pensar na usabilidade e utilidade dos diferentes tipos de conteúdo no The Cooking Place, tal como falei com o Tiago. Acho que esta descrição já tem um tamanho bom. Mas desta vez faço copiar antes de mandar. Ainda bem que fiz ?','2025-05-10 22:30:04','FBMeUhd8CpU',7,'teste#saomiguel#acores','teste-tiagos'),('88b52496-327e-11f0-ab01-6dea4cbfda07','Cabelo do Tiago','Cabelo do Tiago','2025-05-16 17:52:28','LpiSGr-5x38',1,'','cabelo-do-tiago'),('f4c2f2de-37ca-11f0-a624-9bdb7ad2abe5','Hey','Música do/sobre o Peixoto, mas também as outras 3 raparigas','2025-05-23 11:42:07','njvYJXZxUNY',1,'','hey');
/*!40000 ALTER TABLE `video_longo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `membro_id` int NOT NULL,
  `conteudo_id` char(36) NOT NULL,
  `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `membro_id` (`membro_id`),
  CONSTRAINT `views_ibfk_1` FOREIGN KEY (`membro_id`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views`
--

LOCK TABLES `views` WRITE;
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` VALUES (16,1,'a3dedcf2-2df2-11f0-a545-0b589b023814','2025-05-15 12:42:41'),(17,1,'a3dedcf2-2df2-11f0-a545-0b589b023814','2025-05-15 12:42:54'),(18,3,'4947d71c-2753-11f0-9dd3-51ad71309970','2025-05-15 12:43:26'),(19,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-15 15:29:53'),(20,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-15 15:29:54'),(21,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:05:16'),(22,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:05:39'),(23,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:06:33'),(24,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:06:35'),(25,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-16 12:07:26'),(26,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-16 12:07:27'),(27,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:07:29'),(28,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:07:29'),(29,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:07:33'),(30,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:07:34'),(31,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:07:53'),(32,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:08:20'),(33,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:08:25'),(34,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:08:37'),(35,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:08:42'),(36,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:08:43'),(37,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:08:44'),(38,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:09:08'),(39,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:10:48'),(40,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:11:01'),(41,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:11:04'),(42,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:11:41'),(43,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:11:51'),(44,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:11:53'),(45,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:12:19'),(46,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:12:25'),(47,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:12:38'),(48,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:13:07'),(49,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:13:21'),(50,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:13:38'),(51,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:13:39'),(52,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:13:56'),(53,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:13:57'),(54,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:13:58'),(55,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:13:58'),(56,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:03'),(57,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:03'),(58,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:04'),(59,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:05'),(60,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:08'),(61,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:09'),(62,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:10'),(63,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:11'),(64,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:15'),(65,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:15'),(66,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:23'),(67,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:26'),(68,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:27'),(69,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:33'),(70,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:14:35'),(71,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:16:14'),(72,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:16:15'),(73,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:16:16'),(74,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:16:21'),(75,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:16:22'),(76,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:16:23'),(77,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:17:10'),(78,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:17:15'),(79,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:17:17'),(80,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:17:25'),(81,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:17:27'),(82,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:18:17'),(83,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:18:25'),(84,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:18:29'),(85,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:18:30'),(86,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:18:53'),(87,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:18:55'),(88,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:18:57'),(89,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:13'),(90,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:14'),(91,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:16'),(92,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:24'),(93,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:31'),(94,1,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:32'),(95,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:58'),(96,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:19:59'),(97,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:28:11'),(98,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:28:31'),(99,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:28:42'),(100,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:28:53'),(101,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:28:57'),(102,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:29:04'),(103,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:29:10'),(104,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:29:18'),(105,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:29:27'),(106,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:29:28'),(107,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:29:35'),(108,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:29:46'),(109,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:32:55'),(110,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:33:32'),(111,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:33:33'),(112,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:34:01'),(113,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:34:25'),(114,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:34:38'),(115,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:34:46'),(116,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:34:55'),(117,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:35:24'),(118,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:36:50'),(119,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:36:57'),(120,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:37:22'),(121,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:37:30'),(122,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:37:36'),(123,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:38:23'),(124,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:38:31'),(125,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:39:03'),(126,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:39:56'),(127,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:40:35'),(128,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:41:45'),(129,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:41:50'),(130,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:42:03'),(131,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:42:05'),(132,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:42:08'),(133,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:42:26'),(134,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:42:46'),(135,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:42:50'),(136,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:44:20'),(137,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:44:29'),(138,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:45:29'),(139,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:45:32'),(140,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:46:20'),(141,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:46:41'),(142,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:46:59'),(143,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:47:05'),(144,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:47:09'),(145,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:47:11'),(146,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:47:15'),(147,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:47:16'),(148,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:47:20'),(149,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:47:23'),(150,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:48:03'),(151,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:48:08'),(152,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:48:19'),(153,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:48:38'),(154,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:49:02'),(155,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:49:06'),(156,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:49:46'),(157,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:50:00'),(158,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:51:10'),(159,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:51:15'),(160,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:51:30'),(161,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:51:39'),(162,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:52:10'),(163,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:52:25'),(164,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:52:28'),(165,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:52:37'),(166,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:53:17'),(167,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:53:37'),(168,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:53:41'),(169,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:54:10'),(170,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:54:51'),(171,1,'3953a24c-194c-11f0-80ca-f7e8a78cc63b','2025-05-16 12:55:26'),(172,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:55:59'),(173,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:56:40'),(174,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:56:41'),(175,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:56:43'),(176,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:57:02'),(177,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:57:29'),(178,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:57:31'),(179,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:57:39'),(180,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:57:44'),(181,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:57:48'),(182,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:57:49'),(183,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:58:09'),(184,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:58:23'),(185,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:58:54'),(186,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:59:03'),(187,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:59:21'),(188,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:59:26'),(189,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:59:31'),(190,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 12:59:37'),(191,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 13:00:14'),(192,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 13:00:15'),(193,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 13:00:17'),(194,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 13:00:26'),(195,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 13:00:29'),(196,7,'51b611ec-2dee-11f0-a545-0b589b023814','2025-05-16 13:00:33'),(197,3,'','2025-05-16 17:45:03'),(198,3,'d0f51904-0b5b-11f0-9fb9-ab1770ec50cd','2025-05-16 17:45:36'),(199,3,'d0f51904-0b5b-11f0-9fb9-ab1770ec50cd','2025-05-16 17:45:37'),(200,3,'d0f51904-0b5b-11f0-9fb9-ab1770ec50cd','2025-05-16 17:45:37'),(201,3,'0401c7c2-327e-11f0-ab01-6dea4cbfda07','2025-05-16 17:48:51'),(202,1,'69966482-3583-11f0-89e1-89f9456d5560','2025-05-20 14:05:08'),(203,1,'69966482-3583-11f0-89e1-89f9456d5560','2025-05-20 14:05:09'),(204,1,'69966482-3583-11f0-89e1-89f9456d5560','2025-05-20 14:05:09'),(205,1,'1a2a15f8-3586-11f0-89e1-89f9456d5560','2025-05-20 14:25:00'),(206,1,'1a2a15f8-3586-11f0-89e1-89f9456d5560','2025-05-20 14:25:01'),(207,1,'1a2a15f8-3586-11f0-89e1-89f9456d5560','2025-05-20 14:25:01'),(208,1,'4902651a-3586-11f0-89e1-89f9456d5560','2025-05-20 14:25:45'),(209,1,'4902651a-3586-11f0-89e1-89f9456d5560','2025-05-20 14:25:46'),(210,1,'4902651a-3586-11f0-89e1-89f9456d5560','2025-05-20 14:25:46'),(211,1,'6ce0ecd6-3586-11f0-89e1-89f9456d5560','2025-05-20 14:27:09'),(212,1,'6ce0ecd6-3586-11f0-89e1-89f9456d5560','2025-05-20 14:27:10'),(213,1,'6ce0ecd6-3586-11f0-89e1-89f9456d5560','2025-05-20 14:27:10'),(214,1,'99cac168-3586-11f0-89e1-89f9456d5560','2025-05-20 14:29:30'),(215,1,'99cac168-3586-11f0-89e1-89f9456d5560','2025-05-20 14:29:31'),(216,1,'99cac168-3586-11f0-89e1-89f9456d5560','2025-05-20 14:29:31'),(217,1,'cb8ff37c-3585-11f0-89e1-89f9456d5560','2025-05-20 14:36:46'),(218,1,'cb8ff37c-3585-11f0-89e1-89f9456d5560','2025-05-20 14:36:47'),(219,1,'cb8ff37c-3585-11f0-89e1-89f9456d5560','2025-05-20 14:36:47'),(220,1,'cb8ff37c-3585-11f0-89e1-89f9456d5560','2025-05-20 14:36:58'),(221,1,'cb8ff37c-3585-11f0-89e1-89f9456d5560','2025-05-20 14:36:59'),(222,1,'cb8ff37c-3585-11f0-89e1-89f9456d5560','2025-05-20 14:36:59'),(223,1,'f4c2f2de-37ca-11f0-a624-9bdb7ad2abe5','2025-05-23 11:44:48'),(224,1,'44f8bbd8-37d2-11f0-a624-9bdb7ad2abe5','2025-05-23 12:34:30'),(225,1,'9708dd4c-37cb-11f0-a624-9bdb7ad2abe5','2025-05-24 14:28:11'),(226,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-24 14:28:21'),(227,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-24 14:28:21'),(228,1,'9708dd4c-37cb-11f0-a624-9bdb7ad2abe5','2025-05-24 14:28:28'),(229,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-24 14:28:29'),(230,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-24 14:28:30'),(231,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-24 14:28:33'),(232,1,'96d26698-2fee-11f0-a272-cb5b63e242a3','2025-05-24 14:28:34'),(233,3,'ebadf690-38aa-11f0-b20d-eaa67f8c3f99','2025-05-24 14:52:31'),(234,1,'f4c2f2de-37ca-11f0-a624-9bdb7ad2abe5','2025-06-04 13:37:46'),(235,7,'ebadf690-38aa-11f0-b20d-eaa67f8c3f99','2025-06-04 13:50:24');
/*!40000 ALTER TABLE `views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `youtube_tokens`
--

DROP TABLE IF EXISTS `youtube_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `youtube_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `access_token` text NOT NULL,
  `refresh_token` text NOT NULL,
  `expires_in` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `youtube_tokens`
--

LOCK TABLES `youtube_tokens` WRITE;
/*!40000 ALTER TABLE `youtube_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `youtube_tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-05 12:37:14
