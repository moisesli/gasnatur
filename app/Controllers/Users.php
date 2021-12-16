<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\User;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Users extends Controller
{
  public $user;

  public function __construct()
  {
    $this->user = $this->loadModel('User');
    session_start();
  }

  public function create(Request $request, Response $response)
  {
    $statusOk = false;
    $messageError = "";

    try {
      $data = $request->toArray();

      if ($this->user->findByComparatorRegister($data['usuario'])) {
        throw new \Exception("El usuario ya existe, por favor ingresar un usuario nuevo");
      }

      $this->validaciones($request, $response);

      $data['usuario'] = strtolower($data['usuario']);

      date_default_timezone_set('America/Lima');
      $data['fecha_registro'] = Date('y-m-d H:m:s');

      $result = $this->user->create($data);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
  }


  public function getAll(Response $response)
  {
    $results = $this->user->getAll();
    return $this->resjson($results);
  }

  public function getById(Response $response, $id)
  {

    $result = $this->user->findById($id);

    return $this->resjson($result);
  }

  public function update(Request $request, Response $response, $id)
  {
    $statusOk = false;
    $messageError = "";

    try {

      $data = $request->toArray();

      if (count($data) == 0) {
        throw new \Exception("No existe parámetros");
      }

      if ($id <= 0 | $id == "") {
        throw new \Exception("No existe el id del usuario");
      }

      $this->validaciones($request, $response);

      $result = $this->user->update($data, $id);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
  }

  public function delete(Request $request, Response $response, $id)
  {
    $statusOk = false;
    $messageError = "";

    try {

      if ($id <= 0 | $id == "") {
        throw new \Exception("No existe el id del usuario");
      }

      $result = $this->user->delete($id);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
  }

  private function validaciones(Request $request, Response $response)
  {
    $data = $request->toArray();

    if (count($data) == 0) {
      throw new \Exception("No existe parámetros");
    }

    if ($data['usuario'] == "") {
      throw new \Exception("Ingrese el nombre de usuario");
    }

    if ($data['clave'] == "") {
      throw new \Exception("Ingrese password");
    }

    if (!(preg_match('/^[a-zA-Z0-9]+$/', $data['usuario']))) {
      throw new \Exception("Se permiten solo letras y numeros");
    }

    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $data['clave'])) {
      throw new \Exception("El password no cumple con los requerimientos mínimos");
    }

    if (array_key_exists("usuario", $data) == null) {
      throw new \Exception("Username sin valor");
    }

    if (array_key_exists("clave", $data) == null) {
      throw new \Exception("Password sin valor");
    }

    // if(empty($data['id_personal'])){
    //   throw new \Exception("El id del personal está vacío");
    // }

    if ($data['id_personal'] == "" | $data['id_personal'] <= 0 | !is_int($data['id_personal'])) {
      throw new \Exception("El id del personal no es válido");
    }

    if ($data['id_role'] == "" | $data['id_role'] <= 0 | !is_int($data['id_role']) | $data['id_role'] == null) {
      throw new \Exception("El id del rol no es válido");
    }

    if ($data['estado'] == "") {
      throw new \Exception("Seleccione el estado del usuario");
    }
  }

  public function paginator($id = 1, $q = "")
  {
    return $this->user->paginator($id, $q);
  }

  public function login(Request $request, Response $response)
  {
    $data = $request->toArray();

    if (count($data) == 0) {
      throw new \Exception("No existe parámetros");
    }

    if ($data['usuario'] == "") {
      throw new \Exception("Ingrese el nombre de usuario");
    }

    if ($data['clave'] == "") {
      throw new \Exception("Ingrese password");
    }

    if (array_key_exists("usuario", $data) == null) {
      throw new \Exception("Username sin valor");
    }

    if (array_key_exists("clave", $data) == null) {
      throw new \Exception("Password sin valor");
    }

    $token = $this->user->login($data['usuario'], $data['clave']);

    if( $token !="")
     {
        $_SESSION[$data['usuario']] = $token;
        return $token;
    }
    else{
      return "usuario y/o password inválido";
    }

  }
}
