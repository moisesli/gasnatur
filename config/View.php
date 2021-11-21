<?php

namespace Config;

use Jenssegers\Blade\Blade;

class View
{
  public static function show($view, $data)
  {
    $blade = new Blade(dirname(__DIR__).'/views','../../../tmp');
    return $blade->render($view, $data);
  }
}