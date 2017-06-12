
CREATE TABLE Pelaaja(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
aloitusvuosi varchar(50),
salasana varchar(50) NOT NULL
);

CREATE TABLE Aanestys(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
status boolean DEFAULT TRUE,
yllapitaja INTEGER REFERENCES Pelaaja_id,
kuvaus varchar(400) NOT NULL,
julkaistu DATE
);

CREATE TABLE Ehdokas(
id SERIAL PRIMARY KEY,	
pelaaja_id INTEGER REFERENCES Pelaaja(id),
aanestys_id INTEGER REFERENCES Aanestys(id)
);

CREATE TABLE Aani(
aanestaja_id INTEGER REFERENCES Pelaaja(id),
ehdokas_id INTEGER REFERENCES Ehdokas(id));
aanestys_id INTEGER REFERENCES Aanestys(id);

