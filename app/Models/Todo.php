<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Config\Model;

class Todo extends Eloquent
{
  protected $fillable = ['todo','category','description'];
}