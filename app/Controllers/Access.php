<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\AccessModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Access extends controller
{
    public $access;

    public function __construct()
    {
        $this->access = $this->loadModel('Access');
    }

    public function create(Request $request, Response $response)
    {

        $statusOk = false;
        $messageError = "";

        try {

            $data = $request->toArray();

            // if ($this->social->findByComparatorRegister($data['nombre'])) {
            //     throw new \Exception("Este registro ya existe, por favor ingresar un nuevo registro");
            // }

            // $this->validaciones($request, $response );

            // $data['nombre'] = strtolower($data['nombre']);

            $result = $this->access->create($data);

            [$statusOk, $messageError] = array_values((array)$result);
        } catch (\Exception $e) {
            $messageError = $e->getMessage();
        }

        return $this->resjson(["success" => $statusOk, "message" => $messageError], 201);
    }

    public function getByIdRole(Response $response, $idRole)
	{

		$result = $this->access->findByIdRole($idRole);

		return $this->resjson($result);
	}
}