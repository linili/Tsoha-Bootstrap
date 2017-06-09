<?php
class AanestysController extends BaseController{
    
   public static function login() {
        View::make('login.html');
    }
    
//     public static function aanestys_list() {
//        View::make('aanestys/aanestys_list.html');
//    }
//     public static function aanestys_tiedot() {
//        View::make('aanestys/aanestys_tiedot.html');
//    }
    
  //  public static function aanestys_muokkaa() {
  //      View::make('aanestys/edit.html', array('aanestys' => $aanestys));
  //  }
    
    public static function index(){
        $aanestykset = Aanestys::kaikki();
        View::make('aanestys/aanestys_list.html', array('aanestykset' => $aanestykset));
    }
    public static function show($id){
        $aanestys = Aanestys::etsi($id);
        View::make('aanestys/aanestys_tiedot.html', array('aanestys' => $aanestys));
    }
    
    public static function uusi(){
        View::make('aanestys/uusi.html');
    }
    
    public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Aanestys-luokan olion käyttäjän syöttämillä arvoilla
    $attributes = array(
      'nimi' => $params['nimi'],
      'status' => $params['status'],
      'yllapitaja' => $params['yllapitaja'],
      'kuvaus' => $params['kuvaus'],
      'julkaistu' => $params['julkaistu']
    );
    
   // Kint::dump($params);
    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $aanestys = new Aanestys($attributes);
    $errors = $aanestys->errors();
    if(count($errors) == 0){
    $aanestys->save();

    // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
    Redirect::to('/aanestys/' . $aanestys->id, array('message' => 'Äänestys on lisätty!'));
  }else{
      View::make('aanestys/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
  }
}

public static function edit($id){
    $aanestys = Aanestys::etsi($id);
    View::make('aanestys/edit.html',array('attributes' => $aanestys));
}
public static function update($id){
    $params = $_POST;
    $attributes = array(
        'id' => $id,
        'nimi' => $params['nimi'],
      'status' => $params['status'],
      'yllapitaja' => $params['yllapitaja'],
      'kuvaus' => $params['kuvaus'],
      'julkaistu' => $params['julkaistu']
    );
    $aanestys = new Aanestys($attributes);
    $errors = $aanestys->errors();
    if(count($errors) > 0){
    View::make('aanestys/:id/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
        $aanestys->update();
        Redirect::to('/aanestys/' . $aanestys->id, array('message' => 'Aanestys on muokattu!'));
    }
}
public static function destroy($id){
    $aanestys = new Aanestys(array('id' => $id));
    $aanestys->destroy();
    Redirect::to('aanestys/aanestys_list', array('message' => 'Aanestys on poistettu!'));
}
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

