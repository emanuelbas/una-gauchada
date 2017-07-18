<?php

	//Para usar este php debes llamarlo usando include "recalcular_reputaciones.php"; en tu archivo y se actualizara las reputaciones de cada uno de los usuario

	include "conectar.php";
	$sql = "SELECT * FROM reputaciones WHERE 1 ORDER BY score";
	$res_reputaciones = $conn -> query($sql);

	//Al principio es -1 y tengo que actualizar todos los usuarios que tengan repu negativa
	$reputacion = $res_reputaciones -> fetch_array();
	//echo "A los que tengan negativo les voy a poner".$reputacion['name'];
	$sql = "UPDATE usuarios SET reputation='".$reputacion['name']."' WHERE score<0";
	$conn -> query($sql);

	//Ahora con 0
	$reputacion = $res_reputaciones -> fetch_array();
	//echo "<br>A los que tengan 0 les voy a poner".$reputacion['name'];
	$sql = "UPDATE usuarios SET reputation='".$reputacion['name']."' WHERE score=0";
	$conn -> query($sql);

	//Ahora para todas las reputaciones mayores a 0
	$ant = 0;
	while ($reputacion = $res_reputaciones -> fetch_array()){
		$act=$reputacion['score'];
		$name = $reputacion['name'];
		//echo "<br>A los que tengan entre (".$ant."+1) y ".$act." les voy a poner ".$name;
		$sql = "UPDATE usuarios SET reputation='".$name."' WHERE score BETWEEN ".$ant."+1 AND ".$act;
		$conn -> query($sql);
		$ant=$act;
	}

	//Ahora tengo en $act y $name el ultimo valor leido , todos los superiores deben llevar el $name
	//echo "<br>A los que tengan mas de ".$act." les voy a poner ".$name;
	$sql = "UPDATE usuarios SET reputation='".$name."' WHERE score>".$act;
	$conn -> query($sql);

	$conn -> close();
?>