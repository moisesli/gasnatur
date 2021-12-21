<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\TypeProjectModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeProject extends Controller
{
    public $typeproject;

    public function __construct()
    {
        $this->typeproject = $this->loadModel('Typeproject');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($data['descripcion'] == "") {
                throw new \Exception("Ingrese la descripcion del tipo de proyecto");
            }

            if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
                throw new \Exception("Se permiten solo letras");
            }

            if (count($data) == 0) {
                throw new \Exception("No existe parametros");
            }

            $data['descripcion'] = strtolower($data['descripcion']);

            $result = $this->typeproject->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
    {
  
      $result = $this->typeproject->findById($id);
  
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
          throw new \Exception("No existe el id del tipo de proyecto");
        }
  
        if ($data['descripcion'] == "") {
          throw new \Exception("Ingrese la descripcion del tipo de proyecto");
        }
  
        if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
          throw new \Exception("Se permiten solo letras");
        }
  
        $result = $this->typeproject->update($data, $id);
  
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
				throw new \Exception("No existe el id del tipo de proyecto");
			}

			$result = $this->typeproject->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "")
  {
    return $this->typeproject->paginator($id, $q);
  }
  
}
