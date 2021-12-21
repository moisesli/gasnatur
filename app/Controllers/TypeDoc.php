<?php

namespace App\Controllers;

use Config\Controller;
use App\Models\TypeDocModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeDoc extends Controller
{
	public $typeDoc;

	public function __construct()
	{
		$this->typeDoc = $this->loadModel('TypeDoc');
	}



public function getAll(Response $response)
	{
		$results = $this->typeDoc->getAll();
		return $this->resjson($results);
	}

}