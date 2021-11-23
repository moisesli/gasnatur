<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$conect = new Capsule;
$conect->addConnection([
  "driver" => "mysql",
  "host" => "54.89.83.220",
  "database" => "demo",
  "username" => "root",
  "password" => "moiseslinar3s"

]);
?>