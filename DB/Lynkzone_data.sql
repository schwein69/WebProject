---- USER INSERTION ----
INSERT INTO utenti(idUtente,username,pwd,email,dataDiNascita,fotoProfilo,tema,lang)
VALUES (1,'ginopino','ginopino','ginopino@gmail.com','2001-01-01','../imgs/uploads/1/kitty2.png','l','it'),
(2,'gigi','gigi','gigi@gmail.com','2001-01-01','../imgs/uploads/childe.jpg','l','it');

---- CHAT INSERTION ----
INSERT INTO chat(idChat, anteprimaChat)
VALUES (1,'Ciao');

---- PARTECIPATION INSERTION ----
INSERT INTO partecipazione(idChat, idUtente)
VALUES (1,1),
(1,2);

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
