<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['pelaaja'])) {
            $pelaaja_id = $_SESSION['pelaaja'];
            $pelaaja = Pelaaja::etsi($pelaaja_id);
            return $pelaaja;
        }

        return null;
    }

    public static function check_logged_in() {
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        if (!isset($_SESSION['pelaaja'])) {
            Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

    public static function get_user_logged_in_id() {
        $user_logged_in = self::get_user_logged_in();
        $user_logged_in_id = $user_logged_in->id;
        return $user_logged_in_id;
    }

    public static function check_yllapitaja($aanestys) {
        if ($aanestys->id != $get_user_logged_in_id) {
            Redirect::to('/aanestys_list', array('message' => 'Sinulla ei ole riittäviä oikeuksia!'));
        }
    }

}
