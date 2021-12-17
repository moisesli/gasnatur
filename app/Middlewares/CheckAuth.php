<?php

namespace App\Middlewares;

use Buki\Router\Http\Middleware;
use Symfony\Component\HttpFoundation\Request;

class CheckAuth extends Middleware {

    public function handle(Request $request){


        $token = $request->cookies->get('token');

        if( $token != "")
        {
            return true;
        }else{
            return false;
        }
    

    }


}