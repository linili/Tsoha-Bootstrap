INSERT INTO Aanestys (nimi, status, yllapitaja, kuvaus, julkaistu) VALUES ('Vuoden pelaaja', 'kesken', 'Lilliputti', 'vuoden parhain pelaaja', '2016-11-12');
INSERT INTO Aanestys (nimi, status, yllapitaja, kuvaus, julkaistu) VALUES ('Vuoden tyyli', 'ei vielä alkanut', 'Lilli', 'vuoden tyylikkäin pelitapa', '2015-11-12');
INSERT INTO Pelaaja (nimi, aloitusvuosi, salasana) VALUES ('Matti Mainio', '2016', 'qwer');
INSERT INTO Pelaaja (nimi, aloitusvuosi, salasana) VALUES ('Minna Mainio', '2015', 'asdf');
INSERT INTO Ehdokas (pelaaja_id, aanestys_id) VALUES (1,1);
INSERT INTO Aani(aanestaja_id, ehdokas_id) VALUES(1, 1);
-- Lisää INSERT INTO lauseet tähän tiedostoon
