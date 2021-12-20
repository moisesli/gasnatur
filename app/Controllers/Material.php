<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\MaterialModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Material extends Controller
{
    public $material;

    public function __construct()
    {
        $this->material = $this->loadModel('Material');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($this->material->findByComparatorRegister($data['descripcion'])) {
                throw new \Exception("El registro ya existe, por favor ingresar una nuevo registro");
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

            $data['descripcion'] = strtoupper($data['descripcion']);

            $data['estado'] = strtoupper($data['estado']);

            $result = $this->material->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
    {

        $result = $this->material->findById($id);

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
                throw new \Exception("No existe el id del tipo de material");
            }
            if ($data['descripcion'] == "") {
                throw new \Exception("Ingrese la descripcion del tipo del material");
            }
            if ($data['estado'] == "") {
                throw new \Exception("Seleccione el estado");
            }

            if (!(preg_match('/^[a-zA-Z0-9 ]+$/', $data['descripcion']))) {
                throw new \Exception("Se permiten solo letras y numeros");
            }

            $data['descripcion'] = strtoupper($data['descripcion']);

            $data['estado'] = strtoupper($data['estado']);

            $result = $this->material->update($data, $id);

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
				throw new \Exception("No existe el id del tipo de material");
			}

			$result = $this->material->delete($id);

			[$statusOk, $messageError] = array_values((array)$result);
		} catch (\Exception $e) {
			$messageError = $e->getMessage();
		}

		return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
	}

    public function paginator($id = 1, $q = "" )
	{
		return $this->material->paginator($id, $q);
	}
}
