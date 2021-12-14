<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\RoleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Roles extends Controller
{
  public $role;

  public function __construct()
  {
    $this->role = $this->loadModel('Role');
  }

  public function create(Request $request, Response $response)
  {

    $statusOk = false;
    $messageError = "";

    try {

      $data = $request->toArray();

      if ($this->role->findByComparatorRegister($data['nombre']) == 1) {
        throw new \Exception("El rol ya existe, por favor ingresar una nuevo rol");
      }

      if ($data['nombre'] == "") {
        throw new \Exception("Ingrese el nombre del rol");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['nombre']))) {
        throw new \Exception("Se permiten solo letras");
      }

      if (count($data) == 0) {
        throw new \Exception("No existe parametros");
      }

      $data['nombre'] = strtolower($data['nombre']);

      $result = $this->role->create($data);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
  }

  public function getAll(Response $response)
  {
    $results = $this->role->getAll();
    return $this->resjson($results);
  }

  public function getById(Response $response, $id)
  {

    $result = $this->role->findById($id);

    return $this->resjson($result);
  }

  // public function update(Request $request, $id)
  // {
  //   $data = $request->toArray();
  //   return $this->role->update($data, $id);
  // }

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
      if ($data['nombre'] == "") {
        throw new \Exception("Ingrese el nombre del rol");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['nombre']))) {
        throw new \Exception("Se permiten solo letras");
      }

      $result = $this->role->update($data, $id);

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

			$result = $this->role->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

  public function paginator($id = 1, $q = "")
	{
		return $this->role->paginator($id, $q);
	}
}
