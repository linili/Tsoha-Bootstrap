INSERT INTO Pelaaja (nimi, aloitusvuosi, salasana) VALUES ('Matti Mainio', '2016', 'qwer');
INSERT INTO Pelaaja (nimi, aloitusvuosi, salasana) VALUES ('Minna Mainio', '2015', 'asdf');
INSERT INTO Aanestys (nimi, status, yllapitaja, kuvaus, julkaistu) VALUES ('Vuoden pelaaja', TRUE, 1, 'vuoden parhain pelaaja', 2016-11-12);
INSERT INTO Aanestys (nimi, status, yllapitaja, kuvaus, julkaistu) VALUES ('Vuoden tyyli', TRUE, 2, 'vuoden tyylikkäin pelitapa', 2015-11-12);
INSERT INTO Ehdokas (pelaaja_id, aanestys_id) VALUES (1,1);
INSERT INTO Aani(aanestaja_id, ehdokas_id, aanestys_id) VALUES(1, 1, 1);

