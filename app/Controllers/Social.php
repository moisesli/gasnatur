<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\SocialModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Social extends controller
{
    public $social;

    public function __construct()
    {
        $this->social = $this->loadModel('Social');
    }


    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($this->social->findByComparatorRegister($data['nombre'])) {
                throw new \Exception("La zona ya existe, por favor ingresar una nueva zona");
            }

            $this->validaciones($request, $response );

            $data['nombre'] = strtolower($data['nombre']);

            $result = $this->social->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    // public function getAll(Response $response)
	// {
	// 	$results = $this->social->getAll();
	// 	return $this->resjson($results);
	// }

    public function getById(Response $response, $id)
	{

		$result = $this->social->findById($id);

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
				throw new \Exception("Ingrese el nombre");
			}
			if ($data['numero'] == "") {
                throw new \Exception("Ingrese el numero");
            }

            if ($data['porc_devolucion'] == "") {
                throw new \Exception("Ingrese el porcentaje");
            }

			if (!(preg_match('/^[a-zA-Z ]+$/', $data['nombre']))) {
                throw new \Exception("Se permiten solo letras");
            }

			$result = $this->social->update($data, $id);

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
				throw new \Exception("No existe el id");
			}

			$result = $this->social->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "" )
	{
		return $this->social->paginator($id, $q);
	}

    private function validaciones(Request $request, Response $response)
	{

		$data = $request->toArray();

		if (count($data) == 0) {
			throw new \Exception("No existe parametros");
		}

		if (!(preg_match('/^[a-zA-Z ]+$/', $data['nombre']))) {
			throw new \Exception("Se permiten solo letras");
		}

        if (count($data) == 0) {
            throw new \Exception("No existe parametros");
        }

        if ($data['nombre'] == "") {
            throw new \Exception("Ingrese el nombre");
        }

        if ($data['numero'] == "") {
            throw new \Exception("Ingrese el numero");
        }

        if ($data['porc_devolucion'] == "") {
            throw new \Exception("Ingrese el porcentaje");
        }

        if (!is_int($data['numero'])) {
			throw new \Exception("Se permiten solo numeros");
		}

        // if (!(preg_match('/^[1-9]\d*(,\d+)?$/', $data['porc_devolucion']))) {
		// 	throw new \Exception("El formato no coincide");
		// }


	}
}
