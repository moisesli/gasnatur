<?php

$app = new \Config\Routeparams();

$app->router->get('/', 'Home@index');

// Controllers
$app->router->get('/users', 'Users@index');
$app->router->post('/users', 'Users@create');
$app->router->put('/users', 'Users@create');
$app->router->delete('/users/:id', 'Users@delete');




$app->router->get('/about', function () {
    return 'About Page';
});

$app->run();



