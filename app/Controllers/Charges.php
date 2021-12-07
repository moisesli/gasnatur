<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\ChargeModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Charges extends Controller
{
    public $charge;

    public function __construct()
    {
        $this->charge = $this->loadModel('Charge');
    }

    public function create(Request $request)
    {


        $data = $request->toArray();

        return "Creado correctamente: " . $this->charge->create($data);
    }

    public function index()
    {
        return $this->charge->getAll();
    }

    public function update(Request $request, $id)
    {
        $data = $request->toArray();
        return $this->charge->update($data, $id);
    }

    public function delete($id)
    {
        return "Eliminado correctamente: " . $this->charge->delete($id);
    }
}
