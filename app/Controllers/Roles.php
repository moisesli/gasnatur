<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\RoleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Roles extends Controller
{
    public $role;

    public function __construct()
    {
        $this->role = $this->loadModel('Role');
    }

    public function create(Request $request)
    {
        $data = $request->toArray();
        return "Creado correctamente: " . $this->role->create($data);
    }

    public function index()
  {
    return $this->role->getAll();
  }

  public function update(Request $request, $id)
  {
    $data = $request->toArray();
    return $this->role->update($data, $id);
  }

  public function delete($id)
  {

    return "Eliminado correctamente: " . $this->role->delete($id);
  }
}
