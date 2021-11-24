<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Config\Model;

class User extends Eloquent
{

  protected $fillable = [
    'name', 'email', 'password','userimage'
  ];

  protected $hidden = [
    'password', 'remember_token',
  ];

  public function index()
  {
    return 'user model de eloquent';
  }

  public function todo()
  {
    return $this->hasMany('Todo');
  }

  public function __construct()
  {
    new Model();
  }
}