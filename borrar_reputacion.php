<?php

include "conectar.php";
$name = $_GET['name'];
$sql = "DELETE FROM reputaciones WHERE name='".$name."'";
$conn -> query($sql);
include "recalcular_reputaciones.php";
$conn -> close();
header('Location: alta_reputacion_pantalla.php');

?>