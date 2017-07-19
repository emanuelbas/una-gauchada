<?php
	include "conectar.php";
	session_start();
	if ($_SESSION['IsAdministador']) $conn -> query("UPDATE categorias SET available=0 WHERE name='".$_GET['name']."'");
	header('Location: ventana_categorias.php');
?>