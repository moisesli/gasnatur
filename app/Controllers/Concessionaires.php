<?php
namespace App\Controllers;

use Config\Controller;
use App\Models\concessionaire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Concessionaires extends Controller{

    public $concessionaire;

    public function __construct()
  {
    $this->concessionaire = $this->loadModel('Concessionaire');
  }

  public function create(Request $request)
  {


    $data = $request->toArray();

    return "Concesionaria creada correctamente: " . $this->concessionaire->create($data);
  }

  public function index()
  {
    return $this->concessionaire->getAll();
  }

  public function update(Request $request, $id){
    $data = $request->toArray();
      return $this->concessionaire->update($data, $id);
  }

  public function delete($id)
  {

    return "Eliminado correctamente: " . $this->concessionaire->delete($id);
  }

}