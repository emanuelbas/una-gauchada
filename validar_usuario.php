<?php
	//datos de conexion
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gauchada";
	//creo la conexion
	$conn = mysql_connect($servername,$username,$password);
	mysql_select_db($dbname,$conn);
	
	$email = $_POST['email'];
	$pw = $_POST['pw'];
	
	$sql = "SELECT email,name,last_name,IsAdministrador FROM usuario WHERE email = '$email' AND password = '$pw'";
	$comprobar = mysql_query($sql, $conn);
	
	if((mysql_num_rows($comprobar)) > 0){ //significa que el usuario existe y tiene bien la clave
		
		//me guardo un arreglo con email,nombre y apellido
		$fila = mysql_fetch_array($sql, MYSQL_NUM);
		
		session_start();
		$_SESSION["email"]=$fila[0];
		$_SESSION["name"]=$fila[1];
		$_SESSION["last_name"]=$fila[2];
		$_SESSION["IsAdministador"]=$fila[3];
		
		//Muestra en pantalla mensaje de exito y un link para continuar
		echo "¡Bienvenido ".$fila[1]."!";
		echo '<br /><a href="index.html">Continuar</a>';
	}else{}//Caso que el usuario o clave esten mal
		
	mysqli_close($conexion);
?>