<?php
require 'app/models/aanestys.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    
    }

    public static function sandbox(){
        
       
     //   $errors = $tommi->errors();
     //   Kint::dump($errors);
      // Testaa koodiasi täällä
        // Muista sisällyttää malliluokka require-komennolla!

    $skyrim = Pelaaja::etsi(1);
    $aanestykset = Pelaaja::kaikki();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    Kint::dump($aanestykset);
    Kint::dump($skyrim);
  

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
 */ }
