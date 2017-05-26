<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        View::make('helloworld.html');
      // echo 'Hello World!!!';
    }
    
    public static function rekisterointi() {
        echo 'Täällä rekisteröidytään';
    }
    
    public static function kirjautuminen() {
        echo 'Täällä kirjaudutaan';
        
    }
    public static function login() {
        View::make('suunnitelmat/login.html');
    }
    
    public static function aanestys_list() {
        View::make('suunnitelmat/aanestys_list.html');
    }
    
    public static function aanestys_tiedot() {
        View::make('suunnitelmat/aanestys_tiedot.html');
    }
    
    public static function aanestys_muokkaa() {
        View::make('suunnitelmat/aanestys_muokkaa.html');
    }

    public static function ehdokas_list() {
        View::make('suunnitelmat/ehdokas_list.html');
    }
  }
