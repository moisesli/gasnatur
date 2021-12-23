<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\ClientModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Client extends controller
{
  public $client;

  public function __construct()
  {
    $this->client = $this->loadModel('Client');
    session_start();
  }

  public function create(Request $request, Response $response)
  {
    $statusOk = false;
    $messageError = "";

    try {
      $data = $request->toArray();

      if ($this->client->findByComparatorRegister($data['numero'])) {
        throw new \Exception("El registro ya existe, por favor ingresar un nuevo registro");
      }

      $this->validaciones($request, $response);

      //   $data['usuario'] = strtolower($data['usuario']);

      date_default_timezone_set('America/Lima');
      $data['fecha_registro'] = Date('y-m-d H:m:s');

      $result = $this->client->create($data);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
  }

  public function getById(Response $response, $id)
  {

    $result = $this->client->findById($id);

    return $this->resjson($result);
  }

  public function update(Request $request, Response $response, $id)
  {
    $statusOk = false;
    $messageError = "";

    try {

      $data = $request->toArray();

      $this->validaciones($request, $response);

      $result = $this->client->update($data, $id);

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
        throw new \Exception("No existe el id del cliente");
      }

      $result = $this->client->delete($id);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
  }

  public function paginator($id = 1, $q = "")
  {
    return $this->client->paginator($id, $q);
  }

  private function validaciones(Request $request, Response $response)
  {

    $data = $request->toArray();

    if (count($data) == 0) {
      throw new \Exception("No existe parametros");
    }

    if ($data['numero'] == "") {
      throw new \Exception("Ingrese numero");
    }

    if (!preg_match('/^[0-9]{8,11}$/', $data['numero'])) {
      throw new \Exception("El numero del documento de identidad no es correcto");
    }

    if ($data['nombres'] == "") {
      throw new \Exception("Ingrese el nombre del personal");
    }

    if (!(preg_match('/^[a-zA-Z ]+$/', $data['nombres']))) {
      throw new \Exception("Se permiten solo letras");
    }

    if ($data['estado_civil'] == "") {
      throw new \Exception("Seleccione su estado civil");
    }

    if ($data['direccion'] == "") {
      throw new \Exception("Ingrese la direccion");
    }

    if (!preg_match('/^[#.0-9a-zA-Z\s,-]+$/', $data['direccion'])) {
      throw new \Exception("Por favor escribir la dirección correctamente");
    }

    if ($data['recibo_digital'] == "") {
      throw new \Exception("Seleccione Sí o No");
    }

    if ($data['estado'] == "") {
      throw new \Exception("Seleccione el estado");
    }
  }
}
