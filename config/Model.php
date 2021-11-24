<?php

namespace Config;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
class Model
{

  public $capsule;

  public function __construct()
  {
    $this->capsule = new Capsule;

    $this->capsule->addConnection([
      'driver' => 'mysql',
      'host' => '54.89.83.220',
      'database' => 'demo',
      'username' => 'root',
      'password' => 'moiseslinar3s',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
    ]);
    $this->capsule->setEventDispatcher(new Dispatcher(new Container));

    // Make this Capsule instance available globally via static methods... (optional)
    $this->capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $this->capsule->bootEloquent();
  }
}