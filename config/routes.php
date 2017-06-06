<?php

/* $routes->get('/', function() {
  HelloWorldController::index();
  });
 */
$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/rekisterointi', function() {
    HelloWorldController::rekisterointi();
});

/*  $routes->get('/kirjautuminen', function() {
  HelloWorldController::kirjautuminen();
  });
 */
$routes->get('/login', function() {
    AanestysController::login();
});

//  $routes->get('/aanestys_list', function() {
//      AanestysController::aanestys_list();
// });

$routes->get('/aanestys_tiedot', function() {
    AanestysController::aanestys_tiedot();
});

$routes->get('/edit/:id', function($id) {
    AanestysController::edit($id);
});

$routes->get('/ehdokas_list', function() {
    HelloWorldController::ehdokas_list();
});

$routes->get('/aanestys/uusi', function() {
    AanestysController::uusi();
});

$routes->get('/aanestys/:id', function($id) {
    AanestysController::show($id);
});

$routes->get('/aanestys', function() {
    AanestysController::index();
});

$routes->get('/aanestys_list', function() {
    AanestysController::index();
});

$routes->post('/aanestys/uusi', function() {
    AanestysController::store();
});
$routes->post('/aanestys/edit', function($id) {
    AanestysController::update($id);
});

$routes->get('/aanestys/:id/edit', function($id) {
    AanestysController::edit($id);
});
$routes->post('/aanestys/:id/edit', function($id) {
    AanestysController::update($id);
});
$routes->post('/aanestys/:id/destroy', function($id) {
    AanestysController::destroy($id);
});



