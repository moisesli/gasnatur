<?php

$app = new \Config\Routeparams();

//users
$app->router->post('/apis/login', 'Users@login');
$app->router->get('/apis/usuarios/:id?/:all?', 'Users@paginator');
$app->router->post('/apis/usuarios/:id','Users@getById'); 
$app->router->post('/apis/usuarios', 'Users@create');
$app->router->put('/apis/usuarios/:id', 'Users@update');
$app->router->delete('/apis/usuarios/:id', 'Users@delete');

//zones
$app->router->get('/apis/zonas/:id?/:all?', 'Zones@paginator', ['before' => 'CheckAuth']);
$app->router->post('/apis/zonas/:id', 'Zones@getById');
$app->router->post('/apis/zonas', 'Zones@create');
$app->router->put('/apis/zonas/:id', 'Zones@update');
$app->router->delete('/apis/zonas/:id', 'Zones@delete');


//charges
$app->router->get('/apis/cargos/:id?/:all?', 'Charges@paginator');
$app->router->post('/apis/cargos/:id', 'Charges@getById');
$app->router->post('/apis/cargos', 'Charges@create');
$app->router->put('/apis/cargos/:id', 'Charges@update');
$app->router->delete('/apis/cargos/:id', 'Charges@delete');

//concessionaires
$app->router->get('/apis/concesionarias/:id?/:all?', 'Concessionaires@paginator');
$app->router->post('/apis/concesionarias/:id', 'Concessionaires@getById');
$app->router->post('/apis/concesionarias', 'Concessionaires@create');
$app->router->put('/apis/concesionarias/:id', 'Concessionaires@update');
$app->router->delete('/apis/concesionarias/:id', 'Concessionaires@delete');

//roles
$app->router->get('/apis/roles/:id?/:all?', 'Roles@paginator');
$app->router->post('/apis/roles/:id','Roles@getById'); 
$app->router->post('/apis/roles', 'Roles@create');
$app->router->put('/apis/roles/:id', 'Roles@update');
$app->router->delete('/apis/roles/:id', 'Roles@delete');


//Personal
$app->router->get('/apis/personal/:id?/:all?', 'Personal@paginator');
$app->router->post('/apis/personal/:id','Personal@getById'); 
$app->router->post('/apis/personal', 'Personal@create');
$app->router->put('/apis/personal/:id', 'Personal@update');
$app->router->delete('/apis/personal/:id', 'Personal@delete');

//FINANCING PLANS
$app->router->get('/apis/planes_financiamiento/:id?/:all?', 'Financing@paginator');
$app->router->post('/apis/planes_financiamiento/:id', 'Financing@getById');
$app->router->post('/apis/planes_financiamiento', 'Financing@create');
$app->router->put('/apis/planes_financiamiento/:id', 'Financing@update');
$app->router->delete('/apis/planes_financiamiento/:id', 'Financing@delete');

//SOCIAL
$app->router->get('/apis/estrato_social/:id?/:all?', 'Social@paginator');
$app->router->post('/apis/estrato_social/:id', 'Social@getById');
$app->router->post('/apis/estrato_social', 'Social@create');
$app->router->put('/apis/estrato_social/:id', 'Social@update');
$app->router->delete('/apis/estrato_social/:id', 'Social@delete');

//COMPANY
$app->router->get('/apis/empresa/:id?/:all?', 'Company@paginator');
$app->router->post('/apis/empresa/:id', 'Company@getById');
$app->router->post('/apis/empresa', 'Company@create');
$app->router->put('/apis/empresa/:id', 'Company@update');
$app->router->delete('/apis/empresa/:id', 'Company@delete');

//PROJECT
$app->router->get('/apis/proyectos/:id?/:all?', 'Project@paginator');
$app->router->post('/apis/proyectos/:id', 'Project@getById');
$app->router->post('/apis/proyectos', 'Project@create');
$app->router->put('/apis/proyectos/:id', 'Project@update');
$app->router->delete('/apis/proyectos/:id', 'Project@delete');


//MESH
$app->router->get('/apis/mallas/:id?/:all?', 'Mesh@paginator');
$app->router->post('/apis/mallas/:id', 'Mesh@getById');
$app->router->post('/apis/mallas', 'Mesh@create');
$app->router->put('/apis/mallas/:id', 'Mesh@update');
$app->router->delete('/apis/mallas/:id', 'Mesh@delete');





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
});

$app->router->get('/personal', function () {
    $front = new \Config\View();
    return $front->show('personal.personal');
});

$app->router->get('/cargos', function () {
    $front = new \Config\View();
    return $front->show('cargos.cargos');
});

$app->router->get('/concesionarias', function () {
    $front = new \Config\View();
    return $front->show('concesionarias.concesionarias');
});

$app->router->get('/empresa', function () {
    $front = new \Config\View();
    return $front->show('empresa.empresa');
});

$app->router->get('/mallas', function () {
    $front = new \Config\View();
    return $front->show('mallas.mallas');
});

$app->run();
