<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gauchada";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {die("Fallo de conexion: " . $conn->connect_error);} 
?>