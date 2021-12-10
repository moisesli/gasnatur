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
$app->router->get('/apis/zonas/:page?/:q?', 'Zones@index');
// GET zonas/           primera pagina 15 cuando no hay nada
// GET zonas/2          segunda pagina con 15 resultados
// GET zonas/2/zonas    segunda pagina con busqueda de zonas


$app->router->post('/apis/zonas/:id', 'Zones@getById');
$app->router->post('/apis/zonas', 'Zones@create');
$app->router->post('/apis/test', 'Zones@test');
$app->router->put('/apis/zonas/:id', 'Zones@update');
$app->router->delete('/apis/zonas/:id', 'Zones@delete');

//concessionaires
$app->router->get('/apis/concessionaires', 'Concessionaires@index');
$app->router->post('/apis/concessionaires', 'Concessionaires@create');
$app->router->put('/apis/concessionaires/:id', 'Concessionaires@update');
$app->router->delete('/apis/concessionaires/:id', 'Concessionaires@delete');

//charges
$app->router->get('/apis/charges', 'Charges@index');
$app->router->post('/apis/charges', 'Charges@create');
$app->router->put('/apis/charges/:id', 'Charges@update');
$app->router->delete('/apis/charges/:id', 'Charges@delete');

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


$app->router->get('/personal', function () {
    $front = new \Config\View();
    return $front->show('personal.personal');
},['before' => 'CheckAuth']);

$app->run();
