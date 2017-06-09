<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/rekisterointi', function() {
    HelloWorldController::rekisterointi();
});

$routes->get('/login', function() {
    AanestysController::login();
});
$routes->post('/login', function(){
    AanestysController::handle_login();
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

$routes->get('/aanestys_list', function() {
    AanestysController::index();
});

$routes->get('/aanestys/:id/edit', function($id) {
    AanestysController::edit($id);
});

$routes->get('/aanestys/:id', function($id) {
    AanestysController::show($id);
});

$routes->get('/aanestys', function() {
    AanestysController::index();
});
$routes->get('/', function() {
AanestysController::login();
});

$routes->post('/aanestys/uusi', function() {
    AanestysController::store();
});
// $routes->post('/aanestys/edit', function($id) {
//    AanestysController::update($id);
// });

$routes->post('/aanestys/:id/edit', function($id) {
    AanestysController::update($id);
});
$routes->post('/aanestys/:id/destroy', function($id) {
    AanestysController::destroy($id);
});


// Pelaaja reitit

$routes->get('/pelaaja/:id/edit', function($id) {
    PelaajaController::edit($id);
});

$routes->get('/pelaaja/:id/destroy', function($id) {
    PelaajaController::destroy($id);
});

$routes->get('pelaaja/pelaja_list', function() {
    PelaajaController::index();
});

$routes->get('pelaaja', function() {
    PelaajaController::index();
});

$routes->get('/pelaaja/:id', function($id) {
    PelaajaController::show($id);
});

$routes->post('/pelaaja/:id/edit', function($id) {
    PelaajaController::update($id);
});
$routes->post('/aanestys/:id/destroy', function($id) {
    PelaajaController::destroy($id);
});