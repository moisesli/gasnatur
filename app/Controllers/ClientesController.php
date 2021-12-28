<?php

namespace App\Controllers;

use Config\Controller;
use Config\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientesController extends Controller
{

    public function index()
    {
        $pdo = new Model();
        $pdo->setSelect(" * ")->setFrom("tipo_proyecto");
        return $pdo->setPaginator();
    }




    public function edit()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}