<?php

	//datos de conexion
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gauchada";
	//creo la conexion
	$conn = new mysqli($servername, $username, $password, $dbname);
	//reviso que conecte
	if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
	
	//Voy a usar estas variables la de mail es temporal hasta tener iniciar sesion luego reemplazarla por
	session_start();
	$email = $_SESSION['email'];
	//$email = "unemail@hotmail.com";
	$amount=$_POST['amount']; 
	$card=$_POST['card'];
	$password=$_POST['password'];
	
	//esto es para especificar la fecha
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	

	//Registro la compra
	$sql = "INSERT INTO compras (email, date, price, amount)
			VALUES ('$email', CURRENT_DATE(), '$amount', '$amount')";
			
	if ($conn->query($sql) === TRUE) {
		echo "¡Se registro el pago!";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	//Sumo al contador de creditos
	$sql = "UPDATE usuarios SET credit = credit + $amount WHERE email = '$email'";
	if ($conn->query($sql) === TRUE) {
		echo '<br>¡Se ha añadido el dinero a su cuenta';
		echo '<br /><a href="index_user.html">Continuar</a>';
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$conn->close(); 
?>
