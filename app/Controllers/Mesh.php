<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\MeshModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Mesh extends Controller
{
    public $mesh;

    public function __construct()
    {
        $this->mesh = $this->loadModel('Mesh');
    }

    public function create(Request $request, Response $response)
	{
		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();
			if ($this->mesh->findByComparatorRegister($data['nombre'])) {
				throw new \Exception("El registro ya existe, por favor ingresar una nuevo registro");
			  }

			if (count($data) == 0) {
				throw new \Exception("No existe parámetros");
			}

			if ($data['nombre'] == "") {
				throw new \Exception("Ingrese el nombre del cargo");
			}

            $data['descripcion'] = strtolower($data['descripcion']);

			$result = $this->mesh->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
	}

    public function getById(Response $response, $id)
	{

		$result = $this->mesh->findById($id);

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
				throw new \Exception("No existe el id del cargo");
			}

			if ($data['nombre'] == "") {
				throw new \Exception("Ingrese el nombre del cargo");
			}

			$result = $this->mesh->update($data, $id);

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

			if ($id == null) {
				throw new \Exception("No existe el id del cargo");
			}

			$result = $this->mesh->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id =  1, $q = "")
	{
		return $this->mesh->paginator($id, $q);
	}

}