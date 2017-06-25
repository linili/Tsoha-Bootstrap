<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/rekisteroityminen', function() {
    AanestysController::rekisterointi();
});
$routes->post('/rekisteroityminen', function() {
    AanestysController::rekisteroi();
});

$routes->get('/login', function() {
    AanestysController::login();
});
$routes->post('/login', function() {
    AanestysController::handle_login();
});
$routes->post('/logout', function() {
    AanestysController::logout();
});

$routes->get('/edit/:id', function($id) {
    AanestysController::edit($id);
});

$routes->get('/aanestys/uusi', function() {
    AanestysController::uusi();
});

$routes->get('/aanestys_list', function() {
    AanestysController::index();
});

$routes->get('/aanestys/:id/edit', function($id) {
    AanestysController::edit($id);
});

$routes->get('/aanestys/:id/destroy', function($id) {
    AanestysController::destroy($id);
});

$routes->get('/aanestys/:id', function($id) {
    AanestysController::show($id);
});

$routes->get('/aanestys', function() {
    AanestysController::index();
});

$routes->get('/home', function() {
    AanestysController::home();
});

$routes->get('/', function() {
    AanestysController::home();
});

$routes->post('/aanestys/uusi', function() {
    AanestysController::store();
});

$routes->post('/aanestys/:id/edit', function($id) {
    AanestysController::update($id);
});



// Pelaaja reitit

$routes->get('/pelaaja/pelaaja_list', function() {
    PelaajaController::index();
});

$routes->get('/pelaajat', function() {
    PelaajaController::index();
});

$routes->get('/pelaaja/:id/edit', function($id) {
    PelaajaController::edit($id);
});

$routes->get('/pelaaja/:id/destroy', function($id) {
    PelaajaController::destroy($id);
});

$routes->post('/pelaaja/:id/edit', function($id) {
    PelaajaController::update($id);
});

$routes->get('/pelaaja/:id', function($id) {
    PelaajaController::show($id);
});




// Ehdokas reitit

$routes->get('/aanestys/:aanestys_id/ehdokas_list', function($aanestys_id) {
    EhdokasController::index($aanestys_id);
});
$routes->get('/aanestys/:aanestys_id/ehdokas/uusi', function($aanestys_id) {
    EhdokasController::uusi($aanestys_id);
});
$routes->post('/aanestys/:aanestys_id/ehdokas/uusi', function($aanestys_id) {
    EhdokasController::store($aanestys_id);
});
$routes->get('/aanestys/:aanestys_id/ehdokas/:ehdokas_id/destroy', function($aanestys_id, $ehdokas_id) {
    EhdokasController::destroy($aanestys_id, $ehdokas_id);
});

// Aani reitit

$routes->get('/aanestys/:aanestys_id/:ehdokas_id/aani', function($aanestys_id, $ehdokas_id) {
    AaniController::uusi_aani($aanestys_id, $ehdokas_id);
});
$routes->get('/aanestys/:aanestys_id/tulokset', function($aanestys_id) {
    AaniController::tulokset($aanestys_id);
});
