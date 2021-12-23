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
$app->router->get('/apis/planes_financiamientos/:id?/:all?', 'Financing@paginator');
$app->router->post('/apis/planes_financiamientos/:id', 'Financing@getById');
$app->router->post('/apis/planes_financiamientos', 'Financing@create');
$app->router->put('/apis/planes_financiamientos/:id', 'Financing@update');
$app->router->delete('/apis/planes_financiamientos/:id', 'Financing@delete');

//SOCIAL
$app->router->get('/apis/estrato_social/:id?/:all?', 'Social@paginator');
$app->router->post('/apis/estrato_social/:id', 'Social@getById');
$app->router->post('/apis/estrato_social', 'Social@create');
$app->router->put('/apis/estrato_social/:id', 'Social@update');
$app->router->delete('/apis/estrato_social/:id', 'Social@delete');

//COMPANY
$app->router->get('/apis/empresas/:id?/:all?', 'Company@paginator');
$app->router->post('/apis/empresas/:id', 'Company@getById');
$app->router->post('/apis/empresas', 'Company@create');
$app->router->put('/apis/empresas/:id', 'Company@update');
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

//CONTRACT
$app->router->get('/apis/contratos/:id?/:all?', 'Contract@paginator');
$app->router->post('/apis/contratos/:id', 'Contract@getById');
$app->router->post('/apis/contratos', 'Contract@create');
$app->router->put('/apis/contratos/:id', 'Contract@update');
$app->router->delete('/apis/contratos/:id', 'Contract@delete');

//APPLE
$app->router->get('/apis/manzanas/:id?/:all?', 'Apple@paginator');
$app->router->post('/apis/manzanas/:id', 'Apple@getById');
$app->router->post('/apis/manzanas', 'Apple@create');
$app->router->put('/apis/manzanas/:id', 'Apple@update');
$app->router->delete('/apis/manzanas/:id', 'Apple@delete');

//ACCESS
$app->router->get('/apis/permisos/:id?/:all?', 'Access@paginator');
$app->router->get('/apis/permisosrol/:id', 'Access@getByIdRole');
$app->router->post('/apis/permisos', 'Access@create');
$app->router->put('/apis/permisos/:id', 'Access@update');
$app->router->delete('/apis/permisos/:id', 'Access@delete');

//Nationality
$app->router->get('/apis/nacionalidadesall', 'Nationality@getAll');
$app->router->get('/apis/nacionalidades/:id?/:all?', 'Nationality@paginator');
$app->router->post('/apis/nacionalidades/:id','Nationality@getById'); 
$app->router->post('/apis/nacionalidades', 'Nationality@create');
$app->router->put('/apis/nacionalidades/:id', 'Nationality@update');
$app->router->delete('/apis/nacionalidades/:id', 'Nationality@delete');

//Client
$app->router->get('/apis/clientes/:id?/:all?', 'Client@paginator');
$app->router->post('/apis/clientes/:id','Client@getById'); 
$app->router->post('/apis/clientes', 'Client@create');
$app->router->put('/apis/clientes/:id', 'Client@update');
$app->router->delete('/apis/clientes/:id', 'Client@delete');

//Material
$app->router->get('/apis/tipomaterial/:id?/:all?', 'Material@paginator');
$app->router->post('/apis/tipomaterial/:id','Material@getById'); 
$app->router->post('/apis/tipomaterial', 'Material@create');
$app->router->put('/apis/tipomaterial/:id', 'Material@update');
$app->router->delete('/apis/tipomaterial/:id', 'Material@delete');


//TypeDoc
$app->router->get('/apis/tipodocumentoidentidad', 'TypeDoc@getAll');

//Districts
$app->router->get('/apis/distritosall', 'Districts@getAll');
$app->router->get('/apis/distritos/:id?/:all?', 'Districts@paginator');
$app->router->post('/apis/distritos/:id','Districts@getById'); 
$app->router->post('/apis/distritos', 'Districts@create');
$app->router->put('/apis/distritos/:id', 'Districts@update');
$app->router->delete('/apis/distritos/:id', 'Districts@delete');

//Type_Installation
$app->router->get('/apis/tipoinstalacion/:id?/:all?', 'Installation@paginator');
$app->router->post('/apis/tipoinstalacion/:id','Installation@getById'); 
$app->router->post('/apis/tipoinstalacion', 'Installation@create');
$app->router->put('/apis/tipoinstalacion/:id', 'Installation@update');
$app->router->delete('/apis/tipoinstalacion/:id', 'Installation@delete');

