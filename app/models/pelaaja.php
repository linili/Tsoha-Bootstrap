<?php

class Pelaaja extends BaseModel{
	public $id, $nimi, $aloitusvuosi, $salasana;
        
	public function __construct($attributes){
	parent::__construct($attributes);
        $this->validators = array('validate_nimi');
	}

	public static function kaikki(){
	$query = DB::connection()->prepare('SELECT * FROM Pelaaja');
	$query->execute();
	$rows = $query->fetchAll();
	$pelaajat = array();
	foreach($rows as $row){
	$pelaajat[] = new Pelaaja(array(
	'id' => $row['id'],
	'nimi' => $row['nimi'],
	'aloitusvuosi' => $row['aloitusvuosi'],
	'salasana' => $row['salasana']
	));
	}
	return $pelaajat;
	}

public static function etsi($id){
    $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $pelaaja = new Pelaaja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'aloitusvuosi' => $row['aloitusvuosi'],
        'salasana' => $row['salasana']
      ));

      return $pelaaja;
    }

    return null;
  }
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Pelaaja (nimi, aloitusvuosi, salasana) VALUES (:nimi, :aloitusvuosi, :salasana) RETURNING id');
    $query->execute(array('nimi' => $this->nimi, 'aloitusvuosi' => $this->aloitusvuosi, 'salasana' => $this->salasana));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
   // Kint::trace();
   // Kint::dump($row);
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
     $this->id = $row['id'];
  }
   public static function destroy(){
    $query = DB::connection()->prepare('DELETE * FROM Pelaaja WHERE id = :id');
    $query->execute;
  }
   public static function update(){
    $query = DB::connection()->prepare('UPDATE Pelaaja SET nimi = :nimi, aloitusvuosi = :aloitusvuosi, salasana = :salasana) WHERE (id = :id)');
    $query->execute(array('nimi' => $this->nimi, 'aloitusvuosi' => $this->aloitusvuosi, 'salasana' => $this->salasana));
  
  }
  
  public function validate_nimi(){
      $errors = array();
      if($this->nimi == '' || $this->nimi == null){
          $errors[] = 'Nimi ei saa olla tyhjä!';
      }
      if(strlen($this->nimi) < 3){
          $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
      }
      return $errors;
  }
  public static function tunnista($nimi, $salasana){
    $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
    $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
    $row = $query->fetch();
    if($row){
      $pelaaja = new Pelaaja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'aloitusvuosi' => $row['aloitusvuosi'],
        'salasana' => $row['salasana']
      ));

      return $pelaaja;
    }
    return null;
  }
}

