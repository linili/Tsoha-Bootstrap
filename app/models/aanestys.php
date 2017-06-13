<?php
class Aanestys extends BaseModel{
	public $id, $nimi, $status, $yllapitaja, $kuvaus, $julkaistu;
        
	public function __construct($attributes){
	parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_status', 'validate_julkaistu');
	}

	public static function kaikki(){
	$query = DB::connection()->prepare('SELECT * FROM Aanestys');
/*    $query->bindValue(':id', $this->id, PDO::PARAM_INT);
    $query->bindValue(':nimi', $this->nimi, PDO::PARAM_STR);
    $query->bindValue(':status', $this->status, PDO::PARAM_BOOL);
    $query->bindValue(':yllapitaja', $this->yllapitaja, PDO::PARAM_INT);
    $query->bindValue(':kuvaus', $this->kuvaus, PDO::PARAM_STR);
    $query->bindValue(':julkaistu', $this->julkaistu, PDO::PARAM_DATE);
*/	$query->execute();
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
 /*   $query->bindValue(':id', $this->id, PDO::PARAM_INT);
    $query->bindValue(':nimi', $this->nimi, PDO::PARAM_STR);
    $query->bindValue(':status', $this->status, PDO::PARAM_BOOL);
    $query->bindValue(':yllapitaja', $this->yllapitaja, PDO::PARAM_INT);
    $query->bindValue(':kuvaus', $this->kuvaus, PDO::PARAM_STR);
    $query->bindValue(':julkaistu', $this->julkaistu, PDO::PARAM_DATE);
*/    $query->execute(array('id' => $id));
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
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Aanestys (nimi, yllapitaja, status, kuvaus, julkaistu) VALUES (:nimi, :yllapitaja, :status, :kuvaus, :julkaistu) RETURNING id');
 /*   $query->bindValue(':id', $this->id, PDO::PARAM_INT);
    $query->bindValue(':nimi', $this->nimi, PDO::PARAM_STR);
    $query->bindValue(':status', $this->status, PDO::PARAM_BOOL);
    $query->bindValue(':yllapitaja', $this->yllapitaja, PDO::PARAM_INT);
    $query->bindValue(':kuvaus', $this->kuvaus, PDO::PARAM_STR);
    $query->bindValue(':julkaistu', $this->julkaistu, PDO::PARAM_DATE);
 */   $query->execute(array('nimi' => $this->nimi, 'status' => $this->status, 'yllapitaja' => $this->yllapitaja, 'kuvaus' => $this->kuvaus, 'julkaistu' => $this->julkaistu));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
   // Kint::trace();
   // Kint::dump($row);
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
     $this->id = $row['id'];
  }
   public static function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Aanestys WHERE id=:id');
 /*   $query->bindValue(':id', $this->id, PDO::PARAM_INT);
    $query->bindValue(':nimi', $this->nimi, PDO::PARAM_STR);
    $query->bindValue(':status', $this->status, PDO::PARAM_BOOL);
    $query->bindValue(':yllapitaja', $this->yllapitaja, PDO::PARAM_INT);
    $query->bindValue(':kuvaus', $this->kuvaus, PDO::PARAM_STR);
    $query->bindValue(':julkaistu', $this->julkaistu, PDO::PARAM_DATE);
 */   $query->execute;
  }
   public static function update(){
    $query = DB::connection()->prepare('UPDATE Aanestys SET nimi = :nimi, status = :status, yllapitaja = :yllapitaja, kuvaus = :kuvaus, julkaistu = :julkaistu) WHERE (id = :id)');
 /*   $query->bindValue(':id', $this->id, PDO::PARAM_INT);
    $query->bindValue(':nimi', $this->nimi, PDO::PARAM_STR);
    $query->bindValue(':status', $this->status, PDO::PARAM_BOOL);
    $query->bindValue(':yllapitaja', $this->yllapitaja, PDO::PARAM_INT);
    $query->bindValue(':kuvaus', $this->kuvaus, PDO::PARAM_STR);
    $query->bindValue(':julkaistu', $this->julkaistu, PDO::PARAM_DATE);
 */   $query->execute(array('nimi' => $this->nimi, 'status' => $this->status, 'yllapitaja' => $this->yllapitaja, 'kuvaus' => $this->kuvaus, 'julkaistu' => $this->julkaistu));
  //  $row = $query->fetch();
  //  Kint::dump($row);
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
  public function validate_status(){
      $errors = array();
      return $errors;
  }
  public function validate_julkaistu(){
      $errors = array();
      return $errors;
  }
}