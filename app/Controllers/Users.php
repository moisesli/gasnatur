<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Users extends Controller
{
  public $user;

  public function __construct()
  {
    $this->user = $this->loadModel('User');
  }

  // public function getAll(Response $response)
  // {

  //   $results = $this->zones->getAll();

  //   return $response->json($results);
  // }

  // public function getById(Response $response, $id){

  // 	$result = $this->zones->findById($id);

  // 	return $response->json($result);
  // }

  public function create(Request $request)
  {


    $data = $request->toArray();

    return "Creado correctamente: " . $this->user->create($data);
  }


  public function index()
  {
    return $this->user->getAll();
  }

  // public function getById(Response $response, $id){
  //   $result = $this->user->findById($id);

  // 	return $response->json($result);
  // }

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
