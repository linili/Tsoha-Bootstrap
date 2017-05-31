<?php
class AanestysController extends BaseController{
    public static function index(){
        $aanestykset = Aanestys::kaikki();
        View::make('aanestys/aanestys_list.html', array('aanestykset' => $aanestykset));
    }
    public static function show($id){
        $aanestys = Aanestys::etsi($id);
        View::make('aanestys/aanestys_list.html', array('aanestys' => $aanestys));
    }
    
    public static function uusi(){
        View::make('aanestys/uusi.html');
    }
    
    public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Aanestys-luokan olion käyttäjän syöttämillä arvoilla
    $game = new Game(array(
      'nimi' => $params['nimi'],
      'kuvaus' => $params['kuvaus'],
      'status' => $params['status'],
      'yllapitaja' => $params['yllapitaja'],
      'julkaistu' => $params['julkaistu']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $aanestys->save();

    // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
    Redirect::to('/aanestys/' . $aanestys->id, array('message' => 'Äänestys on lisätty!'));
  }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

