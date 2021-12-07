<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\Zone;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Zones extends Controller
{

	public $zone;

	public function __construct()
	{
		$this->zone = $this->loadModel('Zone');
	}

	public function create(Request $request)
	{


		$data = $request->toArray();

		return "Creado correctamente: " . $this->zone->create($data);
	}

	public function index()
	{
	  return $this->zone->getAll();
	}

	public function update(Request $request, $id)
    {
        $data = $request->toArray();
        return $this->zone->update($data, $id);
    }

	public function delete($id)
	{
  
	  return "Eliminado correctamente: " . $this->zone->delete($id);
	}
}
