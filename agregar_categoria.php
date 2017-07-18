<?php
	
	include "conectar.php";

	$name = $_POST['name'];
	$sql = "SELECT * FROM categorias WHERE name='".$name."' AND available=1";

	$res = $conn -> query($sql);
	$con = $res -> num_rows;
	
	if ($con == 1){header('Location: ventana_categorias.php?msj=Solo pueden agregarse categorias que no existan');}
	else {
		$sql = "SELECT * FROM categorias WHERE name='".$name."' AND available=0";
		$res = $conn -> query($sql);
		$con = $res -> num_rows;
		if ($con == 1){
			$sql = "UPDATE categorias SET available=1 WHERE name='".$name."'";
			$conn -> query($sql);
			header('Location: ventana_categorias.php');
		} else {
			$sql = "INSERT INTO categorias (name,available) VALUES ('".$name."',1)";
			$conn -> query($sql);
			header('Location: ventana_categorias.php');
		}
	}

	$conn -> close();

?>


