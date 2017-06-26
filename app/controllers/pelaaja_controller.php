<?php

class PelaajaController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $pelaajat = Pelaaja::kaikki();
        View::make('pelaaja/pelaaja_list.html', array('pelaajat' => $pelaajat));
    }

    public static function show($id) {
        self::check_logged_in();
        $pelaaja = Pelaaja::etsi($id);
        View::make('pelaaja/pelaaja_tiedot.html', array('pelaaja' => $pelaaja));
    }

    public static function store() {
        self::check_logged_in();
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Pelaaja-luokan olion käyttäjän syöttämillä arvoilla
        $pelaaja = new Pelaaja(array(
            'nimi' => $params['nimi'],
            'aloitusvuosi' => $params['aloitusvuosi'],
            'salasana' => $params['salasana']
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan

        $errors = $pelaaja->errors();
        if (count($errors) == 0) {
            $pelaaja->save();


             }else{
                 Redirect::to('/rekisteroityminen', array('message' => $errors, 'nimi' => $params['nimi'], 'aloitusvuosi' => $params['aloitusvuosi']));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $pelaaja = Pelaaja::etsi($id);
        View::make('pelaaja/pelaaja_edit.html', array('pelaaja' => $pelaaja));
    }

    public static function update($id) {
        self::check_logged_in();
        $pelaaja_vanha = Pelaaja::etsi($id);
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'aloitusvuosi' => $pelaaja_vanha->aloitusvuosi,
            'salasana' => $params['salasana']
        );
        $pelaaja = new Pelaaja($attributes);

        $errors = $pelaaja->errors();
        if (count($errors) > 0) {
            View::make('pelaaja/:id/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $pelaaja->update();
            Redirect::to('pelaaja/' . $pelaaja->id, array('message' => 'Pelaajan tietoja on muokattu!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $pelaaja = Pelaaja::etsi($id);
        $pelaaja->destroy();
        Redirect::to('pelaaja/pelaaja_list', array('message' => 'Pelaaja on poistettu!'));
    }

}
