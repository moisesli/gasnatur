<?php

namespace App\Controllers;

// use App\Middlewares\CheckAuth;
use Config\Controller;

class Home extends Controller{

    public function index(){
        return $this->view('index');
    }

}