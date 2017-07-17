<?php

	//tabla pregunta id_publication 	body 	answer 	user 	date 
	include "conectar.php";
	$gauchada =$_POST['id'];
	$body =$_POST['body'];
	$user =$_POST['user'];
	$sql = "INSERT INTO preguntas (id_publication,body,user) VALUES ($gauchada,'$body','$user')";
	$conn -> query($sql);
	header('Location: index.php');
	mysqli_close($conn);

?>