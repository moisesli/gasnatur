<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\CommercialInformationModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommercialInformation extends Controller
{
    public $commercialInformation;

    public function __construct()
    {
        $this->commercialInformation = $this->loadModel('CommercialInformation');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if (count($data) == 0) {
                throw new \Exception("No existe parámetros");
            }

            if ($data['id_contrato'] == "") {
                throw new \Exception("Ingrese el id del contrato");
            }
            if ($data['id_tipoproyecto'] == "") {
                throw new \Exception("Ingrese el id del contrato");
            }
            if ($data['id_categtarifaria'] == "") {
                throw new \Exception("Ingrese el codigo de ubigeo del distrito");
            }

            date_default_timezone_set('America/Lima');
            $data['fecha_registro'] = Date('y-m-d H:m:s');

            $result = $this->commercialInformation->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
    {

        $result = $this->commercialInformation->findById($id);

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

            if ($data['id_contrato'] == "") {
                throw new \Exception("Ingrese el id del contrato");
            }
            if ($data['id_tipoproyecto'] == "") {
                throw new \Exception("Ingrese el id del contrato");
            }
            if ($data['id_categtarifaria'] == "") {
                throw new \Exception("Ingrese el codigo de ubigeo del distrito");
            }

            $result = $this->commercialInformation->update($data, $id);

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
          throw new \Exception("No existe el id de la zona");
        }
  
        $result = $this->commercialInformation->delete($id);
  
        [$statusOk, $messageError] = array_values((array)$result);
      } catch (\Exception $e) {
        $messageError = $e->getMessage();
      }
  
      return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
    }

    public function paginator($id = 1, $q = "")
    {
      return $this->commercialInformation->paginator($id, $q);
    }
}
