<?php
	include 'head.php';
	include 'conectar.php';
	
	//Controlo que se hayan llenado todos los campos
	if (($_POST['email']!='')&&($_POST['name']!='')&&($_POST['last_name']!='')&&($_POST['bdate']!='')&&($_POST['password1']!='')&&($_POST['password2']!='')&&($_POST['phone']!='')) {
		//Traigo los datos con post
		$email = $_POST['email']; 
		$name=$_POST['name']; 
		$last_name=$_POST['last_name'];
		$bdate=$_POST['bdate'];
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		$phone=$_POST['phone'];
				
		//Controlo que el usuario haya confirmado bien la clave
		if ($password1 == $password2) {
			//Controlo que el email ingresado sea nuevo		
			$sql = $conn->query("SELECT email FROM usuarios WHERE email = '$email'");
			if ($sql->num_rows == 0){
				
				//Inserto el nuevo usuario
				$sql = "INSERT INTO usuarios (email, name, last_name, IsAdministrador, credit, password, reputation, score, phone)
					VALUES ('$email', '$name','$last_name',0,0,'$password1','Observador',0,'$phone')";
				/*echo "<pre>";
				print_r($sql);
				echo"</pre>";*/
				if ($conn->query($sql)){
					echo "<div class = 'Det-post-article'><h2> Datos registrados:</h2> ";
					echo "<b>Nombre:</b> ".$name."<br>";
					echo "<b>Apellido: </b>".$last_name."<br>";
					echo "<b>Email: </b>".$email."<br>";
					echo "<b>Telefono</b>: ".$phone."<br></div>";
					echo '<br /><a href="index.php">Continuar</a>';
				}
			}
				else{
					echo '<div align="center"><h2><img src="images/gaucho.jpg" width="15%">El email ya existe</h2>';
					echo '<a href="iniciar_sesion.php">Enviame un email con mi clave</a><div>';
				}
					
		} else {echo '<div align="center"><h2><img src="images/gaucho.jpg" width="15%">Las contraseñas no coinciden</h2>';
				echo '<br /><a href="ventana_crear_cuenta.php">Volver a intentarlo</a>';
				echo '<br /><a href="index.php">Enviame un email con mi clave</a></div>';
				}
				
	} else {echo '<br /><a href="ventana_crear_cuenta.php">Debe completar todos los campos</a>';}
		


	$conn->close(); 
	//header('Location: index.php');
	

?>
