<?php

include('./Conection/conection.php');

date_default_timezone_set('America/Lima');

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$created_at = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

$sql = "insert into leeds (nombre, correo, created_at, ip) values('$nombre', '$correo', '$created_at', '$ip')";

if ($conection->query($sql) === TRUE) {
  echo json_encode([
    "success" => true,
    "message" => "Leed insertado correctamente"
  ]);
} else {
  echo json_encode([
    "success" => false,
    "message" => "Error: " . $sql . "<br>" . $conection->error
  ]);
}

$conection->close();

