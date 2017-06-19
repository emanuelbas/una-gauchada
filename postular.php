<?php
	include("conectar.php");
	session_start();
	$idgauchada = $_POST['id'];
	$email=$_SESSION['email']; 
	$query = "INSERT INTO postulaciones (`id_gauchada`,`email`) values ('$idgauchada','$email')";
	echo $query;
	if ($conn->query($query)){
		$conn->close(); 
		header('Location: index.php');

	} else echo "error";

	
	
	
?>	