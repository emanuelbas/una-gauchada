<?php 

include "conectar.php";
$name = $_POST['name'];
$score = $_POST['score'];

$sql = "SELECT * FROM reputaciones WHERE name='".$_GET['name']."'";
$res = $conn -> query($sql);
$row = $res -> fetch_array();

$old_name = $row['name'];
$old_score = $row['score'];

if ($score <= 0) header('Location: alta_reputacion_pantalla.php?editar='.$name.'&error=No pueden asignarse reputaciones con puntaje 0 o numeros negativos');

else {

	//caso en que el name ya exista y no sea el old
	if ($name <> $old_name){
		$sql = "SELECT * FROM reputaciones WHERE name='".$name."'";
		$res = $conn -> query($sql);
		$con = $res->num_rows;
		if ($con > 0) header('Location: alta_reputacion_pantalla.php?editar='.$name.'&error=El nombre ya existe');
		else $nombre_ok = 1;
	} else $nombre_ok = 1;

	if ($score <> $old_score) {
		$sql = "SELECT * FROM reputaciones WHERE score=".$score;
		$res = $conn -> query($sql);
		$con = $res->num_rows;
		if ($con > 0) header('Location: alta_reputacion_pantalla.php?editar='.$name.'&error=El rango ya existe');
		else $score_ok = 1;
	} else $score_ok = 1;


	if($score_ok AND $nombre_ok) {

		$sql = "UPDATE reputaciones SET name='".$name."', score=".$score." WHERE name='".$_GET['name']."'";
		$conn -> query($sql);
		include "recalcular_reputaciones.php";
		header('Location: alta_reputacion_pantalla.php');
	}

	include "recalcular_reputaciones.php";
		

} 

?>