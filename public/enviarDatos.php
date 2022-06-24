<?php
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
      // you want to allow, and if so:
      header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
      header('Access-Control-Allow-Credentials: true');
      header('Access-Control-Max-Age: 86400');    // cache for 1 day
  }
  
  // Access-Control headers are received during OPTIONS requests
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
          // may also be using PUT, PATCH, HEAD etc
          header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
      
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
          header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
  
      exit(0);
  }
  

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

