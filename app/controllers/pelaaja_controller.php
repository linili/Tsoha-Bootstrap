<?php

class PelaajaController extends BaseController{
    
    public static function index(){
        $pelaajat = Pelaaja::kaikki();
        View::make('pelaaja/pelaaja_list.html', array('pelaajat' => $pelaajat));
    }
    public static function show($id){
        $pelaaja = Pelaaja::etsi($id);
        View::make('pelaaja/pelaaja_tiedot.html', array('pelaaja' => $pelaaja));
    }
    
 //   public static function uusi(){
 //       View::make('pelaaja/uusi.html');
 //   }
    
    public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Pelaaja-luokan olion käyttäjän syöttämillä arvoilla
    $pelaaja = new Pelaaja(array(
      'nimi' => $params['nimi'],
      'aloitusvuosi' => $params['aloitusvuosi'],
      'salasana' => $params['salasana']
    ));
    
   // Kint::dump($params);
    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
 
    $errors = $pelaaja->errors();
    if(count($errors) == 0){
    $pelaaja->save();

    // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
    Redirect::to('/pelaaja/pelaaja_list' . $pelaaja->id, array('message' => 'Pelaaja on lisätty!'));
  }else{
      View::make('pelaaja/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
  }
}

public static function edit($id){
    $pelaaja = Pelaaja::etsi($id);
    View::make('pelaaja/pelaaja_edit.html',array('pelaaja' => $pelaaja));
}
public static function update($id){
    $params = $_POST;
    $attributes = array(
        'id' => $id,
        'nimi' => $params['nimi'],
      'aloitusvuosi' => $params['aloitusvuosi'],
      'salasana' => $params['salasana']
    );
    $pelaaja = new Pelaaja($attributes);
    $errors = $pelaaja->errors();
    if(count($errors) > 0){
    View::make('pelaaja/pelaaja_edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
        $pelaaja->update();
        Redirect::to('/pelaaja/pelaaja_tiedot' . $pelaaja->id, array('message' => 'Pelaajan tietoja on muokattu!'));
    }
}
public static function destroy($id){
    $pelaaja = new Pelaaja(array('id' => $id));
    $pelaaja->destroy();
    Redirect::to('/pelaaja_list', array('message' => 'Pelaaja on poistettu!'));
}
}

