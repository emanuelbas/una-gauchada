<?php

	include 'conectar.php';

	
	$email = $_POST['email'];
	$pw = $_POST['pw'];
	
	$sql = "SELECT email,name,last_name,IsAdministrador FROM usuarios WHERE email = '$email' AND password = '$pw'";
	$comprobar = mysqli_query($conn,$sql);
	
	if((mysqli_num_rows($comprobar)) > 0){ //significa que el usuario existe y tiene bien la clave
		
		//me guardo un arreglo con email,nombre y apellido
		$fila = mysqli_fetch_array($comprobar, MYSQL_NUM);
		
		session_start();
		$_SESSION["email"]=$fila[0];
		$_SESSION["name"]=$fila[1];
		$_SESSION["last_name"]=$fila[2];
		$_SESSION["IsAdministador"]=$fila[3];
		//Muestra en pantalla mensaje de exito y un link para continuar
		echo "Bienvenido ".$fila[1]."!";
		echo '<br /><a href="index.php">Continuar</a>';
	}else{
		echo "La clave no coincide o la cuenta no existe";
		echo '<br /><a href="iniciar_sesion.html">Volver a intentar</a>';
	}//Caso que el usuario o clave esten mal
		
	mysqli_close($conn);
?>