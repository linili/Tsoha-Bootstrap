<?php

require 'app/models/aanestys.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {



        // Testaa koodiasi täällä
        // Muista sisällyttää malliluokka require-komennolla!
        //   $ehdokkaat = Ehdokas::kaikki(1);
        //   Kint::dump($ehdokkaat);
        $ehdokas = new Ehdokas(array('pelaaja_id' => 1, 'aanestys_id' => 2, 'aanet' => 3));
        $aanet = Aani::ehdokkaan_aanet(1, 2);
        Kint::dump($aanet);

        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        //  View::make('helloworld.html');
        // echo 'Hello World!!!';
    }

    public static function rekisterointi() {
        echo 'Täällä rekisteröidytään';
    }

    public static function kirjautuminen() {
        echo 'Täällä kirjaudutaan';
    }

    /*



      public static function ehdokas_list() {
      View::make('ehdokas/ehdokas_list.html');

      }
     */}
