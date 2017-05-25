CREATE TABLE Aanestys(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
yllapitaja varchar(50) NOT NULL,
status boolean DEFAULT FALSE,
kuvaus varchar(50) NOT NULL,
julkaistu Varchar(50)
);-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Pelaaja(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
aanestanyt boolean DEFAULT FALSE
);

CREATE TABLE Pelaaja_harjoitus(nimi varchar(50) NOT NULL,
salasana varchar(50) NOT NULL);
