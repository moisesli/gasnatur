<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\CategoryProjectModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryProject extends Controller
{
    public $categoryproject;

    public function __construct()
    {
        $this->categoryproject = $this->loadModel('CategoryProject');
    }

    public function create(Request $request, Response $response)
  {

    $statusOk = false;
    $messageError = "";

    try {

      $data = $request->toArray();

      if ($data['id_tipoproyecto'] == "") {
        throw new \Exception("Ingrese el id del tipo del proyecto");
      }

      if ($data['descripcion'] == "") {
        throw new \Exception("Ingrese la descripcion la categoria del proyecto");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
        throw new \Exception("Se permiten solo letras");
      }

      if (count($data) == 0) {
        throw new \Exception("No existe parametros");
      }

      $data['descripcion'] = strtolower($data['descripcion']);

      $result = $this->categoryproject->create($data);

      [$statusOk, $messageError] = array_values((array)$result);
    } catch (\Exception $e) {
      $messageError = $e->getMessage();
    }

    return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
  }

  public function getById(Response $response, $id)
  {

    $result = $this->categoryproject->findById($id);

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

      if ($data['id_tipoproyecto'] == "") {
        throw new \Exception("Ingrese el id del tipo del proyecto");
      }

      if ($id == "") {
        throw new \Exception("No existe el id de la categoria del proyecto");
      }


      if ($data['descripcion'] == "") {
        throw new \Exception("Ingrese la descripcion la categoria del proyecto");
      }

      if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
        throw new \Exception("Se permiten solo letras");
      }

      $result = $this->categoryproject->update($data, $id);

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
				throw new \Exception("No existe el id");
			}

			$result = $this->categoryproject->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "")
  {
    return $this->categoryproject->paginator($id, $q);
  }


}
