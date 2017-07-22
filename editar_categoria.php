<?php
	include "conectar.php";

	$old_name = $_GET['name'];
	$name = $_POST['name'];
	$sql = "SELECT * FROM categorias WHERE name='".$name."' AND available=1";

	$res = $conn -> query($sql);
	$con = $res -> num_rows;
	
	if ($con == 1){header('Location: ventana_categorias.php?msj=La categoria ya existe');}
	else {
		$sql = "SELECT * FROM categorias WHERE name='".$name."' AND available=0";
		$res = $conn -> query($sql);
		$con = $res -> num_rows;
		if ($con == 1){
			header('Location: ventana_categorias.php?msj=La categoria ya existe, se encuentra deshabilitada');
		} else {
			$sql = "UPDATE categorias SET available=1, name='".$name."' WHERE name='".$old_name."'";
			$conn -> query($sql);
			$sql = "UPDATE publicaciones SET category='".$name."' WHERE category='".$old_name."'";
			$conn -> query($sql);
			header('Location: ventana_categorias.php');
		}
	}

	$conn -> close();


?>
