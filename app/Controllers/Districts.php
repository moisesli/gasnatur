<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\DistrictModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Districts extends Controller
{
	public $district;

	public function __construct()
	{
		$this->district = $this->loadModel('District');
	}

	public function create(Request $request, Response $response)
	{
		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();
			if ($this->district->findByComparatorRegister($data['descripcion'])) {
				throw new \Exception("El registro ya existe, por favor ingresar una nuevo registro");
			}

			if (count($data) == 0) {
				throw new \Exception("No existe parámetros");
			}

			if ($data['id_provincia'] == "") {
				throw new \Exception("Ingrese la provincia");
			}

            $data['descripcion'] = strtolower($data['descripcion']);

			$result = $this->district->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
	}

	public function getById(Response $response, $id)
	{

		$result = $this->district->findById($id);

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
				throw new \Exception("No existe el id");
			}

			if ($data['descripcion'] == "") {
				throw new \Exception("Ingrese la descripcion");
			}

			$result = $this->district->update($data, $id);

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
				throw new \Exception("No existe el id");
			}

			$result = $this->district->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function getAll(Response $response)
	{
		$results = $this->district->getAll();
		return $this->resjson($results);
	}

	public function paginator($id = 1, $q = "" )
	{
		return $this->district->paginator($id, $q);
	}

}