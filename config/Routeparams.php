<?php

namespace Config;
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Routeparams{

  public $router;

  public function __construct()
  {
    $this->router = new Router([
      'paths' => [
        'controllers' => 'app/Controllers',
        'middlewares' => 'app/Middlewares'   
      ],
      'namespaces' => [
        'controllers' => 'App\Controllers',
        'middlewares' => 'App\Middlewares'   
      ]
    ]);

  }

  public function run()
  {
      $this->router->run();
  }

}