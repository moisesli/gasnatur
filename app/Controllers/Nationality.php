<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\NationalityModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Nationality extends Controller
{
    public $nationality;

  public function __construct()
  {
    $this->nationality = $this->loadModel('Nationality');
  }

  public function getAll(Response $response)
	{
		$results = $this->nationality->getAll();
		return $this->resjson($results);
	}

  public function create(Request $request, Response $response)
  {

    $statusOk = false;
    $messageError = "";

    try {

      $data = $request->toArray();

      if ($this->nationality->findByComparatorRegister($data['descripcion'])) {
        throw new \Exception("El registro ya existe, por favor ingresar una nuevo registro");
      }

      if ($data['descripcion'] == "") {
        throw new \Exception("Ingrese la nacionalidad");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
        throw new \Exception("Se permiten solo letras");
      }

      if (count($data) == 0) {
        throw new \Exception("No existe parametros");
      }

      $data['descripcion'] = strtolower($data['descripcion']);

      $result = $this->nationality->create($data);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
  }

  public function getById(Response $response, $id)
  {

    $result = $this->nationality->findById($id);

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

      if ($id == "") {
        throw new \Exception("No existe el id de la zona");
      }
      if ($data['descripcion'] == "") {
        throw new \Exception("Ingrese el nombre del rol");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
        throw new \Exception("Se permiten solo letras");
      }

      $result = $this->nationality->update($data, $id);

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

          if ($id == "") {
              throw new \Exception("No existe el id de la zona");
          }

          $result = $this->nationality->delete($id);

          [$statusOk, $messageError] = array_values((array)$result);
      } catch (\Exception $e) {
          $messageError = $e->getMessage();
      }

      return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
  }

  public function paginator($id = 1, $q = "")
	{
		return $this->nationality->paginator($id, $q);
	}

}