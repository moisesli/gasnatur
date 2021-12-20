<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\AppleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Apple extends Controller
{
    public $apple;

    public function __construct()
    {
        $this->apple = $this->loadModel('Apple');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($this->apple->findByComparatorRegister($data['numero'])) {
                throw new \Exception("Este registro ya existe, por favor ingresar un nuevo registro");
            }

            // $this->validaciones($request, $response );

            // $data['nombre'] = strtolower($data['nombre']);

            $result = $this->apple->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
	{

		$result = $this->apple->findById($id);

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

			$result = $this->apple->update($data, $id);

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

			$result = $this->apple->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "" )
	{
		return $this->apple->paginator($id, $q);
	}
}