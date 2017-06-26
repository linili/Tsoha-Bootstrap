<?php

class Ehdokas extends BaseModel {

    public $id, $pelaaja_id, $aanestys_id, $pelaaja_nimi, $pelaaja_aloitusvuosi, $aanet;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_onko_olemassa');
    }

    public static function kaikki($aanestys_id) {
        $query = DB::connection()->prepare('SELECT * FROM Ehdokas WHERE aanestys_id = :aanestys_id');
        $query->execute(array('aanestys_id' => $aanestys_id));
        $rows = $query->fetchAll();
        $ehdokkaat = array();
        foreach ($rows as $row) {
            $ehdokkaat[] = new Ehdokas(array(
                'id' => $row['id'],
                'pelaaja_id' => $row['pelaaja_id'],
                'aanestys_id' => $row['aanestys_id']
            ));
        }
        return $ehdokkaat;
    }

// ei vielä toimi

 /*   public static function kaikki_nimilla($aanestys_id) {
        $query = DB::connection()->prepare('SELECT Ehdokas.id, Ehdokas.pelaaja_id, Ehdokas.aanestys_id, Pelaaja.nimi, Pelaaja.aloitusvuosi  FROM Ehdokas LEFT JOIN Pelaaja ON Ehdokas.pelaaja_id = Pelaaja.id WHERE aanestys_id = :aanestys_id');
        $query->execute(array('aanestys_id' => $aanestys_id));
        $rows = $query->fetchAll();
        $ehdokkaat = array();
        foreach ($rows as $row) {
            $ehdokkaat[] = new Ehdokas(array(
                'id' => $row['id'],
                'pelaaja_id' => $row['pelaaja_id'],
                'aanestys_id' => $row['aanestys_id']
                'pelaaja_nimi' => $row['nimi']
            ));
        }
        
        return $ehdokkaat;
    }
*/

// ei vielä toimi
    
    public static function kaikki_aanilla($aanestys_id) {
        $query = DB::connection()->prepare('SELECT *  FROM Ehdokas WHERE aanestys_id = :aanestys_id');
        $query->execute(array('aanestys_id' => $aanestys_id));
        $rows = $query->fetchAll();
        $ehdokkaat = array();
        foreach ($rows as $row) {
            $ehdokkaat[] = new Ehdokas(array(
                'id' => $row['id'],
                'pelaaja_id' => $row['pelaaja_id'],
                'aanestys_id' => $row['aanestys_id'],
                'aanet' => Aani::ehdokkaan_aanet($row['id'], $row['aanestys_id'])
            ));
        }
        
        return $ehdokkaat;
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Ehdokas WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $ehdokas = new Ehdokas(array(
                'id' => $row['id'],
                'pelaaja_id' => $row['pelaaja_id'],
                'aanestys_id' => $row['aanestys_id']
            ));

            return $ehdokas;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ehdokas (pelaaja_id, aanestys_id) VALUES (:pelaaja_id, :aanestys_id) RETURNING id');
        $query->execute(array('pelaaja_id' => $this->pelaaja_id, 'aanestys_id' => $this->aanestys_id));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Kint::trace();
        // Kint::dump($row);
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

    public function destroy() {

        $query = DB::connection()->prepare('DELETE FROM Aani WHERE ehdokas_id = :id AND aanestys_id = :aanestys_id');
        $query->execute(array('id' => $this->id, 'aanestys_id' => $this->aanestys_id));
        
        $query = DB::connection()->prepare('DELETE FROM Ehdokas WHERE id = :id AND aanestys_id = :aanestys_id');
        $query->execute(array('id' => $this->id, 'aanestys_id' => $this->aanestys_id));
    }
    
     public function validate_onko_olemassa() {
        $errors = array();
        
   /*      $query = DB::connection()->prepare('SELECT * FROM Ehdokas WHERE aanestys_id = :aanestys_id AND pelaaja_id = :pelaaja_id LIMIT 1');
        $query->execute(array('aanestys_id' => $this->aanestys_id, 'pelaaja_id' => $this->pelaaja_id));
        $row = $query->fetch();
        
        if ($row) {
            $errors[] = 'Ehdokas on jo lisätty!';
        }
  */      
        return $errors;
    }
     

}
