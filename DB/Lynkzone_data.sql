---- USER INSERTION ----
INSERT INTO utenti(idUtente,username,pwd,email,dataDiNascita,fotoProfilo,tema,lang)
VALUES (1,'ginopino','ginopino','ginopino@gmail.com','2001-01-01','../imgs/uploads/1/kitty2.png','l','it'),
(2,'gigi','gigi','gigi@gmail.com','2001-01-01','../imgs/uploads/childe.png','l','it');

---- CHAT INSERTION ----
INSERT INTO chat(idChat, anteprimaChat)
VALUES (1,'Ciao');

---- PARTECIPATION INSERTION ----
INSERT INTO partecipazione(idChat, idUtente)
VALUES (1,1),
(1,2);
