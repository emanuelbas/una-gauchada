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
	//$email = $_SESSION['email'];
	$email = "unemail";
	$amount=$_POST['amount']; 
	$card=$_POST['card'];
	$password=$_POST['password'];
	
	//esto es para especificar la fecha
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	

	//Un comando registra la compra y el otro actualiza los creditos del usuario
	$sql = "INSERT INTO compras (email, date, price, amount)
			VALUES ('$email', CURRENT_DATE(), '$amount', '$amount')";
	$sql = "UPDATE usuarios SET credit = credit + $amount WHERE email = '$email'";

	
	if ($conn->query($sql) === TRUE) {
		echo "¡Se registro el pago!";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close(); 
	header('Location: index.html');
	

?>
