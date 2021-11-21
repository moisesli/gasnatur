<?php

namespace Config;

use Buki\Router\Router;

class Routeparams{

  public $router;
  public $view;
  

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

    $this->view = new View();
  }

  public function run()
  {
      $this->router->run();
  }

}