<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Users extends Controller
{
  public $user;

  public function __construct()
  {
    $this->user = $this->loadModel('User');
  }

  public function create(Request $request)
  {

    try{
        $data = $request->toArray();

        if (array_key_exists("username",$data) == null || $data["username"] =='' 
          || array_key_exists("password",$data) == null || $data["password"] ==''
          )
          return http_response_code(400);
          //throw new Exception("Username sin valor");
      
        //return "Creado correctamente: " . $this->user->create($data);

        if ($this->user->create($data))
          return http_response_code(201);
    
      } catch (\Exception $e) {
        return http_response_code(500);
    }
  }


  public function index()
  {
    return $this->user->getAll();
  }

  public function getById( $id){

  	return $this->user->findById($id);
  }

  public function update(Request $request, $id)
  {
    $data = $request->toArray();
    return $this->user->update($data, $id);
  }

  public function delete($id)
  {

    return "Eliminado correctamente: " . $this->user->delete($id);
  }
}
