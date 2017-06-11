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
$routes->post('/logout', function()){
    AanestysController::logout();
}

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
})

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

$routes->get('/pelaaja/pelaaja_list', function() {
    PelaajaController::index();
});

$routes->get('/pelaajat', function() {
    PelaajaController::index();
});

$routes->get('/pelaaja/:id', function($id) {
    PelaajaController::show($id);
});

$routes->post('/pelaaja/:id/edit', function($id) {
    PelaajaController::update($id);
});
$routes->post('/pelaaja/:id/destroy', function($id) {
    PelaajaController::destroy($id);
});

// Ehdokas reitit

$routes->get('/aanestys/:aanestys_id/ehdokkaat', function($aanestys_id) {
    EhdokasController::index($aanestys_id);
})
$routes->get('/ehdokas/uusi', function($aanestys_id) {
    EhdokasController::uusi($aanestys_id);
})
$routes->post('/aanestys/:aanestys_id/ehdokas/:id/destroy', function($id, $aanestys_id)) {
    EhdokasController::destroy($id, $aanestys_id);
}