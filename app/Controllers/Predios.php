<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\PrediosModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Predios extends Controller
{
    public $predios;

    public function __construct()
    {
        $this->predios = $this->loadModel('Predios');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($data['id_cliente'] == "") {
                throw new \Exception("Ingrese el id del cliente");
            }
            if ($data['id_contrato'] == "") {
                throw new \Exception("Ingrese el id del contrato");
            }
            if ($data['id_ubigeo'] == "") {
                throw new \Exception("Ingrese el codigo de ubigeo del distrito");
            }

            if ($data['id_manzana'] == "") {
                throw new \Exception("Ingrese el id de la manzana");
            }

            $result = $this->predios->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
    {

        $result = $this->predios->findById($id);

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

            if ($data['id_cliente'] == "") {
                throw new \Exception("Ingrese el id del cliente");
            }
            if ($data['id_contrato'] == "") {
                throw new \Exception("Ingrese el id del contrato");
            }
            if ($data['id_ubigeo'] == "") {
                throw new \Exception("Ingrese el codigo de ubigeo del distrito");
            }
            if ($data['id_manzana'] == "") {
                throw new \Exception("Ingrese el id de la manzana");
            }

            $result = $this->predios->update($data, $id);

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

            $result = $this->predios->delete($id);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
    }

    public function paginator($id = 1, $q = "")
    {
        return $this->predios->paginator($id, $q);
    }


}