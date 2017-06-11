<?php

class Ehdokas extends BaseModel{
	public $id, $pelaaja_id, $aanestys_id;
        
	public function __construct($attributes){
	parent::__construct($attributes);
        $this->validators = array('validate_nimi');
	}

	public static function kaikki($aanestys_id){
	$query = DB::connection()->prepare('SELECT * FROM Ehdokas WHERE aanestys_id = :aanestys_id');
	$query->execute();
	$rows = $query->fetchAll();
	$ehdokkaat = array();
	foreach($rows as $row){
	$ehdokkaat[] = new Ehdokas(array(
	'id' => $row['id'],
	'pelaaja_id' => $row['pelaaja_id'],
	'aanestys_id' => $row['aanestys_id']
	));
	}
	return $ehdokkaat;
	}

public static function etsi($id){
    $query = DB::connection()->prepare('SELECT * FROM Ehdokas WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $ehdokas = new Ehdokas(array(
        'id' => $row['id'],
        'pelaaja_id' => $row['pelaaja_id'],
        'aanestys_id' => $row['aanestys_id']
      ));

      return $ehdokas;
    }

    return null;
  }
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Ehdokas (pelaaja_id, aanestys_id) VALUES (:pelaaja_id, :aanestys_id) RETURNING id');
    $query->execute(array('pelaaja_id' => $this->pelaaja_id, 'aanestys_id' => $this->aanestys_id));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
   // Kint::trace();
   // Kint::dump($row);
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
     $this->id = $row['id'];
  }
   public static function destroy(){
    $query = DB::connection()->prepare('DELETE * FROM Ehdokas WHERE id = :id AND aanestys_id = :aanestys_id');
    $query->execute;
  }
}

