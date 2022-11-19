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
  CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`usr1`) REFERENCES `utenti` (`idUtente`),
  CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`usr2`) REFERENCES `utenti` (`idUtente`)
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
-- Table structure for table `commenti`
--

DROP TABLE IF EXISTS `commenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commenti` (
  `idCommento` int(11) NOT NULL AUTO_INCREMENT,
  `dataCommento` date NOT NULL,
  `testo` varchar(1000) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  PRIMARY KEY (`idCommento`),
  KEY `idUtente` (`idUtente`),
  KEY `idPost` (`idPost`),
  CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commenti`
--

LOCK TABLES `commenti` WRITE;
/*!40000 ALTER TABLE `commenti` DISABLE KEYS */;
/*!40000 ALTER TABLE `commenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenutimultimediali`
--

DROP TABLE IF EXISTS `contenutimultimediali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenutimultimediali` (
  `idContenuto` int(11) NOT NULL AUTO_INCREMENT,
  `formato` varchar(6) NOT NULL,
  `percorso` varchar(200) NOT NULL,
  `idPost` int(11) NOT NULL,
  `descrizione` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`idContenuto`),
  UNIQUE KEY `percorso` (`percorso`),
  KEY `idPost` (`idPost`),
  CONSTRAINT `contenutimultimediali_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenutimultimediali`
--

LOCK TABLES `contenutimultimediali` WRITE;
/*!40000 ALTER TABLE `contenutimultimediali` DISABLE KEYS */;
/*!40000 ALTER TABLE `contenutimultimediali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaggi`
--

DROP TABLE IF EXISTS `messaggi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaggi` (
  `idMessaggio` int(11) NOT NULL AUTO_INCREMENT,
  `testoMsg` varchar(2712) NOT NULL,
  `oraMsg` time NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `idMittente` int(11) NOT NULL,
  `idChat` int(11) NOT NULL,
  PRIMARY KEY (`idMessaggio`),
  KEY `idChat` (`idChat`),
  CONSTRAINT `messaggi_ibfk_1` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaggi`
--

LOCK TABLES `messaggi` WRITE;
/*!40000 ALTER TABLE `messaggi` DISABLE KEYS */;
/*!40000 ALTER TABLE `messaggi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifiche`
--

DROP TABLE IF EXISTS `notifiche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifiche` (
  `idNotifica` int(11) NOT NULL AUTO_INCREMENT,
  `idUtenteNotificante` int(11) NOT NULL,
  `idPostRiferimento` int(11) DEFAULT NULL,
  `idTipo` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  PRIMARY KEY (`idNotifica`),
  KEY `idTipo` (`idTipo`),
  KEY `idUtente` (`idUtente`),
  CONSTRAINT `notifiche_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`),
  CONSTRAINT `notifiche_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tipi` (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifiche`
--

LOCK TABLES `notifiche` WRITE;
/*!40000 ALTER TABLE `notifiche` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifiche` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postpaciuti`
--

DROP TABLE IF EXISTS `postpaciuti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postpaciuti` (
  `idPostPiaciuto` int(11) NOT NULL AUTO_INCREMENT,
  `idUtente` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  PRIMARY KEY (`idPostPiaciuto`),
  UNIQUE KEY `unique` (`idUtente`,`idPost`) USING BTREE,
  KEY `idUtente` (`idUtente`),
  KEY `idPost` (`idPost`),
  CONSTRAINT `postpaciuti_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`),
  CONSTRAINT `postpaciuti_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postpaciuti`
--

LOCK TABLES `postpaciuti` WRITE;
/*!40000 ALTER TABLE `postpaciuti` DISABLE KEYS */;
/*!40000 ALTER TABLE `postpaciuti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `dataPost` date NOT NULL,
  `testo` varchar(2000) DEFAULT NULL,
  `numLike` int(11) NOT NULL,
  `numCommenti` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idPost`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postsalvati`
--

DROP TABLE IF EXISTS `postsalvati`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postsalvati` (
  `idPostSalvato` int(11) NOT NULL AUTO_INCREMENT,
  `idUtente` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  PRIMARY KEY (`idPostSalvato`),
  UNIQUE KEY `unique` (`idUtente`,`idPost`) USING BTREE,
  KEY `idPost` (`idPost`),
  KEY `idUtente` (`idUtente`),
  CONSTRAINT `postsalvati_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`),
  CONSTRAINT `postsalvati_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postsalvati`
--

LOCK TABLES `postsalvati` WRITE;
/*!40000 ALTER TABLE `postsalvati` DISABLE KEYS */;
/*!40000 ALTER TABLE `postsalvati` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posttags`
--

DROP TABLE IF EXISTS `posttags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posttags` (
  `idPostTag` int(11) NOT NULL AUTO_INCREMENT,
  `idPost` int(11) NOT NULL,
  `idTag` int(11) NOT NULL,
  PRIMARY KEY (`idPostTag`),
  UNIQUE KEY `unique` (`idPost`,`idTag`) USING BTREE,
  KEY `idTag` (`idTag`),
  KEY `idPost` (`idPost`) USING BTREE,
  CONSTRAINT `posttags_ibfk_1` FOREIGN KEY (`idTag`) REFERENCES `tags` (`idTag`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posttags_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posttags`
--

LOCK TABLES `posttags` WRITE;
/*!40000 ALTER TABLE `posttags` DISABLE KEYS */;
/*!40000 ALTER TABLE `posttags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relazioniutenti`
--

DROP TABLE IF EXISTS `relazioniutenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relazioniutenti` (
  `idRelazioneUtente` int(11) NOT NULL AUTO_INCREMENT,
  `idFollower` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL,
  PRIMARY KEY (`idRelazioneUtente`),
  UNIQUE KEY `unique` (`idFollower`,`idFollowed`) USING BTREE,
  KEY `idFollower` (`idFollower`),
  KEY `idFollowed` (`idFollowed`),
  CONSTRAINT `relazioniutenti_ibfk_1` FOREIGN KEY (`idFollower`) REFERENCES `utenti` (`idUtente`),
  CONSTRAINT `relazioniutenti_ibfk_2` FOREIGN KEY (`idFollowed`) REFERENCES `utenti` (`idUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relazioniutenti`
--

LOCK TABLES `relazioniutenti` WRITE;
/*!40000 ALTER TABLE `relazioniutenti` DISABLE KEYS */;
/*!40000 ALTER TABLE `relazioniutenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTag` varchar(100) NOT NULL,
  PRIMARY KEY (`idTag`),
  UNIQUE KEY `nomeTag` (`nomeTag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipi`
--

DROP TABLE IF EXISTS `tipi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipi` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipo` varchar(30) NOT NULL,
  PRIMARY KEY (`idTipo`),
  UNIQUE KEY `nomeTipo` (`nomeTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipi`
--

LOCK TABLES `tipi` WRITE;
/*!40000 ALTER TABLE `tipi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `idUtente` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(512) NOT NULL,
  `email` varchar(320) NOT NULL,
  `dataDiNascita` date NOT NULL,
  `fotoProfilo` varchar(100) NOT NULL,
  PRIMARY KEY (`idUtente`),
  UNIQUE KEY `unique` (`username`,`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-19 21:59:19
