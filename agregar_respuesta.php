<?php

	//tabla pregunta id_publication 	body 	answer 	user 	date 
	include "conectar.php";
	$id =$_POST['id'];
	$body =$_POST['body'];
	$sql = "UPDATE preguntas SET answer = '$body' WHERE id = $id";
	$conn -> query($sql);
	header('Location: index.php');
	mysqli_close($conn);
?>