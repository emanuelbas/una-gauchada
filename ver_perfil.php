<?php  
include 'head.php';
include'conectar.php';

$user = $_SESSION['email'];

$sql = "SELECT * FROM usuarios WHERE email='".$user."'";
$res = $conn -> query($sql);

if($fila =  $res -> fetch_array());{
	echo '<div align="left" style="border:1px solid #dbdbdb;padding:2% 1%; border-radius: 10px; 0 auto; width:35%;"><h2></h2>';
	echo '<p><b>Mi perfil</b></p>';
	echo '<p><b>Nombre</b>:'. $fila['name'].' </p>';
	echo '<p><b>Apellido</b>:'. $fila['last_name'].' </p>';
	echo '<p><b>Email</b>:'. $fila['email'].' </p>';
	echo '<p><b>Telefono</b>:'. $fila['phone'].' </p>';
	echo '<p><b>Creditos</b>:'. $fila['credit'].' </p>';
	echo '<p><b>Reputacion</b>:'. $fila['reputation'].' </p>';
	echo '<div><a href="modificar_perfil.php">Modificar perfil</a></div>';
	echo '<div><a href="ver_mis_gauchadas.php">Ver mis gauchadas</a></div>';
	echo '<div><a href="ver_mis_postulaciones.php">Ver mis postulaciones</a></div>';
	echo '<div><a href="ver_mis_calificaciones.php">Ver mis calificaciones</a></div>';
	echo '<div><a href="index.php">Volver a inicio</a></div>';

}
$conn -> close();
?>