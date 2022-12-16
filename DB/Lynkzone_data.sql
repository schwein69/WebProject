---- USER INSERTION ----
INSERT INTO utenti(idUtente,username,pwd,email,dataDiNascita,fotoProfilo,tema,lang)
VALUES (1,'Gino Pino','ginopino','ginopino@gmail.com','2001-01-01','kitty2.png','d','it'),
(2,'Gigi','gigi','gigi@gmail.com','2001-01-01','childe.jpg','l','it'),
(3,'John Doe','johndoe','johndoe@gmail.com','1960-04-06','childe.jpg','l','en'),
(4,'Mike Bryan','mikebryan','mikebryan@gmail.com','1980-03-02','childe.jpg','l','en'),
(5,'William Adams','williamadams','williamadams@gmail.com','2002-08-10','childe.jpg','d','en'),
(6,'Alessandra Arpini','alessandraarpini','alessandraarpini@gmail.com','2000-04-07','childe.jpg','l','it'),
(7,'Britney Jefferson','britneyjefferson','britneyjefferson@gmail.com','1972-11-12','childe.jpg','l','en'),
(8,'Tommasino Guglielmi','tommasinoguglielmi','tommasinoguglielmi@gmail.com','1989-07-06','childe.jpg','d','it');

---- CHAT INSERTION ----
INSERT INTO chat(idChat, anteprimaChat)
VALUES (1,'Ciao'),
 (2,''),
 (3,''),
 (4,''),
 (5,''),
 (6,''),
 (7,'');

---- PARTECIPATION INSERTION ----
INSERT INTO partecipazione(idChat, idUtente)
VALUES (1,1),
(1,2),
(2,1),
(2,3),
(3,1),
(3,4),
(4,1),
(4,5),
(5,1),
(5,6),
(6,1),
(6,7),
(7,1),
(7,8);

---- MESSAGGI INSERTION ----
INSERT INTO messaggi(testoMsg, msgTimestamp, letto, idMittente, idChat)
VALUES ('piacere di conoscerti, io sono Gino pino', '2022-12-01 10:17:03', '1', 1, 1),
 ('piacere Gino Pino, io sono Gigi', '2022-12-01 10:20:03', '1', 2, 1),
 ('ti piace questo social?', '2022-12-01 10:20:53', '1', 1, 1),
 ('sembra carino, ma può migliorare', '2022-12-01 10:21:07', '1', 2, 1),
 ('ahahhaha', '2022-12-01 10:23:14', '1', 1, 1),
 ('hai ragione', '2022-12-01 10:23:26', '1', 1, 1),
 ('diamogli del tempo, magari migliora', '2022-12-01 10:23:57', '1', 1, 1),
 ('cosa fai nella vita?', '2022-12-01 10:24:18', '1', 1, 1),
 ('sono un tecnico informatico', '2022-12-01 10:24:46', '1', 2, 1),
 ('figo', '2022-12-01 10:25:59', '1', 1, 1),
 ('magari puoi dare una mano a sviluppare il sito ahah', '2022-12-01 10:26:30', '1', 1, 1),
 ('mi piacerebbe', '2022-12-01 10:27:22', '1', 2, 1),
 ('purtroppo ho altri progetti in corso', '2022-12-01 10:27:58', '1', 2, 1),
 ('e non riuscirei a dare una mano', '2022-12-01 10:28:12', '1', 2, 1),
 ('un peccato :/', '2022-12-01 10:29:18', '1', 1, 1),
 ('ciao', '2022-12-12 22:10:15', '1', 1, 1);

---- TIPI INSERTION ----
INSERT INTO tipi(idTipo, nomeTipo)
VALUES (1,'Like'),
(2,'Comment'),
(3,'Follow');

---- POST INSERTION ----
INSERT INTO posts(idPost, dataPost, testo, idUser, numLike, numCommenti)
VALUES (1,'2022-12-01', 'Ciao, sono nuovo su questo social e mi andrebbe di conoscere qualcuno.',1,1,1);

---- COMMENTI INSERTION ----
INSERT INTO commenti(dataCommento, testo, idPost, idUtente)
VALUES ('2022-12-01', 'Ciao, ti va di conoscerci?',1,2);

---- NOTIFICHE INSERTION ----
INSERT INTO notifiche(idUtenteNotificante, idPostRiferimento, idTipo, idUtente, letto)
VALUES (2, 1, 1, 1, 1),
(2, 1, 2, 1, 0);
