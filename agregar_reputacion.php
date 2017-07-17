<?php 

include "conectar.php";
$name = $_POST['name'];
$score = $_POST['score'];

if ($score <= 0) header('Location: alta_reputacion_pantalla.php?error=No pueden asignarse reputaciones con puntaje 0 o numeros negativos');
else {
	$sql = "SELECT * FROM reputaciones WHERE name = '".$name."' OR score = ".$score;
	$res = $conn -> query($sql);
	$contador = $res->num_rows;
	if ($contador > 0) header('Location: alta_reputacion_pantalla.php?error=Debe ingresar una reputacion con un nombre y puntaje que no existan');
	else {
		//Caso en que agrega la repu
		$sql = "INSERT INTO reputaciones (name,score) VALUES ('".$name."',".$score.")";
		$conn -> query($sql);
		include "recalcular_reputaciones.php";
		header('Location: alta_reputacion_pantalla.php');
	}

	include "recalcular_reputaciones.php";
		

} 

?>