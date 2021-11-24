<?php

namespace App\Controllers;
use Config\Controller;
use App\Models\User;

class Users extends Controller
{

  public function index()
  {
    $count = User::where('name', 'moises')->count();
    return $count;
  }
}