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

	public function test(Request $request, Response $response)
	{
		$data = $request->toArray();
		$this->zone->create($data);
		return count($request->toArray());
	}

	public function create(Request $request, Response $response)
	{
		$statusOk = false;
		$messageError = "";

		try {

			if (count($request->json()->all()) == 0) {
				throw new \Exception("No existe parámetros");
			}

			$data = $request->json()->all();

			if ($data['nombre'] == "") {
				throw new \Exception("Ingrese el nombre de la zona");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado de la zona");
			}

			$result = $this->zone->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $response->json(["success" => $statusOk, "message" => $messageError], 201);
	}

	public function index(Response $response)
	{
		$results = $this->zone->getAll();
		return $this->resjson($results);
	}

	public function getById(Response $response, $id)
	{

		$result = $this->zone->findById($id);

		return $response->json($result);
	}

	public function update(Request $request, Response $response, $id)
	{
		$statusOk = false;
		$messageError = "";

		try {

			if (count($request->json()->all()) == 0) {
				throw new \Exception("No existe parámetros");
			}

			$data = $request->json()->all();

			if ($id == "") {
				throw new \Exception("No existe el id de la zona");
			}
			if ($data['nombre'] == "") {
				throw new \Exception("Ingrese el nombre de la zona");
			}
			if ($data['estado'] == "") {
				throw new \Exception("Seleccione el estado de la zona");
			}

			$result = $this->zone->update($data, $id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $response->json(["success" => $statusOk, "message" => $messageError], 200);
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

		return $response->json(["success" => $statusOk, "message" => $messageError], 200);
	}

	public function paginator($page, $q)
	{
		return $this->zone->paginator($page, $q);
	}
}
