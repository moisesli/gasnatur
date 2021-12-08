<?php

namespace Config;

class Controller extends Routeparams
{
  public function __construct()
  {

  }

  public function resjson($data = [], $status = 200, array $headers = [], $options = 0){
    $statusMessage = self::$statusTexts[$status] ?? 'unknown status';
    header("HTTP/1.1 $status $statusMessage");
    header("Content-Type:application/json");
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
  }

  public function loadModel($fileName)
  {
    $path = './app/Models/' . ($fileName) . 'Model.php';

    if (file_exists($path)) {
      require_once './app/Models/' . ($fileName) . 'Model.php';

      $modelName = $fileName . 'Model';
      //$objModel = App\Models\UserModel;
      $objModel = new $modelName();
      return $objModel;
    }
  }

}