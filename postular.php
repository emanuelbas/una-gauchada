<?php
	include("conectar.php");
	session_start();
	$idgauchada = $_POST['id'];
	$email=$_SESSION['email']; 
	$query = "INSERT INTO postulaciones (email,id_gauchada) values ('$email',$idgauchada)";
	echo $query;
	if ($conn->query($query)){
		$conn->close(); 
		header('Location: index.php');

	} else echo "Error: " . $query . "<br>" . $conn->error;;

?>	