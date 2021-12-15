<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\Zone;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Zones extends Controller
{

	public $zone;

	public function __construct()
	{
		$this->zone = $this->loadModel('Zone');
	}

    public function test(Request $request,Response $response)
    {
        $data = $request->toArray(); // recibe datos
        $this->zone->create($data);
        return $this->resjson($data);
    }

	public function create(Request $request,Response $response)
	{

		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();


			if ($this->zone->findByComparatorRegister($data['nombre'])) { 
				throw new \Exception("La zona ya existe, por favor ingresar una nueva zona");
			  }

			if (count($data) == 0) {
				throw new \Exception("No existe parametros");
			}

			if ($data['nombre'] == "") {
				throw new \Exception("Ingrese el nombre de la zona");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado de la zona");
			}

			$data['nombre'] = strtolower($data['nombre']);

			$result = $this->zone->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
	}

	public function getAll(Response $response)
	{
		$results = $this->zone->getAll();
		return $this->resjson($results);
	}

	public function getById(Response $response, $id)
	{

		$result = $this->zone->findById($id);

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
			if ($data['nombre'] == "") {
				throw new \Exception("Ingrese el nombre de la zona");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado de la zona");
			}

			if (!(preg_match('/^[a-zA-Z0-9]+$/', $data['nombre']))) {
				throw new \Exception("Se permiten solo letras y numeros");
			  }

			$result = $this->zone->update($data, $id);

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

			$result = $this->zone->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

	public function paginator($id = 1, $q = "" )
	{
		return $this->zone->paginator($id, $q);
	}



}
