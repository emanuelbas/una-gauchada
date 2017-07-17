<?php
//Recibe un "email", "id","coment" de la gauchada y una "calification" y le setea al usuario email la calificacion
//neutral, positive o negative
include "conectar.php";
$sql = "UPDATE publicaciones SET selected_coment = '".$_POST['coment']."',selected_calification ='".$_POST['calification']."' WHERE id = ".$_POST['id'];
$conn -> query($sql);

//Ahora tengo que actualizar los creditos, la puntuación y la reputacion del usuario "email"
if ($_POST['calification'] <> 'neutral'){ //Si es neutral no debo tocar nada, pero si es diferente leo datos y pregunto si es positiva o negativa
	$sql = "SELECT * FROM usuarios WHERE email ='".$_POST['email']."'";
	$res = $conn -> query($sql);
	$datos = $res -> fetch_array();

	if ($_POST['calification'] == 'positive'){
		$datos['credit'] = $datos['credit'] + 1;
		$datos['score'] = $datos['score'] + 2;

	} else $datos['score'] = $datos['score'] - 2;

	$sql = "UPDATE usuarios SET credit =".$datos['credit'].", score = ".$datos['score']." WHERE email = '".$datos['email']."'";
	$conn -> query($sql);
	include "recalcular_reputaciones.php";

	

}
	

header('Location: index.php');

?>