<?php

class AaniController extends BaseController {

    public static function uusi_aani($aanestys_id, $ehdokas_id) {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $aanestaja_id = $user_logged_in->id;
        $attributes = array(
            'aanestaja_id' => $aanestaja_id,
            'ehdokas_id' => $ehdokas_id,
            'aanestys_id' => $aanestys_id
        );
        $aani = new Aani($attributes);
        $errors = $aani->errors();
        if (count($errors) == 0) {
            $aani->save();
            Redirect::to('/aanestys_list', array('message' => 'Äänesi on rekisteröity!'));
        } else {
            Redirect::to('/aanestys_list', array('message' => 'Olet jo äänestänyt. Valitse joku toinen äänestys!'));
        }
    }

    public static function ehdokkaan_aanet($aanestys_id, $ehdokas_id) {
        Aani::ehdokkaan_aanet($ehdokas_id, $aanestys_id);
    }

    public static function tulokset($aanestys_id) {
        $aanestys = Aanestys::etsi($aanestys_id);
        $ehdokkaat = Ehdokas::kaikki($aanestys_id);

        $pelaajat = Pelaaja::kaikki();
        $aanet = Aani::kaikki($aanestys_id);
        $aanten_maara = array();
        foreach ($ehdokkaat as $ehdokas) {
            $aanten_maara[] = aani::ehdokkaan_aanet($ehdokas->id, $aanestys_id);
        }
        View::make('ehdokas/tulokset.html', array('aanestys' => $aanestys, 'ehdokkaat' => $ehdokkaat, 'pelaajat' => $pelaajat, 'aanet' => $aanten_maara));
    }

    /*  public static function

      public static function index($aanestys_id, $ehdokas_id){
      $aanet = Aani::kaikki($aanestys_id, $ehdokas_id);
      View::make('aani/aani_list.html', array('aanet' => $aanet));
      }

      public static function uusi_aani($aanestys_id, $ehdokas_id){
      Aani::uusi();
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
     */
}
