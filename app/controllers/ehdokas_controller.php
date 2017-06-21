<?php

class EhdokasController extends BaseController {

    public static function index($aanestys_id) {
        self::check_logged_in();
        $ehdokkaat = Ehdokas::kaikki($aanestys_id);
        $aanestys = Aanestys::etsi($aanestys_id);
        $pelaajat = Pelaaja::kaikki();
        View::make('ehdokas/ehdokas_list.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys, 'pelaajat' => $pelaajat));
    }

    public static function uusi($aanestys_id) {
        self::check_logged_in();
        $pelaajat = Pelaaja::kaikki();
        $aanestys = Aanestys::etsi($aanestys_id);
        View::make('ehdokas/uusi.html', array('pelaajat' => $pelaajat, 'aanestys' => $aanestys));
    }

    public static function store($aanestys_id) {
        self::check_logged_in();
        $params = $_POST;
        $pelaaja_idt = $params['ehdokkaat'];
        foreach ($pelaaja_idt as $pelaaja_id) {
            $attributes = array(
                'aanestys_id' => $aanestys_id,
                'pelaaja_id' => $pelaaja_id
            );
            $ehdokas = new Ehdokas($attributes);
            $errors = $ehdokas->errors();
            if (count($errors) == 0) {

                $ehdokas->save();
            }
        }
        Redirect::to('/aanestys/' . $aanestys_id, array('message' => 'Ehdokkaat on lisätty!'));

// Ohjataan käyttäjä lisäyksen jälkeen aanestyksen esittelysivulle
    }

    public static function store_kaikki($aanestys_id) {
        self::check_logged_in();
        $pelaajat = Pelaaja::kaikki();
        foreach ($pelaajat as $pelaaja) {
            $attributes = array(
                'pelaaja_id' => $pelaaja->id,
                'aanestys_id' => $aanestys_id);
            $ehdokas = new Ehdokas($attributes);
            $ehdokas->save();
        }
    }

    public static function destroy($ehdokas_id, $aanestys_id) {
        self::check_logged_in();
        $ehdokas = Ehdokas::etsi($ehdokas_id);
        $ehdokas->destroy();
        Redirect::to('aanestys/' . $aanestys_id . '/ehdokas_list', array('message' => 'Ehdokas on poistettu!'));
    }

}
