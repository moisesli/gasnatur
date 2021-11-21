<?php
	

// conexion
$conn = new mysqli(
    'serverless-lineysoft.cluster-caeiyn2btsoe.us-east-1.rds.amazonaws.com',
    'moises',
    'moiseslinar3s',
    'lineysoft',
		3306);

if ($conn->connect_error) {
    echo "No se pudo conectar a la Base de Datos";
    exit;
}

?>