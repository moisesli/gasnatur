<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\concessionaire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Concessionaires extends Controller
{

	public $concessionaire;

	public function __construct()
	{
		$this->concessionaire = $this->loadModel('Concessionaire');
	}



	public function create(Request $request, Response $response)
	{
		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();

			if ($this->concessionaire->findByComparatorRegister($data['descripcion']) == 1) {
				throw new \Exception("La concesionaria ya existe, por favor ingresar una nueva concesionaria");
			}
			if (count($data) == 0) {
				throw new \Exception("No existe parametros");
			}

			if ($data['descripcion'] == "") {
				throw new \Exception("Ingrese el nombre de la concesionarias");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado de la concesionarias");
			}

			$result = $this->concessionaire->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
	}

	public function getAll(Response $response)
	{
		$results = $this->concessionaire->getAll();
		return $this->resjson($results);
	}

	public function getById(Response $response, $id)
	{

		$result = $this->concessionaire->findById($id);

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
				throw new \Exception("No existe el id de la concesionaria");
			}

			if ($data['descripcion'] == "") {
				throw new \Exception("Ingrese el nombre de la concesionaria");
			}

			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado de la concesionaria");
			}

			$result = $this->concessionaire->update($data, $id);

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

			$result = $this->concessionaire->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

	public function paginator($id = 1, $q = "")
	{
		return $this->concessionaire->paginator($id, $q);
	}
}
