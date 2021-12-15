<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\ChargeModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Charges extends Controller
{
    public $charge;

    public function __construct()
    {
        $this->charge = $this->loadModel('Charge');
    }

    public function create(Request $request, Response $response)
	{
		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();
			if ($this->charge->findByComparatorRegister($data['nombre'])) {
				throw new \Exception("El cargo ya existe, por favor ingresar una nuevo cargo");
			  }

			if (count($data) == 0) {
				throw new \Exception("No existe parámetros");
			}

			if ($data['nombre'] == "") {
				throw new \Exception("Ingrese el nombre del cargo");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado del cargo");
			}

			$result = $this->charge->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
	}

    public function getAll(Response $response)
	{
		$results = $this->charge->getAll();
		return $this->resjson($results);
	}

    public function getById(Response $response, $id)
	{

		$result = $this->charge->findById($id);

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
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado del cargo");
			}

			$result = $this->charge->update($data, $id);

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

			$result = $this->charge->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

	public function paginator($id =  1, $q = "")
	{
		return $this->charge->paginator($id, $q);
	}
}
