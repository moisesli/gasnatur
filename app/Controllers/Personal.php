<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\PersonalModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Personal extends Controller
{
	public $personal;

	public function __construct()
	{
		$this->personal = $this->loadModel('Personal');
	}

	public function create(Request $request, Response $response)
	{

		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();
			$this->validaciones($request, $response);

			if ($this->personal->findByComparatorRegister($data['numero'])){
				throw new \Exception("El personal ya existe, por favor ingresar un nuevo personal");
			}

			$result = $this->personal->create($data);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
	}

	public function getAll(Response $response)
	{
		$results = $this->personal->getAll();
		return $this->resjson($results);
	}

	public function getById(Response $response, $id)
	{

		$result = $this->personal->findById($id);

		return $this->resjson($result);
	}

	public function update(Request $request, Response $response, $id)
	{
		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();

			$this->validaciones($request, $response);

			$result = $this->personal->update($data, $id);

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
				throw new \Exception("No existe el id del personal");
			}

			$result = $this->personal->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

	private function validaciones(Request $request, Response $response)
	{

		$data = $request->toArray();

		if (count($data) == 0) {
			throw new \Exception("No existe parametros");
		}

		if ($data['numero'] == "") {
			throw new \Exception("Ingrese numero");
		}

		if (!preg_match('/^[0-9]{8}$/', $data['numero'])) {
            throw new \Exception("El numero de " .$data['id_tipodoc'] . " no es correcto");
        }

		if ($data['nombres'] == "") {
			throw new \Exception("Ingrese el nombre del personal");
		}

		if (!(preg_match('/^[a-zA-Z ]+$/', $data['nombres']))) {
			throw new \Exception("Se permiten solo letras");
		}

		if ($data['apellidos'] == "") {
			throw new \Exception("Ingrese el apellido del personal");
		}

		if (!(preg_match('/^[a-zA-Z ]+$/', $data['apellidos']))) {
			throw new \Exception("Se permiten solo letras");
		}

	
		if ($data['fecha_nacimiento'] == "") {
			throw new \Exception("Ingrese fecha de nacimiento");
		}

		if (!(preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $data['fecha_nacimiento']))) {
			throw new \Exception("Ingrese el formato correcto aaaa/mm/dd");
		}

		if ($data['sexo'] == "") {
			throw new \Exception("Seleccione su género");
		}

		if (!(preg_match('/^[F-M]{1}+$/', $data['sexo']))) {
			throw new \Exception("Solo escriba F o M según su género");
		}

		if (!preg_match('/^[#.0-9a-zA-Z\s,-]+$/', $data['direccion'])) {
			throw new \Exception("Solo se permiten numeros y letras");
		}

		if (!(preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $data['correo']))) {
			throw new \Exception("Ingrese correctamente el correo");
		}

		if ($data['estado'] == "") {
			throw new \Exception("Seleccione el estado");
		}
	}

	public function paginator($id = 1, $q = "")
	{
		return $this->personal->paginator($id, $q);
	}
}
