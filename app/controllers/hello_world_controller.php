<?php
require 'app/models/aanestys.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        // Muista sisällyttää malliluokka require-komennolla!

    $skyrim = Aanestys::etsi(1);
    $aanestykset = Aanestys::kaikki();
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
    public static function login() {
        View::make('login.html');
    }
    
    public static function aanestys_list() {
        View::make('aanestys/aanestys_list.html');
    }
    
    public static function aanestys_tiedot() {
        View::make('aanestys/aanestys_tiedot.html');
    }
    
    public static function aanestys_muokkaa() {
        View::make('aanestys/aanestys_muokkaa.html');
    }

    public static function ehdokas_list() {
        View::make('ehdokas/ehdokas_list.html');
    }
  }
