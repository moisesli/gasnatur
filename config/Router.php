<?php

$app = new \Config\Routeparams();

$app->router->get('/', 'Home@index');

// Controllers
$app->router->get('/users', 'Users@index');


// Migrations
$app->router->controller('/migrations', 'Migrations');



$app->router->get('/about', function () {
    require './views/about.php';
    return 'About Page';
});

$app->router->get('/registro', 'Auth@index');
$app->router->get('/login', 'Auth@login');

$app->run();



