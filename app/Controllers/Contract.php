<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\ContractModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Contract extends controller
{
    public $contract;

    public function __construct()
    {
        $this->contract = $this->loadModel('Contract');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($this->contract->findByComparatorRegister($data['numero'])) {
                throw new \Exception("El numero de contrato ya existe, por favor ingresar un nuevo registro");
            }

            $result = $this->contract->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
    {

        $result = $this->contract->findById($id);

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
            if ($data['numero'] == "") {
                throw new \Exception("Ingrese el numero de contrato");
            }

            if ($data['estado'] == "") {
                throw new \Exception("Seleccione el estado");
            }

            $result = $this->contract->update($data, $id);

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

            $result = $this->contract->delete($id);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
    }

    public function paginator($id = 1, $q = "")
    {
        return $this->contract->paginator($id, $q);
    }
}
