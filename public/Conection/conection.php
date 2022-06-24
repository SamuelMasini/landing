<?php

	//BASE DE DATOS LOCAL MARCO
/* 	$hostname="localhost";
	$username="development";
	$password="Development$$2022";
	$dbname="lading_kelly"; */

	//BASE DE DATOS PRODUCCION
	$hostname="www.registro-bees.com:3306";
	$username="registr2_landing_bees_bd";
	$password="Backus$$2022";
	$dbname="registr2_landing_enviamas";
	
	$conection = mysqli_connect($hostname,$username, $password, $dbname); 

	if ($conection->connect_error) {
		die("Connection failed: " . $conection->connect_error);
	} 