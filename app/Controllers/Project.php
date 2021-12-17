<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\ProjectModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Project extends Controller
{
    public $project;

    public function __construct()
    {
        $this->project = $this->loadModel('Project');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            $this->validaciones($request, $response);

            if ($this->project->findByComparatorRegister($data['nombre'])){
            	throw new \Exception("El proyecto ya existe, por favor ingresar un nuevo proyecto");
            }

            date_default_timezone_set('America/Lima');
            $data['fecha_registro'] = Date('y-m-d H:m:s');

            $result = $this->project->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
  {

    $result = $this->project->findById($id);

    return $this->resjson($result);
  }

  public function update(Request $request, Response $response, $id)
	{
		$statusOk = false;
		$messageError = "";

		try {

			$data = $request->toArray();

			// $this->validaciones($request, $response);

			$result = $this->project->update($data, $id);

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

			$result = $this->project->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "")
	{
		return $this->project->paginator($id, $q);
	}

    private function validaciones(Request $request, Response $response)
	{

		$data = $request->toArray();

		if (count($data) == 0) {
			throw new \Exception("No existe parametros");
		}

		if ($data['nombre'] == "") {
			throw new \Exception("Ingrese el nombre del proyecto");
		}

        if ($data['fecha_inicio'] == "") {
			throw new \Exception("Ingrese fecha de inicio del proyecto");
		}

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $data['fecha_inicio'])) {
            throw new \Exception("El formato de fecha no es correcto, ej. aaaa-mm-dd");
        }

		if ($data['numero_inicial'] == "") {
			throw new \Exception("Ingrese el numero inicial");
		}

        if (!preg_match('/^[0-9]{11}$/', $data['numero_inicial'])) {
            throw new \Exception("Ingrese correctamente el número que cumpla con los parámetros, maximo 11 numeros");
        }

        if ($data['numero_final'] == "") {
			throw new \Exception("Ingrese el numero final");
		}

        if (!preg_match('/^[0-9]{11}$/', $data['numero_final'])) {
            throw new \Exception("Ingrese correctamente el número que cumpla con los parámetros, maximo 11 numeros");
        }

		if ($data['estado'] == "") {
			throw new \Exception("Seleccione el estado");
		}
	}
}
