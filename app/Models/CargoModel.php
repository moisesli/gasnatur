<?php

//namespace App\Models;

use Config\Model;

class CargoModel extends Model
{

  public function __construct()
  {
      parent::__construct();
  }
  public function list(){
      $result = $this->db->findAll("select * from cargos");
      return $result;
  }
  public function CreateCargo($data){
      $response = new \stdClass;
      $response->success = false;

      try{
          $sth = $this->db->insert('cargos',$data);
          // validacion
          if ($sth) {
              $response->success = true;
              $response->message = "Registrado correctamente";
          }else{
              $response->message = "No se pudo registrar, vuelva a intentarlo";
          }
      } catch (\Exception $e){
          $response->message = $e->getMessage();
      }
      return $response;
      //return true;
  }
}