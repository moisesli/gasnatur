<?php

$app = new \Config\Routeparams();

// Controllers
//users
$app->router->get('/apis/users', 'Users@index');
$app->router->post('/apis/users', 'Users@create');
$app->router->put('/apis/users/:id', 'Users@update');
$app->router->delete('/apis/users/:id', 'Users@delete');

//zones
$app->router->get('/apis/zones', 'Zones@index');
$app->router->get('/apis/zones/:id', 'Zones@getById');
$app->router->post('/apis/zones', 'Zones@create');
$app->router->put('/apis/zones/:id', 'Zones@update');
$app->router->delete('/apis/zones/:id', 'Zones@delete');

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

$app->router->get('/registro', function () {
    $front = new \Config\View();
    return $front->show('auth.register');
});


$app->run();
