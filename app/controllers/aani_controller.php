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
        $ehdokkaat = Ehdokas::kaikki_nimilla_ja_aanilla($aanestys_id);

        View::make('ehdokas/tulokset.html', array('aanestys' => $aanestys, 'ehdokkaat' => $ehdokkaat));
    }

}
