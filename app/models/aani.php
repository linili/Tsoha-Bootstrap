<?php

class Aani extends BaseModel{
	public $aanestaja_id, $ehdokas_id, $aanestys_id;
        
	public function __construct($attributes){
	parent::__construct($attributes);
        $this->validators = array('validate_aani');
	}

	public static function ehdokkaan_aanet($ehdokas_id, $aanestys_id){
	$query = DB::connection()->prepare('SELECT * FROM Aani WHERE ehdokas_id = :ehdokas_id AND aanestys_id = :aanestys_id');
	$query->execute(array('ehdokas_id' => $ehdokas_id, 'aanestys_id' => $aanestys_id));
	$rows = $query->fetchAll();
	$aanet = array();
	foreach($rows as $row){
	$aanet[] = new Aani(array(
	'aanestaja_id' => $row['aanestaja_id'],
	'ehdokas_id' => $row['ehdokas_id'],
	'aanestys_id' => $row['aanestys_id']
	));
	}
  $aanten_maara = count($aanet);
	return $aanten_maara;
	}

  public static function kaikki($aanestys_id){
  $query = DB::connection()->prepare('SELECT * FROM Aani WHERE aanestys_id = :aanestys_id');
  $query->execute(array('aanestys_id' => $aanestys_id));
  $rows = $query->fetchAll();
  $aanet = array();
  foreach($rows as $row){
  $aanet[] = new Aani(array(
  'aanestaja_id' => $row['aanestaja_id'],
  'ehdokas_id' => $row['ehdokas_id'],
  'aanestys_id' => $row['aanestys_id']
  ));
  }
  return $aanet;
  }

  
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Aani (aanestaja_id, ehdokas_id, aanestys_id) VALUES (:aanestaja_id, :ehdokas_id, :aanestys_id)');
    $query->execute(array('aanestaja_id' => $this->aanestaja_id, 'ehdokas_id' => $this->ehdokas_id, 'aanestys_id' => $this->aanestys_id));

  }
}

