<?php

namespace App\Controllers;

use Config\Controller;

class Auth extends Controller
{
    public function index()
    {
        return $this->view('auth/register');
    }
    public function login()
		{
			return $this->view('auth/login');
		}
}