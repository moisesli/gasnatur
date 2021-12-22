<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\CategoryFareModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryFare extends Controller
{
    public $categoryFare;

    public function __construct()
    {
        $this->categoryFare = $this->loadModel('CategoryFare');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            
            if (count($data) == 0) {
                throw new \Exception("No existe parametros");
            }

            if ($data['nombre'] == "") {
                throw new \Exception("Ingrese el tipo de gabinete");
            }

            if ($data['estado'] == "") {
                throw new \Exception("Seleccione el estado ");
            }

            $result = $this->categoryFare->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
    {

        $result = $this->categoryFare->findById($id);

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

            if ($data['nombre'] == "") {
                throw new \Exception("Ingrese el tipo de gabinete");
            }

            if ($data['estado'] == "") {
                throw new \Exception("Seleccione el estado ");
            }

            $result = $this->categoryFare->update($data, $id);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
    }

    public function paginator($id = 1, $q = "")
    {
        return $this->categoryFare->paginator($id, $q);
    }




}