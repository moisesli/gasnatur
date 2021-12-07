<?php

namespace App\Controllers;
use Config\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class Users extends Controller
{
  public $user;

  public function __construct()
  {
      $this->user = $this->loadModel('User'); 
  }

  public function create(Request $request){

   
    $data = $request->toArray();
  
    return $this->user->CreateUser($data);
  }

  
  public function index()
  {
    return $this->user->list();
  }

  public function update(){

    return;
  }

  public function delete($id){

    return$this->user->delete($id);
  }
  
}