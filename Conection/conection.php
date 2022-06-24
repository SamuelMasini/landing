<?php

//	$hostname="34.210.226.28";
//	$username="bees";
//	$password="Backus$$2022";
//	$dbname="bees";

	$hostname="localhost";
	$username="development";
	$password="Development$$2022";
	$dbname="lading_kelly";

/* 	$hostname="www.registro-bees.com:3306";
	$username="registr2_landing_bees_bd";
	$password="Backus$$2022";
	$dbname="registr2_landing_bees";
	*/
	
	$conection = mysqli_connect($hostname,$username, $password, $dbname); 

	if ($conection->connect_error) {
		die("Connection failed: " . $conection->connect_error);
	} 