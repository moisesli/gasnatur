<?php

namespace App\Controllers;

use Config\Controller;
use Config\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientesController extends Controller
{
    public $pdo;
    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function index($page = 1, $q = '')
    {
        $this->pdo->setSelect("
           c.id,
           d.descripcion as id_tipodoc_nombre,
           n.descripcion as id_nacionalidad_nombre,
           c.fecha_registro,
           c.numero,
           c.nombres,
           c.fecha_nacimiento,
           c.estado_civil,
           c.direccion,
           c.telefono,
           c.celular,
           c.correo,
           c.recibo_digital,
           c.estado
        ")
        ->setFrom("
            clientes c
            INNER JOIN tipo_documentos_identidad d on d.id = c.id_tipodoc
            INNER JOIN nacionalidades n on n.id = c.id_nacionalidad
        ")->setWhere("where nombres LIKE '%$q%'")
        ->setOrderBy("order by c.id DESC")->setPage($page);
        return $this->pdo->setPaginator();
    }

    public function edit($id)
    {
        return $this->pdo->setSelect("*")->setFrom("clientes")->setEdit($id);
    }

    public function create()
    {

    }

    public function update(Request $request, Response $response,$id)
    {
        //print_r($request->toArray());
        $data = $request->toArray();
        return $this->pdo->fupdate('tipo_gabinete',$data,$id);
    }

    public function destroy()
    {

    }

}