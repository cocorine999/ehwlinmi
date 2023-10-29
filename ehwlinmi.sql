-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: ehwlinmi
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

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
-- Table structure for table `assures`
--

DROP TABLE IF EXISTS `assures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assures`
--

LOCK TABLES `assures` WRITE;
/*!40000 ALTER TABLE `assures` DISABLE KEYS */;
INSERT INTO `assures` VALUES (1,NULL,'2020-03-05 10:37:28','2020-03-05 10:37:28'),(2,NULL,'2020-03-07 16:45:08','2020-03-07 16:45:08'),(3,NULL,'2020-03-07 16:56:10','2020-03-07 16:56:10');
/*!40000 ALTER TABLE `assures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficiaires`
--

DROP TABLE IF EXISTS `beneficiaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beneficiaires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Normal',
  `label` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taux` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiaires`
--

LOCK TABLES `beneficiaires` WRITE;
/*!40000 ALTER TABLE `beneficiaires` DISABLE KEYS */;
INSERT INTO `beneficiaires` VALUES (1,'Normal',NULL,100,NULL,'2020-03-05 10:37:58','2020-03-05 10:37:58'),(2,'Normal',NULL,50,NULL,'2020-03-07 16:51:26','2020-03-07 16:51:26'),(3,'Normal',NULL,50,NULL,'2020-03-07 16:51:26','2020-03-07 16:51:26'),(4,'Normal',NULL,100,NULL,'2020-03-07 16:57:28','2020-03-07 16:57:28');
/*!40000 ALTER TABLE `beneficiaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `marchand_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_marchand_id_foreign` (`marchand_id`),
  CONSTRAINT `clients_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,2,NULL,'2020-03-05 10:37:28','2020-03-05 10:37:28'),(2,3,NULL,'2020-03-07 16:45:08','2020-03-07 16:45:08'),(3,3,NULL,'2020-03-07 16:56:10','2020-03-07 16:56:10');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communes`
--

DROP TABLE IF EXISTS `communes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `communes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `communes_departement_id_foreign` (`departement_id`),
  CONSTRAINT `communes_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communes`
--

LOCK TABLES `communes` WRITE;
/*!40000 ALTER TABLE `communes` DISABLE KEYS */;
INSERT INTO `communes` VALUES (1,'Banikoara',1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,'Gogounou',1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,'Kandi',1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(4,'Karimama',1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(5,'Malanville',1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(6,'Segbana',1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(7,'Boukoumbé',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(8,'Cobly',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(9,'Kérou',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(10,'Kouandé',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(11,'Matéri',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(12,'Natitingou',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(13,'Pehonko',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(14,'Tanguiéta',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(15,'Toucountouna',2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(16,'Abomey-Calavi',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(17,'Allada',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(18,'Kpomassè',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(19,'Ouidah',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(20,'Sô-Ava',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(21,'Toffo',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(22,'Tori-Bossito',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(23,'Zè',3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(24,'Bembéréké',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(25,'Kalalé',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(26,'N\'Dali',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(27,'Nikki',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(28,'Parakou',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(29,'Pèrèrè',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(30,'Sinendé',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(31,'Tchaourou',4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(32,'Bantè',5,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(33,'Dassa-Zoumè',5,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(34,'Glazoué',5,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(35,'Ouèssè',5,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(36,'Savalou',5,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(37,'Savè',5,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(38,'Aplahoué',6,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(39,'Djakotomey',6,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(40,'Dogbo-Tota',6,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(41,'Klouékanmè',6,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(42,'Lalo',6,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(43,'Toviklin',6,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(44,'Bassila',7,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(45,'Copargo',7,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(46,'Djougou',7,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(47,'Ouaké',7,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(48,'Cotonou',8,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(49,'Athiémé',9,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(50,'Bopa',9,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(51,'Comè',9,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(52,'Grand-Popo',9,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(53,'Houéyogbé',9,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(54,'Lokossa',9,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(55,'Adjarra',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(56,'Adjohoun',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(57,'Aguégués',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(58,'Akpro-Missérété',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(59,'Avrankou',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(60,'Bonou',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(61,'Dangbo',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(62,'Porto-Novo',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(63,'Sèmè-Kpodji',10,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(64,'Adja-Ouèrè',11,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(65,'Ifangni',11,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(66,'Kétou',11,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(67,'Pobè',11,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(68,'Sakété',11,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(69,'Abomey',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(70,'Agbangnizoun',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(71,'Bohicon',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(72,'Covè',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(73,'Djidja',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(74,'Ouinhi',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(75,'Zangnanado',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(76,'Za-Kpota',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(77,'Zogbodomey',12,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07');
/*!40000 ALTER TABLE `communes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrat_beneficiaire`
--

DROP TABLE IF EXISTS `contrat_beneficiaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrat_beneficiaire` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `beneficiaire_id` bigint unsigned NOT NULL,
  `contrat_id` bigint unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrat_beneficiaire_beneficiaire_id_foreign` (`beneficiaire_id`),
  KEY `contrat_beneficiaire_contrat_id_foreign` (`contrat_id`),
  CONSTRAINT `contrat_beneficiaire_beneficiaire_id_foreign` FOREIGN KEY (`beneficiaire_id`) REFERENCES `beneficiaires` (`id`),
  CONSTRAINT `contrat_beneficiaire_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrat_beneficiaire`
--

LOCK TABLES `contrat_beneficiaire` WRITE;
/*!40000 ALTER TABLE `contrat_beneficiaire` DISABLE KEYS */;
INSERT INTO `contrat_beneficiaire` VALUES (1,1,1,1,NULL,NULL,NULL),(2,2,2,1,NULL,NULL,NULL),(3,3,2,1,NULL,NULL,NULL),(4,4,3,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `contrat_beneficiaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrat_marchand`
--

DROP TABLE IF EXISTS `contrat_marchand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrat_marchand` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `marchand_id` bigint unsigned NOT NULL,
  `contrat_id` bigint unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrat_marchand_marchand_id_foreign` (`marchand_id`),
  KEY `contrat_marchand_contrat_id_foreign` (`contrat_id`),
  CONSTRAINT `contrat_marchand_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`),
  CONSTRAINT `contrat_marchand_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrat_marchand`
--

LOCK TABLES `contrat_marchand` WRITE;
/*!40000 ALTER TABLE `contrat_marchand` DISABLE KEYS */;
INSERT INTO `contrat_marchand` VALUES (1,2,1,1,NULL,NULL,NULL),(2,3,2,1,NULL,NULL,NULL),(3,3,3,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `contrat_marchand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `assure_id` bigint unsigned NOT NULL,
  `q1` tinyint(1) NOT NULL DEFAULT '0',
  `q2` tinyint(1) NOT NULL DEFAULT '0',
  `q3` tinyint(1) NOT NULL DEFAULT '0',
  `q4` tinyint(1) NOT NULL DEFAULT '0',
  `q5` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrats_client_id_foreign` (`client_id`),
  KEY `contrats_assure_id_foreign` (`assure_id`),
  CONSTRAINT `contrats_assure_id_foreign` FOREIGN KEY (`assure_id`) REFERENCES `assures` (`id`),
  CONSTRAINT `contrats_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrats`
--

LOCK TABLES `contrats` WRITE;
/*!40000 ALTER TABLE `contrats` DISABLE KEYS */;
INSERT INTO `contrats` VALUES (1,'2A2N1756',1,1,0,0,0,0,1,NULL,'2020-03-05 10:37:28','2020-03-05 10:37:28'),(2,'46L3N1255',2,2,0,0,0,0,1,NULL,'2020-03-07 16:45:08','2020-03-07 16:45:08'),(3,'46L3N2684',3,3,0,0,0,0,1,NULL,'2020-03-07 16:56:10','2020-03-07 16:56:10');
/*!40000 ALTER TABLE `contrats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departements`
--

DROP TABLE IF EXISTS `departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefecture` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departements`
--

LOCK TABLES `departements` WRITE;
/*!40000 ALTER TABLE `departements` DISABLE KEYS */;
INSERT INTO `departements` VALUES (1,'Alibori','Y','Kandi',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,'Atacora','V','Natitingou',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,'Atlantique','A','Allada',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(4,'Borgou','B','Parakou',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(5,'Collines','C','Dassa-Zoumè',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(6,'Couffo','U','Aplahoué',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(7,'Donga','D','Djougou',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(8,'Littoral','L','Cotonou',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(9,'Mono','M','Lokossa',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(10,'Ouémé','O','Porto-Novo',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(11,'Plateau','P','Pobè',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(12,'Zou','Z','Abomey',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07');
/*!40000 ALTER TABLE `departements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `directions`
--

DROP TABLE IF EXISTS `directions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `directions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directions`
--

LOCK TABLES `directions` WRITE;
/*!40000 ALTER TABLE `directions` DISABLE KEYS */;
INSERT INTO `directions` VALUES (1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(4,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(5,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(6,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07');
/*!40000 ALTER TABLE `directions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etats`
--

DROP TABLE IF EXISTS `etats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etats`
--

LOCK TABLES `etats` WRITE;
/*!40000 ALTER TABLE `etats` DISABLE KEYS */;
/*!40000 ALTER TABLE `etats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fichiers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichierable_id` bigint unsigned NOT NULL,
  `fichierable_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichiers`
--

LOCK TABLES `fichiers` WRITE;
/*!40000 ALTER TABLE `fichiers` DISABLE KEYS */;
INSERT INTO `fichiers` VALUES (1,'CNI','1583404648CNI2A2N1756.png',1,'App\\Models\\Contrat',NULL,'2020-03-05 10:37:28','2020-03-05 10:37:28'),(2,'BAI','1583404648BAI2A2N1756.jpg',1,'App\\Models\\Contrat',NULL,'2020-03-05 10:37:28','2020-03-05 10:37:28'),(3,'CNI','1583599508CNI46L3N1255.jpg',2,'App\\Models\\Contrat',NULL,'2020-03-07 16:45:08','2020-03-07 16:45:08'),(4,'BAI','1583599508BAI46L3N1255.jpg',2,'App\\Models\\Contrat',NULL,'2020-03-07 16:45:08','2020-03-07 16:45:08'),(5,'CNI','1583600170CNI46L3N2684.png',3,'App\\Models\\Contrat',NULL,'2020-03-07 16:56:10','2020-03-07 16:56:10'),(6,'BAI','1583600170BAI46L3N2684.png',3,'App\\Models\\Contrat',NULL,'2020-03-07 16:56:10','2020-03-07 16:56:10');
/*!40000 ALTER TABLE `fichiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itadmins`
--

DROP TABLE IF EXISTS `itadmins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itadmins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itadmins`
--

LOCK TABLES `itadmins` WRITE;
/*!40000 ALTER TABLE `itadmins` DISABLE KEYS */;
/*!40000 ALTER TABLE `itadmins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marchand_super_marchand`
--

DROP TABLE IF EXISTS `marchand_super_marchand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marchand_super_marchand` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `marchand_id` bigint unsigned NOT NULL,
  `super_marchand_id` bigint unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marchand_super_marchand_marchand_id_foreign` (`marchand_id`),
  KEY `marchand_super_marchand_super_marchand_id_foreign` (`super_marchand_id`),
  CONSTRAINT `marchand_super_marchand_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`),
  CONSTRAINT `marchand_super_marchand_super_marchand_id_foreign` FOREIGN KEY (`super_marchand_id`) REFERENCES `super_marchands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marchand_super_marchand`
--

LOCK TABLES `marchand_super_marchand` WRITE;
/*!40000 ALTER TABLE `marchand_super_marchand` DISABLE KEYS */;
INSERT INTO `marchand_super_marchand` VALUES (1,1,1,1,NULL,NULL,NULL),(2,2,2,1,NULL,NULL,NULL),(3,3,46,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `marchand_super_marchand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marchands`
--

DROP TABLE IF EXISTS `marchands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marchands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registre` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personne` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marchands`
--

LOCK TABLES `marchands` WRITE;
/*!40000 ALTER TABLE `marchands` DISABLE KEYS */;
INSERT INTO `marchands` VALUES (1,'','test','test','morale',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,'2A2',NULL,NULL,'physique',NULL,'2020-03-05 07:33:15','2020-03-05 07:33:15'),(3,'46L3',NULL,NULL,'physique',NULL,'2020-03-07 16:15:28','2020-03-07 16:15:28');
/*!40000 ALTER TABLE `marchands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2018_11_06_222923_create_transactions_table',1),(9,'2018_11_07_192923_create_transfers_table',1),(10,'2018_11_07_202152_update_transfers_table',1),(11,'2018_11_15_124230_create_wallets_table',1),(12,'2018_11_19_164609_update_transactions_table',1),(13,'2018_11_20_133759_add_fee_transfers_table',1),(14,'2018_11_22_131953_add_status_transfers_table',1),(15,'2018_11_22_133438_drop_refund_transfers_table',1),(16,'2019_05_13_111553_update_status_transfers_table',1),(17,'2019_06_25_103755_add_exchange_status_transfers_table',1),(18,'2019_07_29_184926_decimal_places_wallets_table',1),(19,'2019_08_19_000000_create_failed_jobs_table',1),(20,'2019_10_02_193759_add_discount_transfers_table',1),(21,'2020_01_04_075745_create_departements_table',1),(22,'2020_01_04_075756_create_communes_table',1),(23,'2020_01_04_093525_add_commune_id_to_users_table',1),(24,'2020_01_04_100148_create_permission_tables',1),(25,'2020_01_05_220756_create_directions_table',1),(26,'2020_01_05_220805_create_super_marchands_table',1),(27,'2020_01_05_220809_create_marchands_table',1),(28,'2020_01_05_220812_create_clients_table',1),(29,'2020_01_05_220816_create_assures_table',1),(30,'2020_01_05_220819_create_beneficiaires_table',1),(31,'2020_01_05_221119_create_contrats_table',1),(32,'2020_01_06_011013_create_nsias_table',1),(33,'2020_01_06_081056_create_userables_table',1),(34,'2020_01_11_225455_create_prospects_table',1),(35,'2020_01_11_225610_create_soldes_table',1),(36,'2020_01_14_210138_create_contrat_beneficiaire_table',1),(37,'2020_01_14_212755_create_fichiers_table',1),(38,'2020_01_18_072713_create_sinistres_table',1),(39,'2020_01_21_125829_create_etats_table',1),(40,'2020_02_02_135107_create_sms_table',1),(41,'2020_02_08_211910_create_mobile_money_table',1),(42,'2020_02_19_035733_create_tempp_table',1),(43,'2020_02_23_164101_create_souscriptions_table',1),(44,'2020_02_23_164821_create_statut_souscriptions_table',1),(45,'2020_02_23_170706_create_souscription_statut_souscription_table',1),(46,'2020_02_23_171255_create_primes_table',1),(47,'2020_02_26_120710_create_contrat_marchand_table',1),(48,'2020_02_29_135123_create_marchand_super_marchand_table',1),(49,'2020_03_08_091842_create_itadmins_table',2),(50,'2020_03_08_145649_add_user_id_to_nsias_table',2),(51,'2020_03_24_155107_create_notifications_table',2),(52,'2020_03_24_165507_create_jobs_table',2),(53,'2020_03_31_235824_create_versements_table',2),(54,'2020_05_15_200746_add_recevoir_commission_to_users_table',2),(55,'2020_05_23_070230_create_ticket_statuses_table',2),(56,'2020_05_23_070344_create_ticket_priorities_table',2),(57,'2020_05_23_070426_create_ticket_categories_table',2),(58,'2020_05_23_070442_create_tickets_table',2),(59,'2020_05_23_070518_create_ticket_comments_table',2),(60,'2020_07_09_184428_add_field_to_tickets_table',2),(61,'2020_10_04_204139_create_retraits_table',2),(62,'2020_11_10_001731_create_tag_tables',2),(63,'2021_03_08_130044_soucription_foreign_correction',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobile_money`
--

DROP TABLE IF EXISTS `mobile_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mobile_money` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `operateur` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_code` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_msg` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transref` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `narration` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mobile_money_user_id_foreign` (`user_id`),
  CONSTRAINT `mobile_money_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobile_money`
--

LOCK TABLES `mobile_money` WRITE;
/*!40000 ALTER TABLE `mobile_money` DISABLE KEYS */;
INSERT INTO `mobile_money` VALUES (1,'22997967833','REQUESTPAYMENT','MTN','1','{\"responsecode\":\"01\",\"responsemsg\":\"Pending\",\"transref\":\"1583404690EHWHLINMIA\",\"serviceref\":null,\"comment\":null}','01','Pending','1583404690EHWHLINMIA','SOUSOUDJI','KADNEL','contrat1S1',56,NULL,'2020-03-05 10:38:11','2020-03-05 10:38:11'),(2,'22997967833','REQUESTPAYMENT','MTN','1','{\"responsecode\":\"01\",\"responsemsg\":\"Pending\",\"transref\":\"1583404822EHWHLINMIA\",\"serviceref\":null,\"comment\":null}','01','Pending','1583404822EHWHLINMIA','SOUSOUDJI','KADNEL','contrat1S1',56,NULL,'2020-03-05 10:40:23','2020-03-05 10:40:23'),(3,'22997967833','REQUESTPAYMENT','MTN','1','{\"responsecode\":\"01\",\"responsemsg\":\"Pending\",\"transref\":\"1583405081EHWHLINMIA\",\"serviceref\":null,\"comment\":null}','01','Pending','1583405081EHWHLINMIA','SOUSOUDJI','KADNEL','contrat1S1',56,NULL,'2020-03-05 10:44:42','2020-03-05 10:44:42'),(4,'22997967833','REQUESTPAYMENT','MTN','1','{\"responsecode\":\"00\",\"responsemsg\":\"Successfully processed transaction.\",\"transref\":\"1583598835EHWHLINMIA\",\"serviceref\":\"910678120\",\"comment\":null}','00','Successfully processed transaction.','1583598835EHWHLINMIA','SOUSOUDJI','KADNEL','contrat1S1',56,NULL,'2020-03-07 16:33:56','2020-03-07 16:34:12'),(5,'22999151256','REQUESTPAYMENT','MOOV','1','{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583599949EHWHLINMMV\",\"serviceref\":null,\"comment\":null}','92','','1583599949EHWHLINMMV','ADEBIYI','Jeanne','contrat2S2',60,NULL,'2020-03-07 16:53:01','2020-03-07 16:53:01'),(6,'22999151256','REQUESTPAYMENT','MOOV','1','{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583600005EHWHLINMMV\",\"serviceref\":null,\"comment\":null}','92','','1583600005EHWHLINMMV','ADEBIYI','Jeanne','contrat2S2',60,NULL,'2020-03-07 16:53:27','2020-03-07 16:53:27'),(7,'22999151256','REQUESTPAYMENT','MOOV','1','{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583600028EHWHLINMMV\",\"serviceref\":null,\"comment\":null}','92','','1583600028EHWHLINMMV','ADEBIYI','Jeanne','contrat2S2',60,NULL,'2020-03-07 16:53:49','2020-03-07 16:53:49'),(8,'22999151256','REQUESTPAYMENT','MOOV','1','{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583600041EHWHLINMMV\",\"serviceref\":null,\"comment\":null}','92','','1583600041EHWHLINMMV','ADEBIYI','Jeanne','contrat2S2',60,NULL,'2020-03-07 16:54:02','2020-03-07 16:54:02'),(9,'22996254399','REQUESTPAYMENT','MTN','1','{\"responsecode\":\"00\",\"responsemsg\":\"Successfully processed transaction.\",\"transref\":\"1583600256EHWHLINMIA\",\"serviceref\":\"910713417\",\"comment\":null}','00','Successfully processed transaction.','1583600256EHWHLINMIA','DUJARDIN','Jean','contrat3S3',60,NULL,'2020-03-07 16:57:36','2020-03-07 16:57:52'),(10,'22996254399','REQUESTPAYMENT','MTN','1','{\"responsecode\":\"00\",\"responsemsg\":\"Successfully processed transaction.\",\"transref\":\"1583600446EHWHLINMIA\",\"serviceref\":\"910718234\",\"comment\":null}','00','Successfully processed transaction.','1583600446EHWHLINMIA','DUJARDIN','Jean','primeC3',60,NULL,'2020-03-07 17:00:46','2020-03-07 17:01:07');
/*!40000 ALTER TABLE `mobile_money` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2),(3,'App\\User',3),(4,'App\\User',4),(5,'App\\User',5),(6,'App\\User',6),(12,'App\\User',7),(13,'App\\User',8),(14,'App\\User',9),(7,'App\\User',10),(8,'App\\User',11),(7,'App\\User',12),(7,'App\\User',13),(7,'App\\User',14),(7,'App\\User',15),(7,'App\\User',16),(7,'App\\User',17),(7,'App\\User',18),(7,'App\\User',19),(7,'App\\User',20),(7,'App\\User',21),(7,'App\\User',22),(7,'App\\User',23),(7,'App\\User',24),(7,'App\\User',25),(7,'App\\User',26),(7,'App\\User',27),(7,'App\\User',28),(7,'App\\User',29),(7,'App\\User',30),(7,'App\\User',31),(7,'App\\User',32),(7,'App\\User',33),(7,'App\\User',34),(7,'App\\User',35),(7,'App\\User',36),(7,'App\\User',37),(7,'App\\User',38),(7,'App\\User',39),(7,'App\\User',40),(7,'App\\User',41),(7,'App\\User',42),(7,'App\\User',43),(7,'App\\User',44),(7,'App\\User',45),(7,'App\\User',46),(7,'App\\User',47),(7,'App\\User',48),(7,'App\\User',49),(7,'App\\User',50),(7,'App\\User',51),(7,'App\\User',52),(7,'App\\User',53),(7,'App\\User',54),(7,'App\\User',55),(8,'App\\User',56),(9,'App\\User',57),(11,'App\\User',57),(10,'App\\User',58),(7,'App\\User',59),(8,'App\\User',60),(9,'App\\User',61),(10,'App\\User',61),(11,'App\\User',62),(11,'App\\User',63),(9,'App\\User',64),(10,'App\\User',64),(11,'App\\User',65);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nsias`
--

DROP TABLE IF EXISTS `nsias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nsias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nsias_user_id_foreign` (`user_id`),
  CONSTRAINT `nsias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nsias`
--

LOCK TABLES `nsias` WRITE;
/*!40000 ALTER TABLE `nsias` DISABLE KEYS */;
INSERT INTO `nsias` VALUES (1,NULL,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,NULL,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,NULL,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07');
/*!40000 ALTER TABLE `nsias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'store assures','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,'index assures','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,'create assures','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(4,'destroy assures','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(5,'update assures','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(6,'show assures','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(7,'edit assures','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(8,'store beneficiaires','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(9,'index beneficiaires','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(10,'create beneficiaires','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(11,'destroy beneficiaires','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(12,'update beneficiaires','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(13,'show beneficiaires','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(14,'edit beneficiaires','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(15,'index clients','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(16,'store clients','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(17,'create clients','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(18,'destroy clients','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(19,'update clients','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(20,'show clients','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(21,'edit clients','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(22,'index dash','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(23,'index directions','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(24,'store directions','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(25,'create directions','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(26,'show directions','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(27,'update directions','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(28,'destroy directions','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(29,'edit directions','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(30,'index supermarchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(31,'store supermarchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(32,'create supermarchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(33,'destroy supermarchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(34,'update supermarchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(35,'show supermarchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(36,'edit supermarchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(37,'store nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(38,'index nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(39,'create nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(40,'destroy nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(41,'update nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(42,'show nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(43,'edit nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(44,'confirm password','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(45,'email password','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(46,'request password','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(47,'update password','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(48,'reset password','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(49,'store marchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(50,'index marchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(51,'create marchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(52,'destroy marchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(53,'update marchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(54,'show marchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(55,'edit marchands','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(56,'status users','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(57,'store utilisateurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(58,'index utilisateurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(59,'create utilisateurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(60,'destroy utilisateurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(61,'update utilisateurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(62,'show utilisateurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(63,'edit utilisateurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(64,'index visiteurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(65,'store visiteurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(66,'create visiteurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(67,'show visiteurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(68,'update visiteurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(69,'destroy visiteurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(70,'edit visiteurs','web','2020-03-05 04:04:07','2020-03-05 04:04:07');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `primes`
--

DROP TABLE IF EXISTS `primes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `primes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `souscription_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `montant` int NOT NULL,
  `c_marchand` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_first_marchand` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `c_smarchand` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_first_smarchand` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `c_nsia` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_mms` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_prime` date NOT NULL DEFAULT '2020-03-05',
  `statut_commission` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `primes_souscription_id_foreign` (`souscription_id`),
  KEY `primes_user_id_foreign` (`user_id`),
  CONSTRAINT `primes_souscription_id_foreign` FOREIGN KEY (`souscription_id`) REFERENCES `souscriptions` (`id`),
  CONSTRAINT `primes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `primes`
--

LOCK TABLES `primes` WRITE;
/*!40000 ALTER TABLE `primes` DISABLE KEYS */;
INSERT INTO `primes` VALUES (1,3,60,1000,'2000','0','1000','0','6750','250','2020-03-05',NULL,NULL,'2020-03-07 17:01:07','2020-03-07 17:01:07'),(2,3,60,1000,'1800','0','650','0','6750','800','2020-03-05',NULL,NULL,'2020-03-07 17:01:07','2020-03-07 17:01:07'),(3,3,60,1000,'1800','0','650','0','6750','800','2020-03-05',NULL,NULL,'2020-03-07 17:01:08','2020-03-07 17:01:08');
/*!40000 ALTER TABLE `primes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospects`
--

DROP TABLE IF EXISTS `prospects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prospects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `commune_id` bigint unsigned NOT NULL,
  `marchand_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prospects_commune_id_foreign` (`commune_id`),
  KEY `prospects_marchand_id_foreign` (`marchand_id`),
  CONSTRAINT `prospects_commune_id_foreign` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`),
  CONSTRAINT `prospects_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospects`
--

LOCK TABLES `prospects` WRITE;
/*!40000 ALTER TABLE `prospects` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retraits`
--

DROP TABLE IF EXISTS `retraits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `retraits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `montant` int NOT NULL,
  `motif` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_user_id` bigint unsigned NOT NULL,
  `handled_by_user_id` bigint unsigned DEFAULT NULL,
  `handle_at` datetime DEFAULT NULL,
  `status` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `retraits_created_by_user_id_foreign` (`created_by_user_id`),
  KEY `retraits_handled_by_user_id_foreign` (`handled_by_user_id`),
  CONSTRAINT `retraits_created_by_user_id_foreign` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `retraits_handled_by_user_id_foreign` FOREIGN KEY (`handled_by_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retraits`
--

LOCK TABLES `retraits` WRITE;
/*!40000 ALTER TABLE `retraits` DISABLE KEYS */;
/*!40000 ALTER TABLE `retraits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,18),(2,18),(3,18),(4,18),(5,18),(6,18),(7,18),(8,18),(9,18),(10,18),(11,18),(12,18),(13,18),(14,18),(15,18),(16,18),(17,18),(18,18),(19,18),(20,18),(21,18),(22,18),(23,18),(24,18),(25,18),(26,18),(27,18),(28,18),(29,18),(30,18),(31,18),(32,18),(33,18),(34,18),(35,18),(36,18),(37,18),(38,18),(39,18),(40,18),(41,18),(42,18),(43,18),(44,18),(45,18),(46,18),(47,18),(48,18),(49,18),(50,18),(51,18),(52,18),(53,18),(54,18),(55,18),(56,18),(57,18),(58,18),(59,18),(60,18),(61,18),(62,18),(63,18),(64,18),(65,18),(66,18),(67,18),(68,18),(69,18),(70,18);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Direction','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,'Direction_ARH','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,'Direction_C','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(4,'Direction_FC','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(5,'Direction_MAC','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(6,'ITMMS','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(7,'SuperMarchand','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(8,'Marchand','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(9,'Client','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(10,'Assuré','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(11,'Bénéficiaire','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(12,'Nsia','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(13,'Nsia1','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(14,'Nsia2','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(15,'ITNSIA','web','2020-03-05 04:04:07','2020-03-05 04:04:07'),(18,'super-admin','web','2020-03-05 04:04:07','2020-03-05 04:04:07');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sinistres`
--

DROP TABLE IF EXISTS `sinistres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sinistres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_sinistre` date NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `contrat_id` bigint unsigned NOT NULL,
  `statut` enum('Non traité','En cours','Terminé') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non traité',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sinistres_client_id_foreign` (`client_id`),
  KEY `sinistres_contrat_id_foreign` (`contrat_id`),
  CONSTRAINT `sinistres_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `sinistres_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sinistres`
--

LOCK TABLES `sinistres` WRITE;
/*!40000 ALTER TABLE `sinistres` DISABLE KEYS */;
/*!40000 ALTER TABLE `sinistres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from` bigint unsigned NOT NULL,
  `to` bigint unsigned NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '1',
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sms_from_foreign` (`from`),
  KEY `sms_to_foreign` (`to`),
  CONSTRAINT `sms_from_foreign` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  CONSTRAINT `sms_to_foreign` FOREIGN KEY (`to`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms`
--

LOCK TABLES `sms` WRITE;
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;
INSERT INTO `sms` VALUES (1,12,56,'Votre compte Marchand est cree. Login : votre numero, mot de passe : 1234',1,'',NULL,'2020-03-05 07:33:21','2020-03-05 07:33:21'),(2,56,57,'Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:2A2N1756. Login : votre numero, mot de passe : 1234. Ne perdez pas votre couverture, payer votre prime a temps. GMMS et NSIA vous remercient.',1,'',NULL,'2020-03-05 10:37:31','2020-03-05 10:37:31'),(3,1,59,'Votre compte SuperMarchand est cree. Login : votre numero, mot de passe : 1234',1,'',NULL,'2020-03-07 16:09:42','2020-03-07 16:09:42'),(4,59,60,'Votre compte Marchand est cree. Login : votre numero, mot de passe : 1234',1,'',NULL,'2020-03-07 16:15:31','2020-03-07 16:15:31'),(5,60,61,'Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:46L3N1255. Login : votre numero, mot de passe : 1234. Ne perdez pas votre couverture, payer votre prime a temps. GMMS et NSIA vous remercient.',1,'',NULL,'2020-03-07 16:45:11','2020-03-07 16:45:11'),(6,60,64,'Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:46L3N2684. Login : votre numero, mot de passe : 1234. Ne perdez pas votre couverture, payer votre prime a temps. GMMS et NSIA vous remercient.',1,'',NULL,'2020-03-07 16:56:11','2020-03-07 16:56:11'),(7,60,64,'DUJARDIN Jean, votre payement de 3000F est recu pour le contrat 46L3N2684. Reste a payer 9000. GMMS et NSIA vous remercient.',1,'',NULL,'2020-03-07 17:01:11','2020-03-07 17:01:11');
/*!40000 ALTER TABLE `sms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soldes`
--

DROP TABLE IF EXISTS `soldes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `soldes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soldes`
--

LOCK TABLES `soldes` WRITE;
/*!40000 ALTER TABLE `soldes` DISABLE KEYS */;
/*!40000 ALTER TABLE `soldes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souscription_statut_souscription`
--

DROP TABLE IF EXISTS `souscription_statut_souscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `souscription_statut_souscription` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `souscription_id` bigint unsigned NOT NULL,
  `statut_souscription_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `motif` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `souscription_statut_souscription_souscription_id_foreign` (`souscription_id`),
  KEY `souscription_statut_souscription_statut_souscription_id_foreign` (`statut_souscription_id`),
  KEY `souscription_statut_souscription_user_id_foreign` (`user_id`),
  CONSTRAINT `souscription_statut_souscription_souscription_id_foreign` FOREIGN KEY (`souscription_id`) REFERENCES `souscriptions` (`id`),
  CONSTRAINT `souscription_statut_souscription_statut_souscription_id_foreign` FOREIGN KEY (`statut_souscription_id`) REFERENCES `statut_souscriptions` (`id`),
  CONSTRAINT `souscription_statut_souscription_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souscription_statut_souscription`
--

LOCK TABLES `souscription_statut_souscription` WRITE;
/*!40000 ALTER TABLE `souscription_statut_souscription` DISABLE KEYS */;
INSERT INTO `souscription_statut_souscription` VALUES (1,1,1,56,'Nouvelle souscription',NULL,'2020-03-05 10:37:28','2020-03-05 10:37:28'),(2,1,2,56,'Paiement éffectué',NULL,'2020-03-07 16:34:12','2020-03-07 16:34:12'),(3,1,3,56,'Validation automatique',NULL,'2020-03-07 16:34:12','2020-03-07 16:34:12'),(4,2,1,60,'Nouvelle souscription',NULL,'2020-03-07 16:45:08','2020-03-07 16:45:08'),(5,3,1,60,'Nouvelle souscription',NULL,'2020-03-07 16:56:10','2020-03-07 16:56:10'),(6,3,2,60,'Paiement éffectué',NULL,'2020-03-07 16:57:52','2020-03-07 16:57:52'),(7,3,3,60,'Validation automatique',NULL,'2020-03-07 16:57:52','2020-03-07 16:57:52');
/*!40000 ALTER TABLE `souscription_statut_souscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souscriptions`
--

DROP TABLE IF EXISTS `souscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `souscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contrat_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `statut` enum('Attente de paiement','Attente de traitement','Valide','Rejeté','Sinistre','Terminé') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Attente de paiement',
  `date_effet` date NOT NULL DEFAULT '2020-03-05',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `souscriptions_contrat_id_foreign` (`contrat_id`),
  KEY `souscriptions_user_id_foreign` (`user_id`),
  CONSTRAINT `souscriptions_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`),
  CONSTRAINT `souscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souscriptions`
--

LOCK TABLES `souscriptions` WRITE;
/*!40000 ALTER TABLE `souscriptions` DISABLE KEYS */;
INSERT INTO `souscriptions` VALUES (1,1,56,'Valide','2020-03-07',NULL,'2020-03-05 10:37:28','2020-03-07 16:34:12'),(2,2,60,'Attente de paiement','2020-03-05',NULL,'2020-03-07 16:45:08','2020-03-07 16:45:08'),(3,3,60,'Valide','2020-03-07',NULL,'2020-03-07 16:56:10','2020-03-07 16:57:52');
/*!40000 ALTER TABLE `souscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statut_souscriptions`
--

DROP TABLE IF EXISTS `statut_souscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statut_souscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statut_souscriptions`
--

LOCK TABLES `statut_souscriptions` WRITE;
/*!40000 ALTER TABLE `statut_souscriptions` DISABLE KEYS */;
INSERT INTO `statut_souscriptions` VALUES (1,'Attente de paiement',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,'Attente de traitement',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,'Valide',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(4,'Rejeté',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(5,'Sinistre',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(6,'Terminé',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07');
/*!40000 ALTER TABLE `statut_souscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `super_marchands`
--

DROP TABLE IF EXISTS `super_marchands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `super_marchands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registre` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personne` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direction_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `super_marchands_direction_id_foreign` (`direction_id`),
  CONSTRAINT `super_marchands_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `directions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `super_marchands`
--

LOCK TABLES `super_marchands` WRITE;
/*!40000 ALTER TABLE `super_marchands` DISABLE KEYS */;
INSERT INTO `super_marchands` VALUES (1,'','test','test','morale',1,NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(2,'2A','NET-DIRECT','RCCM','morale',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(3,'3L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(4,'4L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(5,'5A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(6,'6A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(7,'7A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(8,'8A','AJTG RACI','RB/ABC/19A13831','morale',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(9,'9L','CANADIME SARL','RCCM RB / LOT/ 10B6268','morale',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(10,'10A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(11,'11Z',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(12,'12Z',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(13,'13L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(14,'14L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(15,'15A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(16,'16B',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(17,'17C',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(18,'18A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(19,'19A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(20,'20M','New Horizon Corporate (NHC)','RB/COT/11A11740','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(21,'21M',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(22,'22L','VIE - NOUVELLE - GS','RB/COT/19A51327','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(23,'23Z','DADJA MAHOULE SARL','RB/COT/18B20891','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(24,'24L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(25,'25A','DOVON & FILS','RB/ABC/19A13906','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(26,'26A','EAGLE GROUP INTERNATIONAL SARL','RB/ABC/15B578','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(27,'27A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(28,'28L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(29,'29A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(30,'30L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(31,'31U','TOTAL SERVICES PLUS','RB/LKS/19A1101','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(32,'32L','SOJELIE SARL','RCCMRBCOT/16B16002','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(33,'33A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(34,'34A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(35,'35L','Houansou','RB/COT/14A19701','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(36,'36Z','Ets Royal Irokosa','RB/ABY/19A5812','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(37,'37L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(38,'38A',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(39,'39L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(40,'40B','Afrique Consulting Services (ACS)','RB/PKO/18A5434','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(41,'41L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(42,'42C',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(43,'43L','D@FR & FILS','RB/COT','morale',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(44,'44L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(45,'45L',NULL,NULL,'physique',1,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(46,'46L',NULL,NULL,'physique',1,NULL,'2020-03-07 16:09:37','2020-03-07 16:09:37');
/*!40000 ALTER TABLE `super_marchands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggables`
--

DROP TABLE IF EXISTS `taggables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `taggables` (
  `tag_id` int unsigned NOT NULL,
  `taggable_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint unsigned NOT NULL,
  UNIQUE KEY `taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`),
  CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggables`
--

LOCK TABLES `taggables` WRITE;
/*!40000 ALTER TABLE `taggables` DISABLE KEYS */;
/*!40000 ALTER TABLE `taggables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `slug` json NOT NULL,
  `type` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tempp`
--

DROP TABLE IF EXISTS `tempp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tempp` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `other1` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tempp`
--

LOCK TABLES `tempp` WRITE;
/*!40000 ALTER TABLE `tempp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tempp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_categories`
--

DROP TABLE IF EXISTS `ticket_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_categories`
--

LOCK TABLES `ticket_categories` WRITE;
/*!40000 ALTER TABLE `ticket_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_comments`
--

DROP TABLE IF EXISTS `ticket_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_comments_ticket_id_foreign` (`ticket_id`),
  KEY `ticket_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `ticket_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  CONSTRAINT `ticket_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_comments`
--

LOCK TABLES `ticket_comments` WRITE;
/*!40000 ALTER TABLE `ticket_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_priorities`
--

DROP TABLE IF EXISTS `ticket_priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_priorities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_priorities`
--

LOCK TABLES `ticket_priorities` WRITE;
/*!40000 ALTER TABLE `ticket_priorities` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_priorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_statuses`
--

DROP TABLE IF EXISTS `ticket_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_statuses`
--

LOCK TABLES `ticket_statuses` WRITE;
/*!40000 ALTER TABLE `ticket_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `contrat_id` bigint unsigned DEFAULT NULL,
  `related_user_id` bigint unsigned DEFAULT NULL,
  `created_by_user_id` bigint unsigned DEFAULT NULL,
  `assigned_to_user_id` bigint unsigned DEFAULT NULL,
  `status_id` bigint unsigned NOT NULL,
  `priority_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `transref` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corrected_by_user_id` bigint unsigned DEFAULT NULL,
  `corrige_le` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_contrat_id_foreign` (`contrat_id`),
  KEY `tickets_related_user_id_foreign` (`related_user_id`),
  KEY `tickets_created_by_user_id_foreign` (`created_by_user_id`),
  KEY `tickets_assigned_to_user_id_foreign` (`assigned_to_user_id`),
  KEY `tickets_status_id_foreign` (`status_id`),
  KEY `tickets_priority_id_foreign` (`priority_id`),
  KEY `tickets_category_id_foreign` (`category_id`),
  KEY `tickets_corrected_by_user_id_foreign` (`corrected_by_user_id`),
  CONSTRAINT `tickets_assigned_to_user_id_foreign` FOREIGN KEY (`assigned_to_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `tickets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `ticket_categories` (`id`),
  CONSTRAINT `tickets_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`),
  CONSTRAINT `tickets_corrected_by_user_id_foreign` FOREIGN KEY (`corrected_by_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `tickets_created_by_user_id_foreign` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `tickets_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `ticket_priorities` (`id`),
  CONSTRAINT `tickets_related_user_id_foreign` FOREIGN KEY (`related_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `tickets_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `ticket_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `payable_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint unsigned NOT NULL,
  `wallet_id` int unsigned DEFAULT NULL,
  `type` enum('deposit','withdraw') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` json DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  KEY `transactions_type_index` (`type`),
  KEY `transactions_wallet_id_foreign` (`wallet_id`),
  CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'App\\User',1,1,'deposit',10000,1,NULL,'f6b2a43f-81c0-44a1-9a53-744ae281304b','2020-03-07 16:34:12','2020-03-07 16:34:12'),(2,'App\\User',1,1,'deposit',10000,1,NULL,'77deae63-d004-463c-966b-b8f8e2ec17d0','2020-03-07 16:57:52','2020-03-07 16:57:52'),(3,'App\\User',60,174,'deposit',2000,1,NULL,'c4145143-73a5-4542-b8f3-ca6411b41ae2','2020-03-07 17:01:07','2020-03-07 17:01:07'),(4,'App\\User',59,171,'deposit',1000,1,NULL,'29ca6706-1c67-42ad-af20-4fecc971f8f9','2020-03-07 17:01:07','2020-03-07 17:01:07'),(5,'App\\User',1,3,'deposit',250,1,NULL,'1a6a69f5-74ae-48d1-887a-ef32faac5b6e','2020-03-07 17:01:07','2020-03-07 17:01:07'),(6,'App\\User',7,21,'deposit',6750,1,NULL,'33361ea0-b8d3-48d6-82a9-e28345443dd4','2020-03-07 17:01:07','2020-03-07 17:01:07'),(7,'App\\User',60,174,'deposit',1800,1,NULL,'8588cf96-f51b-4ebe-9789-b0c08f5b8172','2020-03-07 17:01:07','2020-03-07 17:01:07'),(8,'App\\User',59,171,'deposit',650,1,NULL,'d55c6ff3-0838-47bb-b271-4c6fdd2732fd','2020-03-07 17:01:07','2020-03-07 17:01:07'),(9,'App\\User',1,3,'deposit',800,1,NULL,'14d64d11-4c95-4779-8167-16e69e90afc2','2020-03-07 17:01:07','2020-03-07 17:01:07'),(10,'App\\User',7,21,'deposit',6750,1,NULL,'7dc25081-50e6-497a-9388-665b2c945c89','2020-03-07 17:01:07','2020-03-07 17:01:07'),(11,'App\\User',60,174,'deposit',1800,1,NULL,'c6c6afe0-65c7-4c3a-96c4-addb25112166','2020-03-07 17:01:07','2020-03-07 17:01:07'),(12,'App\\User',59,171,'deposit',650,1,NULL,'e56a235a-280b-49ea-bb43-4eb7c8f69f39','2020-03-07 17:01:07','2020-03-07 17:01:07'),(13,'App\\User',1,3,'deposit',800,1,NULL,'b8f3f255-ff94-414c-9061-c56a624cc759','2020-03-07 17:01:08','2020-03-07 17:01:08'),(14,'App\\User',7,21,'deposit',6750,1,NULL,'2e822f69-c32b-4c70-8a67-9f9c2f6e494a','2020-03-07 17:01:08','2020-03-07 17:01:08');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transfers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint unsigned NOT NULL,
  `to_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint unsigned NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` int unsigned NOT NULL,
  `withdraw_id` int unsigned NOT NULL,
  `discount` bigint NOT NULL DEFAULT '0',
  `fee` bigint NOT NULL DEFAULT '0',
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  KEY `transfers_deposit_id_foreign` (`deposit_id`),
  KEY `transfers_withdraw_id_foreign` (`withdraw_id`),
  CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userables`
--

DROP TABLE IF EXISTS `userables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userables` (
  `user_id` bigint unsigned NOT NULL,
  `userable_id` bigint unsigned NOT NULL,
  `userable_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userables`
--

LOCK TABLES `userables` WRITE;
/*!40000 ALTER TABLE `userables` DISABLE KEYS */;
INSERT INTO `userables` VALUES (1,1,'App\\Models\\Direction',NULL,NULL,NULL),(2,2,'App\\Models\\Direction',NULL,NULL,NULL),(3,3,'App\\Models\\Direction',NULL,NULL,NULL),(4,4,'App\\Models\\Direction',NULL,NULL,NULL),(5,5,'App\\Models\\Direction',NULL,NULL,NULL),(6,6,'App\\Models\\Direction',NULL,NULL,NULL),(7,1,'App\\Models\\Nsia',NULL,NULL,NULL),(8,2,'App\\Models\\Nsia',NULL,NULL,NULL),(9,3,'App\\Models\\Nsia',NULL,NULL,NULL),(10,1,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(11,1,'App\\Models\\Marchand',NULL,NULL,NULL),(12,2,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(13,3,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(14,4,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(15,5,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(16,6,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(17,7,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(18,8,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(19,9,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(20,10,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(21,11,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(22,12,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(23,13,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(24,14,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(25,15,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(26,16,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(27,17,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(28,18,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(29,19,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(30,20,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(31,21,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(32,22,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(33,23,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(34,24,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(35,25,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(36,26,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(37,27,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(38,28,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(39,29,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(40,30,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(41,31,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(42,32,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(43,33,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(44,34,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(45,35,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(46,36,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(47,37,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(48,38,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(49,39,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(50,40,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(51,41,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(52,42,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(53,43,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(54,44,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(55,45,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(56,2,'App\\Models\\Marchand',NULL,NULL,NULL),(57,1,'App\\Models\\Client',NULL,NULL,NULL),(58,1,'App\\Models\\Assure',NULL,NULL,NULL),(57,1,'App\\Models\\Beneficiaire',NULL,NULL,NULL),(59,46,'App\\Models\\SuperMarchand',NULL,NULL,NULL),(60,3,'App\\Models\\Marchand',NULL,NULL,NULL),(61,2,'App\\Models\\Client',NULL,NULL,NULL),(61,2,'App\\Models\\Assure',NULL,NULL,NULL),(62,2,'App\\Models\\Beneficiaire',NULL,NULL,NULL),(63,3,'App\\Models\\Beneficiaire',NULL,NULL,NULL),(64,3,'App\\Models\\Client',NULL,NULL,NULL),(64,3,'App\\Models\\Assure',NULL,NULL,NULL),(65,4,'App\\Models\\Beneficiaire',NULL,NULL,NULL);
/*!40000 ALTER TABLE `userables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifu` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `situation_matrimoniale` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_sessid` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeur` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_seen_at` timestamp NULL DEFAULT NULL,
  `banned_until` datetime DEFAULT NULL,
  `password` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commune_id` bigint unsigned NOT NULL,
  `recevoir_commission` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_telephone_unique` (`telephone`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_commune_id_foreign` (`commune_id`),
  CONSTRAINT `users_commune_id_foreign` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mr. Keon Cole','Alize Larkin','Dr. Lucio D\'Amore Sr.','97000000','esperanza43@example.org','Masculin',NULL,'2020-03-05','Samanta Collier',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07','2023-10-29 12:58:02',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','g9BCb3F3h5zz0Rfauk1D8Gm37qND6CEzfM99ESTNf0LqAiBrCIYrqE3SiJI5',NULL,'2020-03-05 04:04:07','2023-10-29 12:58:02',2,0),(2,'Clotilde Ruecker','Aron Dicki','Sylvia Boyle','97000001','dayana.metz@example.net','Masculin',NULL,'2020-03-05','Curtis Wintheiser',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07',NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','AHKhy8mZ7w',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07',2,0),(3,'Jamie Schoen','Isidro Zieme V','Aimee Little','97000002','stokes.lola@example.net','Masculin',NULL,'2020-03-05','Celine Mueller',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07',NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','VDa7u5yWjN',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07',2,0),(4,'Tomas Paucek IV','Wilford Donnelly','Brenden Cummings','97000003','terrill18@example.org','Masculin',NULL,'2020-03-05','Bertha Gottlieb',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07',NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','pA8KuI58HB',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07',2,0),(5,'Marlin McKenzie Jr.','Sheila Stanton','Arnulfo Will','97000004','sanford.emelie@example.net','Masculin',NULL,'2020-03-05','Caesar Koss I',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07','2020-03-07 16:49:04',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','tbYjBOEwgKgTY8BfTbwYGa1b2fxcLMgJJeBdxyfvLebApKQTXf41wn6RIbya',NULL,'2020-03-05 04:04:07','2020-03-07 16:49:04',2,0),(6,'Prof. Ford Trantow','Mathias Sipes','Prof. Michelle Kirlin','97000005','mwalter@example.net','Masculin',NULL,'2020-03-05','Mr. Arturo Leannon',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07','2023-10-29 13:12:41',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','1pgcM1KkAHw0tWUBU9st22PPbGsJSPJ37BfDvKRKKIUun8OVeNy7fBqaqRU9',NULL,'2020-03-05 04:04:07','2023-10-29 13:12:41',2,0),(7,'Prof. Milan Spencer V','Prof. Alanis Kemmer III','Mr. Hal Bayer V','97000006','samara.ritchie@example.net','Masculin',NULL,'2020-03-05','Gregory Gorczany DDS',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07','2023-10-29 12:58:31',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','EUJBrVHHUPGecdX9SntHbyRhoWdoxQs2N5jRCzd6zI8il9DcNUGp3NgWWxN8',NULL,'2020-03-05 04:04:07','2023-10-29 12:58:31',2,0),(8,'Thurman Stark','Dante Rempel','Casper Breitenberg','97000007','bradley.schimmel@example.org','Masculin',NULL,'2020-03-05','Bertha Tillman Jr.',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07',NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','JiBubcyCn3',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07',2,0),(9,'Gustave Medhurst','Remington Nienow','Gail Keeling','97000008','maybelle25@example.net','Masculin',NULL,'2020-03-05','Mark Hodkiewicz',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07','2023-10-29 12:25:56',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','e7HOeIoqZugII63MWxwwFRfTr4zT8adDju2Q3DL17WRzAr2NipSbYWEpMrud',NULL,'2020-03-05 04:04:07','2023-10-29 12:25:56',2,0),(10,'Dora Gibson','Lenore Cormier Jr.','Josiah Anderson','97000009','jaunita82@example.org','Masculin',NULL,'2020-03-05','Dr. Vicente Abshire',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07',NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','HKkUfTamaQ',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07',2,0),(11,'Terrence Bartoletti','Enrico Balistreri','Arnoldo Kirlin','970000010','neal.mitchell@example.com','Masculin',NULL,'2020-03-05','Arvilla Raynor DDS',NULL,NULL,NULL,NULL,0,'2020-03-05 04:04:07',NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','5iEBW92M8U',NULL,'2020-03-05 04:04:07','2020-03-05 04:04:07',2,0),(12,'ASSAN','Branly','CALAVI ZOGBADJE','95071520',NULL,NULL,NULL,NULL,NULL,NULL,'Informaticien','NET-DIRECT',NULL,0,NULL,'2023-10-29 12:55:26',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2023-10-29 12:55:26',16,0),(13,'ADJANOHOUN','Jonas','Sainte Rita, Cotonou','96039167','adjanohounlandry@gmail.com','Masculin',NULL,'1982-06-10','Marié(e)',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',48,0),(14,'MOREIRA PINTO','Ida','Carré 2214 KOUHOUNOU','95400001','idapintomoreira1@gmail.com','Feminin',NULL,'1959-02-28','Divorcé(e)',NULL,'RESTAURATRICE','LE LAURIER',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',48,0),(15,'AVIMADJE','C. S. Peggy','Maison Avimadje / Gbenan, Ouidah','66409707','ovimadjestephane25@gmail.com','Masculin','0201810323599','1991-01-08','Celibataire',NULL,'Étudiant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',19,0),(16,'DOSSOU-GBETE','Coffi Ernest','Calavi / Sèmè Maison SB /KOUSSENOUDO','97447130','ernest2002fr@yahoo.fr','Masculin','1201501063908','1975-11-21','Marié(e)',NULL,'INFORMATICIEN',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',16,0),(17,'BLIHOUN','F. Carnegie','Maison Agbandjaï / Houéto','66664667','carnegieblihoun@gmail.com','Masculin',NULL,'1986-10-09','Marié(e)',NULL,'Enseignant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',16,0),(18,'KOGBEDJI','Gbékpododolonmé Racidi','Zogbadjé, Maison Quénum','94196062','gkogbedji@gmail.com',NULL,'0201910806938',NULL,NULL,NULL,'Gérant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',16,0),(19,'DJOKO','Béni','Carré 825 MISSITE','95841879','benidjoko@gmail.com',NULL,'3201001487112',NULL,NULL,NULL,'Commerçant','CANADIME SARL',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',48,0),(20,'ADETONAH','Baldyne','Calvi Tokan','97243347','baldynah@yahoo.fr','Feminin',NULL,'1993-09-16','Celibataire',NULL,'Comptable','Groupe MMS',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',16,0),(21,'YETONDJI','IVONICK','Abomey','95787828',NULL,'Masculin',NULL,'1986-04-10','Marié(e)',NULL,'Comptable','UNIVERSITEL',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',71,0),(22,'HOUNDJANTO','Cyrille','MONGNON','94477597','cyrillehoundjanto8@gmail.com','Masculin',NULL,'1997-04-19','Celibataire',NULL,'INSTITUTEUR',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',69,0),(23,'BACHIROU','Charlotte A. A. Soubédath','C/2076 Monontin, Maison Gninhodanc David','97678525','bachiroucharlotte@gmail.com','Feminin',NULL,'1990-11-04','Celibataire',NULL,'Géographe',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',48,0),(24,'AMELINA','Marguerite','C/702 Gbegamey','96838832','amelinamarguerite@gmail.com','Feminin',NULL,'1970-12-30','Marié(e)',NULL,'Employée de bureau','Caisse CODES',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',48,0),(25,'KPEHOUNTON','ROLAND T.','Godomey Salamey','96199039','ktognidroland@yahoo.fr','Masculin','1200901879003','1972-05-13','Marié(e)',NULL,'CONSULTANT FORMATEUR EN GRH',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',16,0),(26,'AHOYO','Joël Tonankpon Coovi','Bp: 43','97210461','ahoyotonankpon@gmail.com','Masculin',NULL,'1977-06-13','Celibataire',NULL,'Administrateur RH',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',28,0),(27,'MIGNONGNI','Coffi Gilbert','BANTE','94120300',NULL,'Masculin',NULL,'1996-11-08','Celibataire',NULL,'ETUDIANT',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',32,0),(28,'VISSIN','Brice Corneille Edgard','Awaké / Togba','97532508','vissinbricecorneille@gmail.com','Masculin',NULL,'1965-01-27','Marié(e)',NULL,'Enseignant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',16,0),(29,'BOKO','LYDIE','cocotomey - tokpa','96545055','lydiekboko1@gmail.com','Feminin',NULL,'1975-01-01','Marié(e)',NULL,'gestionnaire comptable',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:36','2020-03-05 04:04:36',16,0),(30,'ALLAGBE','William Arnaud','Cité la Victoire / Calavi','97291119','nhcgroup@hotmail.fr',NULL,'320110023819',NULL,NULL,NULL,'Communicateur - Biochimiste','NHC',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',51,0),(31,'ZIATE','ARMEL','DOUTOU KPODJI','97222793','ziatearmel@gmail.com','Masculin','1201501999807','1985-01-01','Marié(e)',NULL,'PROMOTEUR DE CENTRE INFORMATIQUE',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',53,0),(32,'NATHO','Samuel R.','Gbégamey','96700859','nathosamuel1@gmail.com',NULL,NULL,NULL,NULL,NULL,'Informaticien',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(33,'AHOYO AIGBE','REMY JONAS','8e arrondissement Cot - carré 1147 M/AHOYO','66240420','dadjamsarl@gmail.com',NULL,'3201810227513',NULL,NULL,NULL,'Conseil agricole-Ingénieur agro-industrielle-Comerce','DADJRA MAHOULE',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',69,0),(34,'WOUEKPE','Fabrice Fiacre','04BP1433/C Missogbé Maison WOUEKPE','67043206','romeoeric@gmail.com','Masculin',NULL,'1991-04-13','Celibataire',NULL,'Technicien hydraulique',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(35,'DOVON','CHARLES LE BON','abomey-calavi','95361579','charleslebond@gmail.com',NULL,'95361579',NULL,NULL,NULL,'GERANT','DOVON & FILS',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',16,0),(36,'GANGBO','FROBENIUS JOEL','GODOMEY TOGOUDOGBEGNIGAN','62023949','jgangbo@gmail.com',NULL,'3201500313215',NULL,NULL,NULL,'ASSUREUR','EAGLE GROUP INTERNATIONAL SARL',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',16,0),(37,'GBETE','EUGENE YAOVI','Tankpè','96466860','eugenegbete@gmail.com','Masculin','011394A','1991-02-07','Celibataire',NULL,'Formateur en marketing du réseau',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',16,0),(38,'FABIYI','Robert','Akpakpa missessin c/3 m/fabiyi blaise','97821139','fabiyirobert4@gmail.com','Masculin',NULL,'1974-04-30','Marié(e)',NULL,'Journaliste','Jérôme carlos',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(39,'NOUGBODE','MARCEL COOVI','Ouedo m/nougbode','96198966','nougbodemarcel@gmail.com','Masculin',NULL,'1985-01-17','Celibataire',NULL,'Informaticien',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',16,0),(40,'ADETONAH','LUC ABEL','c/1434 m/vedoko','97383120',NULL,'Masculin',NULL,'1974-04-29','Marié(e)',NULL,'Promoteur d\'ONG',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(41,'FANTCHAO','JOSEPH ALBERT','Kpakomey/azoue','94194547','totalservicesp.2019@gmail.com',NULL,'0201810207375',NULL,NULL,NULL,'Entrepreneur',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',38,0),(42,'SOSSAMINOU','JEAN-LUC','Fidjrossè akogbato','66111616','sojeliesarl@gmail.com',NULL,'3201641660013',NULL,NULL,NULL,'Commerçant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(43,'AIVETINDE','PASCAL','Ouedo - abomey calavi','96445251',NULL,'Masculin',NULL,'1976-01-13','Marié(e)',NULL,'Mécanicien auto','Garage Aipas Junior',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',16,0),(44,'BALLO KOUZO','Bertin Marius','Togoudo','62217588',NULL,'Masculin','1201643276303','1992-08-31','Celibataire',NULL,'Étudiant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',16,0),(45,'HOUANSOU','Giovanni Nathan Sèdjro','Godomey','66369115','leminceart@gmail.com',NULL,'1201400865505',NULL,NULL,NULL,'Directeur',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(46,'SIMICLA','Alphonse','Bohicon /Zakpo','95216741',NULL,'Masculin','0201910855463','1987-03-15','Marié(e)',NULL,'Technicien Marketing','NOCIBE',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',71,0),(47,'EHOUZOU','Marie-Béranger','cotonou','65803384','imelleehouzou@gmail.com','Feminin',NULL,'1995-05-26','Celibataire',NULL,'comercial MMS','GMMS',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(48,'SOGBODODJI','Romuald','PAHOU','66261836','romualdlinosogbododji@gmail.com','Masculin',NULL,'1991-05-15','Celibataire',NULL,'INFORMATICIEN',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',19,0),(49,'TOGUI LOGUI','Alberic Romaric','womey','66402146','toguilogui64@gmail.com','Masculin',NULL,'1993-02-09','Celibataire',NULL,'Agent comercial','Groupe MMS',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(50,'ABDOULAYE','Abdel Aziz','Parakou','95965425','africoser@gmail.com',NULL,'1201407293908',NULL,NULL,NULL,'Agronome',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',28,0),(51,'MISSAINHOUN','Judith','Cotonou','96532257','j.missainhoun@gmail.com','Feminin','2201000284508','1979-11-19','Marié(e)',NULL,'Employée institution financière',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(52,'TOFOHOSSOU','Comlan Antoine','Houéyiho II / Maison Tossou C/1357','65584444','antoine87.9tof@gmail.com','Masculin',NULL,'1991-12-29','Celibataire',NULL,'Étudiant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',32,0),(53,'DANSOU','Franck Damien','Godomey Usine d\'engrais','63778311','Fdansou34@gmail.com',NULL,'1201501791302',NULL,NULL,NULL,'Agent d\'assurance',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(54,'AHOUNGBE','Enagnon Aldo Romaric','Dékoungbé','94249831',NULL,'Masculin',NULL,'1982-09-26','Celibataire',NULL,'Commercial',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(55,'LOITCHA','Charles','Cotonou','66025855',NULL,'Masculin',NULL,'1991-11-22','Celibataire',NULL,'Étudiant',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 04:04:37','2020-03-05 04:04:37',48,0),(56,'HOUNKONNOU','LUCRECE','COTONOU','62945095',NULL,'Feminin',NULL,'1999-09-09','Marié(e)',NULL,'ETUDIANT','AZ',NULL,0,NULL,'2023-10-29 12:48:36',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 07:33:15','2023-10-29 12:48:36',16,0),(57,'SOUSOUDJI','KADNEL','Cotonou','97967833',NULL,'Masculin',NULL,'1999-09-09','Marié(e)',NULL,'ELEVE',NULL,NULL,0,NULL,'2023-10-29 13:12:58',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 10:37:28','2023-10-29 13:12:58',16,0),(58,'TOTO','ZZZZ','Cotonou','9796783344',NULL,'Masculin',NULL,'1999-09-09','Marié(e)',NULL,'FZRFREG',NULL,NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-05 10:37:28','2020-03-05 10:37:28',16,0),(59,'DOE','John','Akpakpa','07896545',NULL,'Masculin',NULL,'1978-03-05','Marié(e)',NULL,NULL,NULL,NULL,0,NULL,'2023-10-29 12:57:30',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-07 16:09:37','2023-10-29 12:57:30',48,0),(60,'Afolabi','Jean','Akpakpa / Ciné Concorde','369852','afolabijean@gmail.com','Masculin',NULL,'1991-03-18','Celibataire',NULL,NULL,NULL,NULL,0,NULL,'2023-10-29 12:54:52',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-07 16:15:28','2023-10-29 12:54:52',48,0),(61,'ADEBIYI','Jeanne','Tokpa','99151256',NULL,'Feminin',NULL,'1978-05-23','Marié(e)',NULL,'Employée de banque','BOA',NULL,0,NULL,'2023-10-29 13:13:13',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-07 16:45:08','2023-10-29 13:13:13',48,0),(62,'Gbian','Mélanie','Tokpa','78968574',NULL,'Feminin',NULL,'1978-10-05','Marié(e)',NULL,'Commerçante','N/A',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-07 16:51:26','2020-03-07 16:51:26',48,0),(63,'Gbian','Charles','DG','326',NULL,'Masculin',NULL,'2017-03-11','Celibataire',NULL,'NA','NA',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-07 16:51:26','2020-03-07 16:51:26',48,0),(64,'Dujardin','Jean','SD','96254399',NULL,'Masculin',NULL,'1976-03-07','Marié(e)',NULL,'NA','NA',NULL,0,NULL,'2023-10-29 17:21:45',NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-07 16:56:10','2023-10-29 17:21:45',48,0),(65,'Dujardin','Aline','SD','233',NULL,'Feminin',NULL,'2018-04-03','Celibataire',NULL,'DS','DS',NULL,0,NULL,NULL,NULL,'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,NULL,'2020-03-07 16:57:28','2020-03-07 16:57:28',48,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versements`
--

DROP TABLE IF EXISTS `versements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `versements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `montant` int NOT NULL,
  `motif` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `validated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `versements_user_id_foreign` (`user_id`),
  KEY `versements_created_by_foreign` (`created_by`),
  KEY `versements_validated_by_foreign` (`validated_by`),
  CONSTRAINT `versements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `versements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `versements_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versements`
--

LOCK TABLES `versements` WRITE;
/*!40000 ALTER TABLE `versements` DISABLE KEYS */;
/*!40000 ALTER TABLE `versements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `holder_type` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_id` bigint unsigned NOT NULL,
  `name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` bigint NOT NULL DEFAULT '0',
  `decimal_places` smallint NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  KEY `wallets_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,'App\\User',1,'Solde Principal','principal',NULL,20000,2,'2020-03-05 04:04:07','2020-03-07 16:57:52'),(2,'App\\User',1,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(3,'App\\User',1,'Solde Commission','commission',NULL,1850,2,'2020-03-05 04:04:07','2020-03-07 17:01:08'),(4,'App\\User',2,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(5,'App\\User',2,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(6,'App\\User',2,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(7,'App\\User',3,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(8,'App\\User',3,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(9,'App\\User',3,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(10,'App\\User',4,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(11,'App\\User',4,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(12,'App\\User',4,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(13,'App\\User',5,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(14,'App\\User',5,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(15,'App\\User',5,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(16,'App\\User',6,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(17,'App\\User',6,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(18,'App\\User',6,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(19,'App\\User',7,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(20,'App\\User',7,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(21,'App\\User',7,'Solde Commission','commission',NULL,20250,2,'2020-03-05 04:04:07','2020-03-07 17:01:08'),(22,'App\\User',8,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(23,'App\\User',8,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(24,'App\\User',8,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(25,'App\\User',9,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(26,'App\\User',9,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(27,'App\\User',9,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(28,'App\\User',10,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(29,'App\\User',10,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(30,'App\\User',10,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(31,'App\\User',11,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(32,'App\\User',11,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(33,'App\\User',11,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:07','2020-03-05 04:04:07'),(34,'App\\User',12,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(35,'App\\User',12,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(36,'App\\User',12,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(37,'App\\User',13,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(38,'App\\User',13,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(39,'App\\User',13,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(40,'App\\User',14,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(41,'App\\User',14,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(42,'App\\User',14,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(43,'App\\User',15,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(44,'App\\User',15,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(45,'App\\User',15,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(46,'App\\User',16,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(47,'App\\User',16,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(48,'App\\User',16,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(49,'App\\User',17,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(50,'App\\User',17,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(51,'App\\User',17,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(52,'App\\User',18,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(53,'App\\User',18,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(54,'App\\User',18,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(55,'App\\User',19,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(56,'App\\User',19,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(57,'App\\User',19,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(58,'App\\User',20,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(59,'App\\User',20,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(60,'App\\User',20,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(61,'App\\User',21,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(62,'App\\User',21,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(63,'App\\User',21,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(64,'App\\User',22,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(65,'App\\User',22,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(66,'App\\User',22,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(67,'App\\User',23,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(68,'App\\User',23,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(69,'App\\User',23,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(70,'App\\User',24,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(71,'App\\User',24,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(72,'App\\User',24,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(73,'App\\User',25,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(74,'App\\User',25,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(75,'App\\User',25,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(76,'App\\User',26,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(77,'App\\User',26,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(78,'App\\User',26,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(79,'App\\User',27,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(80,'App\\User',27,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(81,'App\\User',27,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(82,'App\\User',28,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(83,'App\\User',28,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(84,'App\\User',28,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(85,'App\\User',29,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(86,'App\\User',29,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(87,'App\\User',29,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:36','2020-03-05 04:04:36'),(88,'App\\User',30,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(89,'App\\User',30,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(90,'App\\User',30,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(91,'App\\User',31,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(92,'App\\User',31,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(93,'App\\User',31,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(94,'App\\User',32,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(95,'App\\User',32,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(96,'App\\User',32,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(97,'App\\User',33,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(98,'App\\User',33,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(99,'App\\User',33,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(100,'App\\User',34,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(101,'App\\User',34,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(102,'App\\User',34,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(103,'App\\User',35,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(104,'App\\User',35,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(105,'App\\User',35,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(106,'App\\User',36,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(107,'App\\User',36,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(108,'App\\User',36,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(109,'App\\User',37,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(110,'App\\User',37,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(111,'App\\User',37,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(112,'App\\User',38,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(113,'App\\User',38,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(114,'App\\User',38,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(115,'App\\User',39,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(116,'App\\User',39,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(117,'App\\User',39,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(118,'App\\User',40,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(119,'App\\User',40,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(120,'App\\User',40,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(121,'App\\User',41,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(122,'App\\User',41,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(123,'App\\User',41,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(124,'App\\User',42,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(125,'App\\User',42,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(126,'App\\User',42,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(127,'App\\User',43,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(128,'App\\User',43,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(129,'App\\User',43,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(130,'App\\User',44,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(131,'App\\User',44,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(132,'App\\User',44,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(133,'App\\User',45,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(134,'App\\User',45,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(135,'App\\User',45,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(136,'App\\User',46,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(137,'App\\User',46,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(138,'App\\User',46,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(139,'App\\User',47,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(140,'App\\User',47,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(141,'App\\User',47,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(142,'App\\User',48,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(143,'App\\User',48,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(144,'App\\User',48,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(145,'App\\User',49,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(146,'App\\User',49,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(147,'App\\User',49,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(148,'App\\User',50,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(149,'App\\User',50,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(150,'App\\User',50,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(151,'App\\User',51,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(152,'App\\User',51,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(153,'App\\User',51,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(154,'App\\User',52,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(155,'App\\User',52,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(156,'App\\User',52,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(157,'App\\User',53,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(158,'App\\User',53,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(159,'App\\User',53,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(160,'App\\User',54,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(161,'App\\User',54,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(162,'App\\User',54,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(163,'App\\User',55,'Solde Principal','principal',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(164,'App\\User',55,'Default Wallet','default',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(165,'App\\User',55,'Solde Commission','commission',NULL,0,2,'2020-03-05 04:04:37','2020-03-05 04:04:37'),(166,'App\\User',56,'Solde Principal','principal',NULL,0,2,'2020-03-05 07:33:21','2020-03-05 07:33:21'),(167,'App\\User',56,'Default Wallet','default',NULL,0,2,'2020-03-05 07:33:21','2020-03-05 07:33:21'),(168,'App\\User',56,'Solde Commission','commission',NULL,0,2,'2020-03-05 07:33:21','2020-03-05 07:33:21'),(169,'App\\User',59,'Solde Principal','principal',NULL,0,2,'2020-03-07 16:09:42','2020-03-07 16:09:42'),(170,'App\\User',59,'Default Wallet','default',NULL,0,2,'2020-03-07 16:09:42','2020-03-07 16:09:42'),(171,'App\\User',59,'Solde Commission','commission',NULL,2300,2,'2020-03-07 16:09:42','2020-03-07 17:01:07'),(172,'App\\User',60,'Solde Principal','principal',NULL,0,2,'2020-03-07 16:15:31','2020-03-07 16:15:31'),(173,'App\\User',60,'Default Wallet','default',NULL,0,2,'2020-03-07 16:15:31','2020-03-07 16:15:31'),(174,'App\\User',60,'Solde Commission','commission',NULL,5600,2,'2020-03-07 16:15:31','2020-03-07 17:01:07'),(175,'App\\User',64,'Default Wallet','default',NULL,0,2,'2020-03-07 17:00:04','2020-03-07 17:00:04');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-29 19:15:42
