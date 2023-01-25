/*---- USER INSERTION ----*/
/*
Passwords are equal to usernames.
If the password is too short (e.g. 4 character) add some '0' to reach minimum length (6);
*/
INSERT INTO utenti(idUtente,username,pwd,email,dataDiNascita,formatoFotoProfilo,tema,lang)
VALUES (1,'ginopino','$2y$10$q6BUrmxI9DlqSgcsYqEO2uJGZae4ZycWpTXWlpmCn8owtzxLI7t6W','ginopino@gmail.com','2001-01-01','jpg','d','it'),
(2,'gigi','$2y$10$9D4CsnqviPIejjIBkwtzQeS07VgWKua1RmbDfIkAtfCxgizqukJAu','gigi@gmail.com','2001-01-01','jpg','l','it'),
(3,'johndoe','$2y$10$jA5bhoXHixauOwTE/.jnMeyqyZfrwwtltA4JdST778bxVofHc0XvS','johndoe@gmail.com','1960-04-06','png','l','en'),
(4,'mikebryan','$2y$10$4BSeN0cJtS9fl5rnt7r7HeXybsaTKZ/jbetZUqeSP.eNOPd/1d06a','mikebryan@gmail.com','1980-03-02','png','l','en'),
(5,'williamadams','$2y$10$7kM1B1lMkUFBYDbjuDRUJeOBwJYYtq3LH5oiPbj8bU6sLU1QGaomO','williamadams@gmail.com','2002-08-10','png','d','en'),
(6,'alessandraarpini','$2y$10$U1ihNDTtrzn/NaAf7v0sMOkiomIi0fsUw0nf0KQWn7cTv3GTBZcU6','alessandraarpini@gmail.com','2000-04-07','png','l','it'),
(7,'britneyjefferson','$2y$10$VDsMWPiEbXiCbLNnDNLGfOM3dJCSoZ1/E3mdbCixTrxXGiea0jJsK','britneyjefferson@gmail.com','1972-11-12','png','l','en'),
(8,'tommasinoguglielmi','$2y$10$nrhWAYp..8VGtjnCUlVwsOyxxYeCWdyiWHub4dAr8OmKIB43zH.9m','tommasinoguglielmi@gmail.com','1989-07-06','png','d','it');

/*---- CHAT INSERTION ----*/
INSERT INTO chat(idChat, anteprimaChat)
VALUES (1,'Ciao'),
 (2,''),
 (3,''),
 (4,''),
 (5,''),
 (6,''),
 (7,'');

/*---- PARTECIPATION INSERTION ----*/
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

/*---- MESSAGGI INSERTION ----*/
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

/*---- TIPI INSERTION ----*/
INSERT INTO tipi(idTipo, nomeTipo)
VALUES (1,'Like'),
(2,'Comment'),
(3,'Follow');

/*---- POST INSERTION ----*/
INSERT INTO posts(idPost, dataPost, testo, idUser, numLike, numCommenti)
VALUES (1,'2022-12-01', 'Questo è il mio gattino.',1,1,1);

/*---- LIKE INSERTION ----*/
INSERT INTO postpiaciuti(idPost, idUtente)
VALUES (1,2);

/*---- COMMENTI INSERTION ----*/
INSERT INTO commenti(dataCommento, testo, idPost, idUtente)
VALUES ('2022-12-01', 'Ciao, ti va di conoscerci?',1,2);

/*---- NOTIFICHE INSERTION ----*/
INSERT INTO notifiche(idUtenteNotificante, idPostRiferimento, idTipo, idUtente, letto, notifTimestamp)
VALUES (2, 1, 1, 1, 1, NOW()),
(2, 1, 2, 1, 1, NOW()),
(3, 1, 1, 1, 1, NOW()),
(4, 1, 1, 1, 1, NOW()),
(5, 1, 1, 1, 0, NOW()),
(6, 1, 1, 1, 0, NOW());
