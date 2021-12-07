<?php

namespace App\Controllers\front;

use Config\View;

class AuthController extends View
{
  public function login()
  {
    return $this->show('auth.login');

  }
}