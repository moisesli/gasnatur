<?php

namespace App\Controllers;

use Config\View;

class Auth extends View
{

  public function login()
  {
    return $this->show('index');
  }
}