//Type_Cabinet
$app->router->get('/apis/tipogabinete/:id?/:all?', 'Cabinet@paginator');
$app->router->post('/apis/tipogabinete/:id','Cabinet@getById'); 
$app->router->post('/apis/tipogabinete', 'Cabinet@create');
$app->router->put('/apis/tipogabinete/:id', 'Cabinet@update');
$app->router->delete('/apis/tipogabinete/:id', 'Cabinet@delete');

//Type_Project
$app->router->get('/apis/tipoproyecto/:id?/:all?', 'TypeProject@paginator');
$app->router->post('/apis/tipoproyecto/:id','TypeProject@getById'); 
$app->router->post('/apis/tipoproyecto', 'TypeProject@create');
$app->router->put('/apis/tipoproyecto/:id', 'TypeProject@update');
$app->router->delete('/apis/tipoproyecto/:id', 'TypeProject@delete');

//Estates_Acometida
$app->router->get('/apis/estadosacometida/:id?/:all?', 'EstatesAcometida@paginator');
$app->router->post('/apis/estadosacometida/:id','EstatesAcometida@getById'); 
$app->router->post('/apis/estadosacometida', 'EstatesAcometida@create');
$app->router->put('/apis/estadosacometida/:id', 'EstatesAcometida@update');
$app->router->delete('/apis/estadosacometida/:id', 'EstatesAcometida@delete');

//Category_Project
$app->router->get('/apis/categoriaprojecto/:id?/:all?', 'CategoryProject@paginator');
$app->router->post('/apis/categoriaprojecto/:id','CategoryProject@getById'); 
$app->router->post('/apis/categoriaprojecto', 'CategoryProject@create');
$app->router->put('/apis/categoriaprojecto/:id', 'CategoryProject@update');
$app->router->delete('/apis/categoriaprojecto/:id', 'CategoryProject@delete');

//Type_Acometida
$app->router->get('/apis/tiposacometida/:id?/:all?', 'TypeAcometida@paginator');
$app->router->post('/apis/tiposacometida/:id','TypeAcometida@getById'); 
$app->router->post('/apis/tiposacometida', 'TypeAcometida@create');
$app->router->put('/apis/tiposacometida/:id', 'TypeAcometida@update');
$app->router->delete('/apis/tiposacometida/:id', 'TypeAcometida@delete');

//Predios
$app->router->get('/apis/predios/:id?/:all?', 'Predios@paginator');
$app->router->post('/apis/predios/:id','Predios@getById'); 
$app->router->post('/apis/predios', 'Predios@create');
$app->router->put('/apis/predios/:id', 'Predios@update');
$app->router->delete('/apis/predios/:id', 'Predios@delete');

//Category_tarifaria
$app->router->get('/apis/categoriatarifaria/:id?/:all?', 'CategoryFare@paginator');
$app->router->post('/apis/categoriatarifaria/:id','CategoryFare@getById'); 
$app->router->post('/apis/categoriatarifaria', 'CategoryFare@create');
$app->router->put('/apis/categoriatarifaria/:id', 'CategoryFare@update');








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

$app->router->get('/empresas', function () {
    $front = new \Config\View();
    return $front->show('empresas.empresas');
});

$app->router->get('/mallas', function () {
    $front = new \Config\View();
    return $front->show('mallas.mallas');
});

$app->router->get('/proyectos', function () {
    $front = new \Config\View();
    return $front->show('proyectos.proyectos');
});

$app->router->get('/estrato_social', function () {
    $front = new \Config\View();
    return $front->show('estrato_social.estrato_social');
});

$app->router->get('/planes_financiamientos', function () {
    $front = new \Config\View();
    return $front->show('planes_financiamientos.planes_financiamientos');
});

$app->router->get('/contratos', function () {
    $front = new \Config\View();
    return $front->show('contratos.contratos');
});

$app->router->get('/manzanas', function () {
    $front = new \Config\View();
    return $front->show('manzanas.manzanas');
});

$app->router->get('/distritos', function () {
    $front = new \Config\View();
    return $front->show('distritos.distritos');
});

$app->router->get('/clientes', function () {
    $front = new \Config\View();
    return $front->show('clientes.clientes');
});

$app->run();
