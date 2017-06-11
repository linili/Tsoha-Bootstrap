<?php

class EhdokasController extends BaseController{
    
    public static function index($aanestys_id){
        $ehdokkaat = Ehdokas::kaikki($aanestys_id);
        View::make('ehdokas/ehdokas_list.html', array('ehdokkaat' => $ehdokkaat));
    }
    
    public static function uusi(){
        View::make('ehdokas/uusi.html');
    }
    
    public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Ehdokas-luokan olion käyttäjän syöttämillä arvoilla
    $ehdokas = new Ehdokas(array(
      'pelaaja_id' => $params['nimi'], //käyttäjän syöttämästä nimestä pitäisi saada id.
    ));
    
   // Kint::dump($params);
    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $ehdokas->save();

    // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
    Redirect::to('/pelaaja/pelaaja_list' . $pelaaja->id, array('message' => 'Pelaaja on lisätty!'));
  }else{
      View::make('pelaaja/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
  }
public static function destroy($id, $aanestys_id){
    $ehdokas = new Ehdokas(array('id' => $id, 'aanestys_id' => $aanestys_id));
    $ehdokas->destroy();
    Redirect::to('aanestys/:id/ehdokas_list', array('message' => 'Ehdokas on poistettu!'));
}
}

