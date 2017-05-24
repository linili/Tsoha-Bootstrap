CREATE TABLE aanestys(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
yllapitaja varchar(50) NOT NULL,
status boolean DEFAULT FALSE,
kuvaus varchar(50) NOT NULL,
julkaistu DATE
);-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE pelaaja(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
aanestanyt boolean DEFAULT FALSE,
