<?php

namespace Config;

use Jenssegers\Blade\Blade;

class View
{

  public static function show($view, $data = [])
  {

    $getLocalServer = 'gasnatur';
    $myServer = $_SERVER['SERVER_NAME'];

    if(strpos($myServer, $getLocalServer) !== false){
      $blade = new Blade(dirname(__DIR__).'/views','./views/front/tmp');
    } else {
      $blade = new Blade(dirname(__DIR__) . '/views', '../../../tmp');
    }

    return $blade->render($view, $data);

  }
}