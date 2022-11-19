-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: social_network
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `idChat` int(11) NOT NULL AUTO_INCREMENT,
  `usr1` int(11) NOT NULL,
  `usr2` int(11) NOT NULL,
  `anteprimaChat` varchar(100) NOT NULL,
  PRIMARY KEY (`idChat`),
  UNIQUE KEY `unique` (`usr1`,`usr2`) USING BTREE,
  KEY `usr2` (`usr2`),
  KEY `usr1` (`usr1`) USING BTREE,
  CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`usr1`) REFERENCES `utente` (`idUtente`),
  CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`usr2`) REFERENCES `utente` (`idUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commento`
--

DROP TABLE IF EXISTS `commento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commento` (
  `idCommento` int(11) NOT NULL AUTO_INCREMENT,
  `dataCommento` date NOT NULL,
  `testo` varchar(1000) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  PRIMARY KEY (`idCommento`),
  KEY `idUtente` (`idUtente`),
  KEY `idPost` (`idPost`),
  CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commento`
--

LOCK TABLES `commento` WRITE;
/*!40000 ALTER TABLE `commento` DISABLE KEYS */;
/*!40000 ALTER TABLE `commento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenutomultimediale`
--

DROP TABLE IF EXISTS `contenutomultimediale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenutomultimediale` (
  `idContenuto` int(11) NOT NULL AUTO_INCREMENT,
  `formato` varchar(200) NOT NULL,
  `percorso` varchar(200) NOT NULL,
  `idPost` int(11) NOT NULL,
  `descrizione` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`idContenuto`),
  UNIQUE KEY `percorso` (`percorso`),
  KEY `idPost` (`idPost`),
  CONSTRAINT `contenutomultimediale_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenutomultimediale`
--

LOCK TABLES `contenutomultimediale` WRITE;
/*!40000 ALTER TABLE `contenutomultimediale` DISABLE KEYS */;
/*!40000 ALTER TABLE `contenutomultimediale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaggio`
--

DROP TABLE IF EXISTS `messaggio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaggio` (
  `idMessaggio` int(11) NOT NULL AUTO_INCREMENT,
  `testoMsg` varchar(2000) NOT NULL,
  `oraMsg` time NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `idMittente` int(11) NOT NULL,
  `idChat` int(11) NOT NULL,
  PRIMARY KEY (`idMessaggio`),
  KEY `idChat` (`idChat`),
  CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaggio`
--

LOCK TABLES `messaggio` WRITE;
/*!40000 ALTER TABLE `messaggio` DISABLE KEYS */;
/*!40000 ALTER TABLE `messaggio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifica`
--

DROP TABLE IF EXISTS `notifica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifica` (
  `idNotifica` int(11) NOT NULL AUTO_INCREMENT,
  `idUtenteNotificante` int(11) NOT NULL,
  `idPostRiferimento` int(11) DEFAULT NULL,
  `idTipo` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  PRIMARY KEY (`idNotifica`),
  KEY `idTipo` (`idTipo`),
  KEY `idUtente` (`idUtente`),
  CONSTRAINT `notifica_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`),
  CONSTRAINT `notifica_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `dataPost` date NOT NULL,
  `testo` varchar(2000) DEFAULT NULL,
  `numLike` int(11) NOT NULL,
  `numCommenti` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idPost`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utente` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postpaciuto`
--

DROP TABLE IF EXISTS `postpaciuto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postpaciuto` (
  `idPostPiaciuto` int(11) NOT NULL AUTO_INCREMENT,
  `idUtente` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  PRIMARY KEY (`idPostPiaciuto`),
  UNIQUE KEY `unique` (`idUtente`,`idPost`) USING BTREE,
  KEY `idUtente` (`idUtente`),
  KEY `idPost` (`idPost`),
  CONSTRAINT `postpaciuto_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`),
  CONSTRAINT `postpaciuto_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postpaciuto`
--

LOCK TABLES `postpaciuto` WRITE;
/*!40000 ALTER TABLE `postpaciuto` DISABLE KEYS */;
/*!40000 ALTER TABLE `postpaciuto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postsalvato`
--

DROP TABLE IF EXISTS `postsalvato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postsalvato` (
  `idPostSalvato` int(11) NOT NULL AUTO_INCREMENT,
  `idUtente` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  PRIMARY KEY (`idPostSalvato`),
  UNIQUE KEY `unique` (`idUtente`,`idPost`) USING BTREE,
  KEY `idPost` (`idPost`),
  KEY `idUtente` (`idUtente`),
  CONSTRAINT `postsalvato_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`),
  CONSTRAINT `postsalvato_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postsalvato`
--

LOCK TABLES `postsalvato` WRITE;
/*!40000 ALTER TABLE `postsalvato` DISABLE KEYS */;
/*!40000 ALTER TABLE `postsalvato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posttag`
--

DROP TABLE IF EXISTS `posttag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posttag` (
  `idPostTag` int(11) NOT NULL AUTO_INCREMENT,
  `idPost` int(11) NOT NULL,
  `idTag` int(11) NOT NULL,
  PRIMARY KEY (`idPostTag`),
  UNIQUE KEY `unique` (`idPost`,`idTag`) USING BTREE,
  KEY `idTag` (`idTag`),
  KEY `idPost` (`idPost`) USING BTREE,
  CONSTRAINT `posttag_ibfk_1` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posttag_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posttag`
--

LOCK TABLES `posttag` WRITE;
/*!40000 ALTER TABLE `posttag` DISABLE KEYS */;
/*!40000 ALTER TABLE `posttag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relazioneutente`
--

DROP TABLE IF EXISTS `relazioneutente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relazioneutente` (
  `idRelazioneUtente` int(11) NOT NULL AUTO_INCREMENT,
  `idFollower` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL,
  PRIMARY KEY (`idRelazioneUtente`),
  UNIQUE KEY `unique` (`idFollower`,`idFollowed`) USING BTREE,
  KEY `idFollower` (`idFollower`),
  KEY `idFollowed` (`idFollowed`),
  CONSTRAINT `relazioneutente_ibfk_1` FOREIGN KEY (`idFollower`) REFERENCES `utente` (`idUtente`),
  CONSTRAINT `relazioneutente_ibfk_2` FOREIGN KEY (`idFollowed`) REFERENCES `utente` (`idUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relazioneutente`
--

LOCK TABLES `relazioneutente` WRITE;
/*!40000 ALTER TABLE `relazioneutente` DISABLE KEYS */;
/*!40000 ALTER TABLE `relazioneutente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTag` varchar(100) NOT NULL,
  PRIMARY KEY (`idTag`),
  UNIQUE KEY `nomeTag` (`nomeTag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipo` varchar(100) NOT NULL,
  PRIMARY KEY (`idTipo`),
  UNIQUE KEY `nomeTipo` (`nomeTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dataDiNascita` date NOT NULL,
  `fotoProfilo` varchar(100) NOT NULL,
  PRIMARY KEY (`idUtente`),
  UNIQUE KEY `unique` (`username`,`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-19 17:43:04
