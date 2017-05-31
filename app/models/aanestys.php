<?php
class Aanestys extends BaseModel{
	public $id, $nimi, $status, $yllapitaja, $kuvaus, $julkaistu;
	public function __construct($attributes){
	parent::__construct($attributes);
	}

	public static function kaikki(){
	$query = DB::connection()->prepare('SELECT * FROM Aanestys');
	$query->execute();
	$rows = $query->fetchAll();
	$aanestykset = array();
	foreach($rows as $row){
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

public static function etsi($id){
    $query = DB::connection()->prepare('SELECT * FROM Aanestys WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
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
  public static function save(){
       // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Aanestys (nimi, yllapitaja, status, kuvaus, julkaistu) VALUES (:nimi, :yllapitaja, :status, :kuvaus, :julkaistu) RETURNING id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('nimi' => $this->nimi, 'yllapitaja' => $this->yllapitaja, 'status' => $this->status, 'kuvaus' => $this->kuvaus, 'julkaistu' => $this->julkaistu));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->id = $row['id'];
  }
}