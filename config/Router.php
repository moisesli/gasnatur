<?php

$app = new \Config\Routeparams();

// Controllers
//users
$app->router->get('/apis/usuarios', 'Users@index');
$app->router->get('/apis/usuarios/:id','Users@getById');
$app->router->post('/apis/usuarios', 'Users@create');
$app->router->put('/apis/usuarios/:id', 'Users@update');
$app->router->delete('/apis/usuarios/:id', 'Users@delete');

//zones
$app->router->get('/apis/zonas', 'Zones@getAll');
$app->router->get('/apis/zonas/:id/:all', 'Zones@paginator');
$app->router->get('/apis/zonas/:id', 'Zones@getById');
$app->router->post('/apis/zonas', 'Zones@create');
$app->router->put('/apis/zonas/:id', 'Zones@update');
$app->router->delete('/apis/zonas/:id', 'Zones@delete');


//charges
$app->router->get('/apis/cargos', 'Charges@getAll');
$app->router->get('/apis/cargos/:id', 'Charges@getById');
$app->router->post('/apis/cargos', 'Charges@create');
$app->router->put('/apis/cargos/:id', 'Charges@update');
$app->router->delete('/apis/cargos/:id', 'Charges@delete');

//concessionaires
$app->router->get('/apis/concesionarias', 'Concessionaires@getAll');
$app->router->get('/apis/concesionarias/:id', 'Concessionaires@getById');
$app->router->post('/apis/concesionarias', 'Concessionaires@create');
$app->router->put('/apis/concesionarias/:id', 'Concessionaires@update');
$app->router->delete('/apis/concesionarias/:id', 'Concessionaires@delete');

//documents_identities
$app->router->get('/apis/identities_documents', 'Documents@index');
$app->router->post('/apis/identities_documents', 'Documents@create');
$app->router->put('/apis/identities_documents/:id', 'Documents@update');
$app->router->delete('/apis/identities_documents/:id', 'Documents@delete');

//roles
$app->router->get('/apis/roles', 'Roles@index');
$app->router->post('/apis/roles', 'Roles@create');
$app->router->put('/apis/roles/:id', 'Roles@update');
$app->router->delete('/apis/roles/:id', 'Roles@delete');




// **************** ROUTES FRONT ************************


$app->router->get('/', function () {
    $front = new \Config\View();
    return $front->show('auth.login');
});

$app->router->get('/dashboard', function () {
    $front = new \Config\View();
    return $front->show('dashboard.index');
});

$app->router->get('/registro', function () {
    $front = new \Config\View();
    return $front->show('auth.register');
});

$app->router->get('/zonas', function () {
  $front = new \Config\View();
  return $front->show('zonas.zonas');
},['before' => 'CheckAuth']);

$app->router->get('/personal', function () {
    $front = new \Config\View();
    return $front->show('personal.personal');
},['before' => 'CheckAuth']);

$app->run();
