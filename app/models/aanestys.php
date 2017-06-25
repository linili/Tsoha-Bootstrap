<?php

class Aanestys extends BaseModel {

    public $id, $nimi, $status, $yllapitaja, $kuvaus, $julkaistu;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_kuvaus');
    }

    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Aanestys');
        $query->execute();
        $rows = $query->fetchAll();
        $aanestykset = array();
        foreach ($rows as $row) {
            $aanestykset[] = new Aanestys(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'status' => $row['status'],
                'yllapitaja' => $row['yllapitaja'],
                'kuvaus' => $row['kuvaus'],
                'julkaistu' => $row['julkaistu']
            ));
        }
        return $aanestykset;
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Aanestys WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $aanestys = new Aanestys(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'status' => $row['status'],
                'yllapitaja' => $row['yllapitaja'],
                'kuvaus' => $row['kuvaus'],
                'julkaistu' => $row['julkaistu']
            ));

            return $aanestys;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Aanestys (nimi, yllapitaja, status, kuvaus, julkaistu) VALUES (:nimi, :yllapitaja, :status, :kuvaus, :julkaistu) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'status' => $this->status, 'yllapitaja' => $this->yllapitaja, 'kuvaus' => $this->kuvaus, 'julkaistu' => $this->julkaistu));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Aani WHERE aanestys_id = :id');
        $query->execute(array('id' => $this->id));

        $query = DB::connection()->prepare('DELETE FROM Ehdokas WHERE aanestys_id = :id');
        $query->execute(array('id' => $this->id));

        $query = DB::connection()->prepare('DELETE FROM Aanestys WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Aanestys SET nimi = :nimi, status = :status, yllapitaja = :yllapitaja, kuvaus = :kuvaus, julkaistu = :julkaistu WHERE (id = :id)');
        $query->execute(array('nimi' => $this->nimi, 'status' => $this->status, 'yllapitaja' => $this->yllapitaja, 'kuvaus' => $this->kuvaus, 'julkaistu' => $this->julkaistu, 'id' => $this->id));
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        if (strlen($this->nimi) > 30) {
            $errors[] = 'Nimen pituuden tulee olla enintään 30 merkkiä!';
        }
        if (Aanestys::etsi($this->id) == null & $this->onko_nimi_jo_kaytossa()) {
            $errors[] = 'Nimi on jo käytössä';

        }
        return $errors;
    }
    
    public function validate_kuvaus() {
        $errors = array();
         if (strlen($this->kuvaus) > 400) {
            $errors[] = 'Kuvaus tulee olla enintään 400 merkkiä!';
        }
        return $errors;
    }

    public function onko_nimi_jo_kaytossa() {
        $query = DB::connection()->prepare('SELECT * FROM Aanestys WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $this->nimi));
        $row = $query->fetch();
        if ($row) {
            $errors[] = 'Nimi on jo käytössä!';
        }
        return $row;
    }

}
