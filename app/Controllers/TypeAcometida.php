<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\TypeAcometidaModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeAcometida extends Controller
{
    public $typeAcometida;

    public function __construct()
    {
        $this->typeAcometida = $this->loadModel('TypeAcometida');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($data['id_tipogabinete'] == "") {
                throw new \Exception("Ingrese el tipo de gabinete");
            }

            if ($data['descripcion'] == "") {
                throw new \Exception("Ingrese la descripcion del tipo de acometida");
            }

            if ($data['codigo'] == "") {
                throw new \Exception("Ingrese el codigo del tipo de acometida ");
            }


            if (!preg_match('/^[0-9]+$/', $data['codigo'])) {
                throw new \Exception(" Ingrese solo numeros");
            }

            if (!(preg_match('/^[a-zA-Z ]+$/', $data['descripcion']))) {
                throw new \Exception("Se permiten solo letras");
            }

            if (count($data) == 0) {
                throw new \Exception("No existe parametros");
            }

            $data['descripcion'] = strtolower($data['descripcion']);

            $result = $this->typeAcometida->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
    {

        $result = $this->typeAcometida->findById($id);

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
                throw new \Exception("No existe el id del tipo de acometida");
            }

            if ($data['descripcion'] == "") {
                throw new \Exception("Ingrese la descripcion del tipo de acometida");
            }


            if ($data['codigo'] == "") {
                throw new \Exception("Ingrese el codigo del tipo de acometida ");
            }

            if (!(preg_match('/[^a-zA-Z\s]+$/', $data['descripcion']))) {
                throw new \Exception("Se permiten solo letras");
            }

            $result = $this->typeAcometida->update($data, $id);

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
                throw new \Exception("No existe el id del gabinete");
            }

            $result = $this->typeAcometida->delete($id);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
    }

    public function paginator($id = 1, $q = "")
    {
        return $this->typeAcometida->paginator($id, $q);
    }

    public function getAll(Response $response)
	{
		$results = $this->typeAcometida->getAll();
		return $this->resjson($results);
	}
}
