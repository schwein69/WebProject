-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2022 at 11:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--
CREATE DATABASE IF NOT EXISTS `social_network` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `social_network`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `idChat` int(11) NOT NULL,
  `anteprimaChat` varchar(100) NOT NULL,
  `attiva` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `commenti`
--

CREATE TABLE `commenti` (
  `idCommento` int(11) NOT NULL,
  `dataCommento` date NOT NULL,
  `testo` varchar(1000) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contenutimultimediali`
--

CREATE TABLE `contenutimultimediali` (
  `idContenuto` int(11) NOT NULL,
  `formato` varchar(6) NOT NULL,
  `nomeImmagine` varchar(200) NOT NULL,
  `idPost` int(11) NOT NULL,
  `descrizione` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messaggi`
--

CREATE TABLE `messaggi` (
  `idMessaggio` int(11) NOT NULL,
  `testoMsg` varchar(2712) NOT NULL,
  `msgTimestamp` datetime NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `idMittente` int(11) NOT NULL,
  `idChat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifiche`
--

CREATE TABLE `notifiche` (
  `idNotifica` int(11) NOT NULL,
  `idUtenteNotificante` int(11) NOT NULL,
  `notifTimestamp` datetime NOT NULL,
  `idPostRiferimento` int(11) DEFAULT NULL,
  `idTipo` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  `letto` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `postpiaciuti`
--

CREATE TABLE `postpiaciuti` (
  `idPostPiaciuto` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `idPost` int(11) NOT NULL,
  `dataPost` date NOT NULL,
  `testo` varchar(2000) DEFAULT NULL,
  `numLike` int(11) NOT NULL DEFAULT 0,
  `numCommenti` int(11) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `postsalvati`
--

CREATE TABLE `postsalvati` (
  `idPostSalvato` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posttags`
--

CREATE TABLE `posttags` (
  `idPostTag` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `relazioniutenti`
--

CREATE TABLE `relazioniutenti` (
  `idRelazioneUtente` int(11) NOT NULL,
  `idFollower` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `idTag` int(11) NOT NULL,
  `nomeTag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipi`
--

CREATE TABLE `tipi` (
  `idTipo` int(11) NOT NULL,
  `nomeTipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `idUtente` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(512) NOT NULL,
  `email` varchar(320) NOT NULL,
  `descrizione` varchar(512),
  `dataDiNascita` date NOT NULL,
  `formatoFotoProfilo` varchar(6) NOT NULL,
  `codiceRecupero` varchar(256),
  `keepCon` varchar(256),
  `tema` enum('d','l') NOT NULL DEFAULT 'l',
  `lang` enum('it','en') NOT NULL DEFAULT 'it'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `partecipazione`
--

CREATE TABLE `partecipazione` (
  `idPartecipazione` int(11) NOT NULL,
  `idChat` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idChat`);

--
-- Indexes for table `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD PRIMARY KEY (`idPartecipazione`),
  ADD UNIQUE KEY `unique` (`idChat`,`idUtente`) USING BTREE,
  ADD KEY `idChat` (`idChat`),
  ADD KEY `idUtente` (`idUtente`) USING BTREE;

--
-- Indexes for table `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`idCommento`),
  ADD KEY `idUtente` (`idUtente`),
  ADD KEY `idPost` (`idPost`);

--
-- Indexes for table `contenutimultimediali`
--
ALTER TABLE `contenutimultimediali`
  ADD PRIMARY KEY (`idContenuto`),
  ADD KEY `idPost` (`idPost`);

--
-- Indexes for table `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`idMessaggio`),
  ADD KEY `idChat` (`idChat`),
  ADD KEY `idMittente` (`idMittente`);

--
-- Indexes for table `notifiche`
--
ALTER TABLE `notifiche`
  ADD PRIMARY KEY (`idNotifica`),
  ADD KEY `idTipo` (`idTipo`),
  ADD KEY `idUtente` (`idUtente`);

--
-- Indexes for table `postpiaciuti`
--
ALTER TABLE `postpiaciuti`
  ADD PRIMARY KEY (`idPostPiaciuto`),
  ADD UNIQUE KEY `unique` (`idUtente`,`idPost`) USING BTREE,
  ADD KEY `idUtente` (`idUtente`),
  ADD KEY `idPost` (`idPost`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `postsalvati`
--
ALTER TABLE `postsalvati`
  ADD PRIMARY KEY (`idPostSalvato`),
  ADD UNIQUE KEY `unique` (`idUtente`,`idPost`) USING BTREE,
  ADD KEY `idPost` (`idPost`),
  ADD KEY `idUtente` (`idUtente`);

--
-- Indexes for table `posttags`
--
ALTER TABLE `posttags`
  ADD PRIMARY KEY (`idPostTag`),
  ADD UNIQUE KEY `unique` (`idPost`,`idTag`) USING BTREE,
  ADD KEY `idTag` (`idTag`),
  ADD KEY `idPost` (`idPost`) USING BTREE;

--
-- Indexes for table `relazioniutenti`
--
ALTER TABLE `relazioniutenti`
  ADD PRIMARY KEY (`idRelazioneUtente`),
  ADD UNIQUE KEY `unique` (`idFollower`,`idFollowed`) USING BTREE,
  ADD KEY `idFollower` (`idFollower`),
  ADD KEY `idFollowed` (`idFollowed`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`idTag`),
  ADD UNIQUE KEY `nomeTag` (`nomeTag`);

--
-- Indexes for table `tipi`
--
ALTER TABLE `tipi`
  ADD PRIMARY KEY (`idTipo`),
  ADD UNIQUE KEY `nomeTipo` (`nomeTipo`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`idUtente`),
  ADD UNIQUE KEY `unique` (`username`,`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `idChat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partecipazione`
--
ALTER TABLE `partecipazione`
  MODIFY `idPartecipazione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commenti`
--
ALTER TABLE `commenti`
  MODIFY `idCommento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contenutimultimediali`
--
ALTER TABLE `contenutimultimediali`
  MODIFY `idContenuto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `idMessaggio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifiche`
--
ALTER TABLE `notifiche`
  MODIFY `idNotifica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postpiaciuti`
--
ALTER TABLE `postpiaciuti`
  MODIFY `idPostPiaciuto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `postsalvati`
--
ALTER TABLE `postsalvati`
  MODIFY `idPostSalvato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posttags`
--
ALTER TABLE `posttags`
  MODIFY `idPostTag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relazioniutenti`
--
ALTER TABLE `relazioniutenti`
  MODIFY `idRelazioneUtente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `idTag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipi`
--
ALTER TABLE `tipi`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD CONSTRAINT `partecipazione_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`),
  ADD CONSTRAINT `partecipazione_ibfk_2` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contenutimultimediali`
--
ALTER TABLE `contenutimultimediali`
  ADD CONSTRAINT `contenutimultimediali_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messaggi`
--
ALTER TABLE `messaggi`
  ADD CONSTRAINT `messaggi_ibfk_1` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messaggi_ibfk_2` FOREIGN KEY (`idMittente`) REFERENCES `utenti` (`idUtente`);

--
-- Constraints for table `notifiche`
--
ALTER TABLE `notifiche`
  ADD CONSTRAINT `notifiche_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifiche_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tipi` (`idTipo`),
  ADD CONSTRAINT `notifiche_ibfk_3` FOREIGN KEY (`idUtenteNotificante`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postpiaciuti`
--
ALTER TABLE `postpiaciuti`
  ADD CONSTRAINT `postpiaciuti_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postpiaciuti_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postsalvati`
--
ALTER TABLE `postsalvati`
  ADD CONSTRAINT `postsalvati_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postsalvati_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posttags`
--
ALTER TABLE `posttags`
  ADD CONSTRAINT `posttags_ibfk_1` FOREIGN KEY (`idTag`) REFERENCES `tags` (`idTag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posttags_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `relazioniutenti`
--
ALTER TABLE `relazioniutenti`
  ADD CONSTRAINT `relazioniutenti_ibfk_1` FOREIGN KEY (`idFollower`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relazioniutenti_ibfk_2` FOREIGN KEY (`idFollowed`) REFERENCES `utenti` (`idUtente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
