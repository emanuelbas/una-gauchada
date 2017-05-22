<?php

	//datos de conexion
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gauchada";
	//creo la conexion
	$conn = new mysqli($servername, $username, $password, $dbname);
	//revizo que conecte
	if ($conn->connect_error) {die("Fallo de conexion: " . $conn->connect_error);} 
	
	//Traigo los datos con post
	$email = $_POST['email']; 
	$name=$_POST['name']; 
	$last_name=$_POST['last_name'];
	$bdate=$_POST['bdate'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$phone=$_POST['phone'];
	
	
	
	
	//Controlo que el usuario haya confirmado bien la clave
	
	//ACA FALTA CONTROLAR SI $bdate < CURRENT_DATE(), no se hacerlo
	if ($password1 == $password2) {
		//Controlo que el email ingresado sea nuevo		
		$sql = $conn->query("SELECT email FROM usuarios WHERE email = '$email'");
		if ($sql->num_rows == 0){
			
			//Inserto el nuevo usuario
			$sql = "INSERT INTO usuarios (email, name, last_name, IsAdministrador, credit, password, reputation, score)
				VALUES ('$email','$name','$last_name',0,0,'$password1',0,0)";
			
			echo "Datos registrados: "."<br>"."<br>";
			echo "Nombre: ".$name."<br>";
			echo "Apellido: ".$last_name."<br>";
			echo "Email: ".$email."<br>";
			echo "Telefono: ".$phone."<br>";
			echo '<br /><a href="index.html">Continuar</a>';
		}
			else{
		echo "El email ya existe";} 
				// Estaría bueno que le pregunte si quiere recibir un mail con su contraseña
	} else {echo "Las contraseñas no coinciden";}
	


	$conn->close(); 
	//header('Location: index.html');
	

?>
