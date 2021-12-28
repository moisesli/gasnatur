<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\TestModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function list()
    {
        $res = new TestModel();
        $res->setSelect(" * ")->setFrom("tipo_proyecto");
        return $res->getAll();
    }
}