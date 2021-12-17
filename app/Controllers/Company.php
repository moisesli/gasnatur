<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\CompanyModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Company extends Controller
{
    public $company;

    public function __construct()
    {
        $this->company = $this->loadModel('Company');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            if ($this->company->findByComparatorRegister($data['nombre_comercial'],$data['ruc'])) { 
				throw new \Exception("La empresa ya existe, por favor ingresar una nuevo nombre comercial o nuevo ruc");
			  }

            $this->validaciones($request, $response);

            $result = $this->company->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getById(Response $response, $id)
	{

		$result = $this->company->findById($id);

		return $this->resjson($result);
	}

    public function update(Request $request, Response $response, $id)
    {
        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            $result = $this->company->update($data, $id);

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
                throw new \Exception("No existe el id de la empresa");
            }

            $result = $this->company->delete($id);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 200);
    }

    public function paginator($id = 1, $q = "")
    {
        return $this->company->paginator($id, $q);
    }


    private function validaciones(Request $request, Response $response)
    {
        $data = $request->toArray();

        if (count($data) == 0) {
            throw new \Exception("No existe parámetros");
        }

        if ($data['ruc'] == "") {
            throw new \Exception("Ingrese el numero de ruc");
        }

        if (!preg_match('/^[0-9]{11}$/', $data['ruc'])) {
            throw new \Exception("El numero de ruc no está completo, solo se permiten 11 numeros");
        }

        if ($data['razon_social'] == "") {
            throw new \Exception("Ingrese la razon social");
        }

        
		if (!(preg_match('/^[a-zA-Z ,.]+$/', $data['razon_social']))) {
			throw new \Exception("Se permiten solo letras");
		}

        
		if (!(preg_match('/^[a-zA-Z ,.&]+$/', $data['nombre_comercial']))) {
			throw new \Exception("Se permiten solo letras");
		}


        if ($data['direccion'] == "") {
            throw new \Exception("Ingrese la direccion");
        }

        if (!preg_match('/^[#.0-9a-zA-Z\s,-]+$/', $data['direccion'])) {
            throw new \Exception("Por favor escribir la dirección correctamente");
        }

        if ($data['anexo'] == "") {
            throw new \Exception("Ingrese el anexo");
        }

        if (!preg_match('/^[0-9, -]{1,5}$/', $data['anexo'])) {
            throw new \Exception("Por favor escribir el anexo correctamente, ej. 52-04");
        }

        if ($data['estado'] == "") {
            throw new \Exception("Seleccione el estado del usuario");
        }

        if (!(preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $data['correo']))) {
            throw new \Exception("Ingrese correctamente el correo");
        }
    }
}
