<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\DocumentModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Documents extends Controller
{
    public $document;

    public function __construct()
    {
        $this->document = $this->loadModel('Document');
    }

    public function create(Request $request)
    {
        $data = $request->toArray();
        return "Creado correctamente: " . $this->document->create($data);
    }

    public function index()
    {
        return $this->document->getAll();
    }

    public function update(Request $request, $id)
    {
        $data = $request->toArray();
        return $this->document->update($data, $id);
    }

    public function delete($id)
  {

    return "Rol eliminado correctamente " . $this->document->delete($id);
  }
}
