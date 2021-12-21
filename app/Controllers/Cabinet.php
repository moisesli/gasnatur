<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\CabinetModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Cabinet extends Controller
{
    public $cabinet;

    public function __construct()
    {
        $this->cabinet = $this->loadModel('Cabinet');
    }

    public function create(Request $request, Response $response)
  {

    $statusOk = false;
    $messageError = "";

    try {

      $data = $request->toArray();

      if ($data['descripcion'] == "") {
        throw new \Exception("Ingrese la descripcion del gabinete");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
        throw new \Exception("Se permiten solo letras");
      }

      if (count($data) == 0) {
        throw new \Exception("No existe parametros");
      }

      $data['descripcion'] = strtolower($data['descripcion']);

      $result = $this->cabinet->create($data);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
  }

  public function getById(Response $response, $id)
  {

    $result = $this->cabinet->findById($id);

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
        throw new \Exception("No existe el id del gabinete");
      }

      if ($data['descripcion'] == "") {
        throw new \Exception("Ingrese la descripcion del gabinete");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
        throw new \Exception("Se permiten solo letras");
      }

      $result = $this->cabinet->update($data, $id);

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
				throw new \Exception("No existe el id del gabinete");
			}

			$result = $this->cabinet->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "")
  {
    return $this->cabinet->paginator($id, $q);
  }


}
