<?php

class EhdokasController extends BaseController {

    public static function index($aanestys_id) {
        self::check_logged_in();
        $ehdokkaat = Ehdokas::kaikki($aanestys_id);
        View::make('ehdokas/ehdokas_list.html', array('ehdokkaat' => $ehdokkaat));
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
            $ehdokas->save();
        }

        // Ohjataan käyttäjä lisäyksen jälkeen aanestyksen esittelysivulle
        Redirect::to('/aanestys/{{$aanestys_id}}', array('message' => 'Ehdokkaat on lisätty!'));
     //   } else{
     //   View::make('aanestys/aanestys_list.html'));
    }

    public static function destroy($id, $aanestys_id) {
        self::check_logged_in();
        $ehdokas = new Ehdokas(array('id' => $id, 'aanestys_id' => $aanestys_id));
        $ehdokas->destroy();
        Redirect::to('aanestys/:id/ehdokas_list', array('message' => 'Ehdokas on poistettu!'));
    }

}
