<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\FinancingModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Financing extends Controller
{
    public $financing;

	public function __construct()
	{
		$this->financing = $this->loadModel('Financing');
	}

	public function create(Request $request,Response $response)
	{

		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();
			
			if ($this->financing->findByComparatorRegister($data['descripcion'])) { 
				throw new \Exception("El plan ya existe, por favor ingresar una nuevo plan");
			  }

			if (count($data) == 0) {
				throw new \Exception("No existe parametros");
			}

			if ($data['descripcion'] == "") {
				throw new \Exception("Ingrese el nombre");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado");
			}

			if (!(preg_match('/^[a-zA-Z0-9 ]+$/', $data['descripcion']))) {
				throw new \Exception("Se permiten solo letras y numeros");
			  }

			$data['descripcion'] = strtolower($data['descripcion']);

			$result = $this->financing->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
	}

    public function getAll(Response $response)
	{
		$results = $this->financing->getAll();
		return $this->resjson($results);
	}

    public function getById(Response $response, $id)
	{

		$result = $this->financing->findById($id);

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
				throw new \Exception("Ingrese la descripcion del financiamiento");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado");
			}

			if (!(preg_match('/^[a-zA-Z0-9 ]+$/', $data['descripcion']))) {
				throw new \Exception("Se permiten solo letras y numeros");
			  }

			$result = $this->financing->update($data, $id);

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
				throw new \Exception("No existe el id del plan de financiamiento");
			}

			$result = $this->financing->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "" )
	{
		return $this->financing->paginator($id, $q);
	}

}
