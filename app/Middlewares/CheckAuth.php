<?php

namespace App\Middlewares;

use Buki\Router\Http\Middleware;
use App\Models\AccessModel;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;

class CheckAuth extends Middleware {

   

    public function handle(Request $request){
        $key = 'gas_natu_ral';

        $jwt = $request->cookies->get('jwt');

        $data = JWT::decode($jwt, $key, array('HS256')); 

        if( $jwt != "")
        {
            return true;
        }else{
            return false;
        }
    }
}