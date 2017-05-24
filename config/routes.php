<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/rekisterointi', function() {
  HelloWorldController::rekisterointi();
  });
  
   $routes->get('/kirjautuminen', function() {
  HelloWorldController::kirjautuminen();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
  });
  
   $routes->get('/aanestys_list', function() {
  HelloWorldController::aanestys_list();
  });
  
   $routes->get('/aanestys_tiedot', function() {
  HelloWorldController::aanestys_tiedot();
  });
  
   $routes->get('/aanestys_muokkaa', function() {
  HelloWorldController::aanestys_muokkaa();
  });
