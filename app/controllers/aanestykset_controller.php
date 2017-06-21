<?php

class AanestysController extends BaseController {

    public static function rekisterointi() {
        View::make('rekisteroityminen.html');
    }

    public static function rekisteroi() {
        $params = $_POST;
        if ($params['salasana'] == $params['salasana2']) {
            $attributes = array(
                'nimi' => $params['nimi'],
                'aloitusvuosi' => $params['aloitusvuosi'],
                'salasana' => $params['salasana']
            );

            $pelaaja = new Pelaaja($attributes);
            $errors = $pelaaja->errors();
            if (count($errors) == 0) {
                $pelaaja->save();
                 // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
            Redirect::to('/', array('message' => 'Nyt voit kirjautua!'));
            }
Kint::dump($errors);
        } else {
            Redirect::to('/rekisteroityminen', array('message' => 'Salasanat eivät täsmänneet!'));
        }
    }

    public static function login() {
        View::make('login.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $pelaaja = Pelaaja::tunnista($params['nimi'], $params['salasana']);
        if (!$pelaaja) {
            View::make('login.html', array('error' => 'Väärä nimi tai salasana!', 'nimi' => $params['nimi']));
        } else {
            $_SESSION['pelaaja'] = $pelaaja->id;
            Redirect::to('/home', array('message' => 'Tervetuloa takaisin ' . $pelaaja->nimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['pelaaja'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function home() {
        View::make('home.html');
    }

    public static function index() {
        self::check_logged_in();
        $aanestykset = Aanestys::kaikki();
        $pelaajat = Pelaaja::kaikki();
        View::make('aanestys/aanestys_list.html', array('aanestykset' => $aanestykset, 'pelaajat' => $pelaajat));
    }

    public static function show($id) {
        self::check_logged_in();
        $aanestys = Aanestys::etsi($id);
        $pelaajat = Pelaaja::kaikki();
        View::make('aanestys/aanestys_tiedot.html', array('aanestys' => $aanestys, 'pelaajat' => $pelaajat));
    }

    public static function uusi() {
        self::check_logged_in();
        View::make('aanestys/uusi.html');
    }

    public static function store() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Aanestys-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = array(
            'nimi' => $params['nimi'],
            'status' => TRUE,
            'yllapitaja' => $user_logged_in->id,
            'kuvaus' => $params['kuvaus'],
            'julkaistu' => date("Y/m/d")
        );
        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $aanestys = new Aanestys($attributes);
        $errors = $aanestys->errors();
        if (count($errors) == 0) {
            $aanestys->save();
            $aanestys_id = $aanestys->id;
            EhdokasController::store_kaikki($aanestys_id);

            // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
            Redirect::to('/aanestys/' . $aanestys->id, array('message' => 'Äänestys on lisätty!'));
        } else {
            View::make('aanestys/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $aanestys = Aanestys::etsi($id);
        self::check_yllapitaja($aanestys);
        if ($aanestys->status) {
            View::make('aanestys/edit.html', array('aanestys' => $aanestys));
        } else {
            Redirect::to('/aanestys_list', array('message' => 'Aanestystä ei voi enää muokata!'));
        }
    }

    public static function update($id) {
        self::check_logged_in();
        $aanestys_ennen = Aanestys::etsi($id);
        self::check_yllapitaja($aanestys_ennen);
        $params = $_POST;
        $status = 'true';
        if (isset($params['status'])) {
            $status = 'false';
        }
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'status' => $status,
            'yllapitaja' => $aanestys_ennen->yllapitaja,
            'kuvaus' => $params['kuvaus'],
            'julkaistu' => $aanestys_ennen->julkaistu
        );

        $aanestys = new Aanestys($attributes);
        $errors = $aanestys->errors();

        if (count($errors) > 0) {
            View::make('aanestys/:id/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $aanestys->update();
            Redirect::to('/aanestys/' . $aanestys->id, array('message' => 'Aanestys on muokattu!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $aanestys = Aanestys::etsi($id);
        self::check_yllapitaja($aanestys);
        $aanestys->destroy();
        Redirect::to('/aanestys_list', array('message' => 'Aanestys on poistettu!'));
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

