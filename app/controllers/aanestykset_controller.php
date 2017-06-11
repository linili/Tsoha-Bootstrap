<?php
class AanestysController extends BaseController{
    
   public static function login() {
        View::make('login.html');
    }
    public static function handle_login(){
      $params = $_POST;
      $pelaaja = Pelaaja::tunnista($params['nimi'], $params['salasana']);
      if(!$pelaaja){
        VIew::make('login.html', array('error' => 'Väärä nimi tai salasana!', 'nimi' => $params[nimi]));
      }else{
        $_SESSION['pelaaja'] = $pelaaja->id;
        Redirect::to('/home', array('message' => 'Tervetuloa takaisin ' . $pelaaja->nimi . '!'));
      }
    }
    public static function logout(){
      $_SESSION['pelaaja'] = null;
      Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }
    
    public static function home(){
      View::make('home.html');
    }
    
    public static function index(){
      self::check_logged_in();
        $aanestykset = Aanestys::kaikki();
        View::make('aanestys/aanestys_list.html', array('aanestykset' => $aanestykset));
    }
    public static function show($id){
      self::check_logged_in();
        $aanestys = Aanestys::etsi($id);
        View::make('aanestys/aanestys_tiedot.html', array('aanestys' => $aanestys));
    }
    
    public static function uusi(){
      self::check_logged_in();
        View::make('aanestys/uusi.html');
    }
    
    public static function store(){
      self::check_logged_in();
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
  self::check_logged_in();
    $aanestys = Aanestys::etsi($id);
    View::make('aanestys/edit.html',array('aanestys' => $aanestys));
}
public static function update($id){
  self::check_logged_in();
  $aanestys_ennen = Aanestys::etsi($id);
    $params = $_POST;
    $attributes = array(
        'id' => $id,
        'nimi' => $params['nimi'],
      'status' => $params['status'],
      'yllapitaja' => {{$aanestys_ennen.nimi}},
      'kuvaus' => $params['kuvaus'],
      'julkaistu' => {{$aanestys_ennen.julkaistu}}
    );
    Kint::dump($params);
    
    $aanestys = new Aanestys($attributes);
    $errors = $aanestys->errors();
    
/*    if(count($errors) > 0){
    View::make('aanestys/:id/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
        $aanestys->update();
        Redirect::to('/aanestys/' . $aanestys->id, array('message' => 'Aanestys on muokattu!'));
    }*/
}
public static function destroy($id){
  self::check_logged_in();
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

