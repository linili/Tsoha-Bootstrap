
CREATE TABLE Pelaaja(
id SERIAL PRIMARY KEY,
nimi varchar(30) NOT NULL UNIQUE,
aloitusvuosi INTEGER,
salasana varchar(10) NOT NULL
);

CREATE TABLE Aanestys(
id SERIAL PRIMARY KEY,
nimi varchar(30) NOT NULL UNIQUE,
status boolean DEFAULT TRUE,
yllapitaja INTEGER REFERENCES Pelaaja(id),
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
ehdokas_id INTEGER REFERENCES Ehdokas(id),
aanestys_id INTEGER REFERENCES Aanestys(id)
);
