<?php

$app = new \Config\Routeparams();

//$app->router->get('/', 'Home@index');

// Controllers
$app->router->get('/users', 'Users@index');

$app->router->get('/about', function () {
    return 'About Page';
});





// **************** ROUTES FRONT ************************


// Auth
$app->router->get('/', 'front.AuthController@login');



$app->run();



