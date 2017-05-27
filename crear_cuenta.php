
    <head><title>Una gauchada</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<div style="position:relative">
			<img src="images/banner.png"  />
			<div style="position:absolute; top:300; left:580;">
				<img border="0"  src="images/logo.png" width="80" /></a>
			</div>
		</div>
		<link rel="stylesheet" href="css/index.css">
    </head>


<?php

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
				$sql = "INSERT INTO usuarios (email, name, last_name, IsAdministrador, credit, password, reputation, score)
					VALUES ('$email','$name','$last_name',0,0,'$password1',0,0)";
				if ($conn->query($sql)){
					echo "Datos registrados: "."<br>"."<br>";
					echo "Nombre: ".$name."<br>";
					echo "Apellido: ".$last_name."<br>";
					echo "Email: ".$email."<br>";
					echo "Telefono: ".$phone."<br>";
					echo '<br /><a href="index.php">Continuar</a>';
				}
			}
				else{
					echo '<br>El email ya existe';
					echo '<br /><a href="iniciar_sesion.html">Enviame un email con mi clave</a>';
				}
					
		} else {echo "<img src='http://wp.clicrbs.com.br/cacaumenezes/files/2013/01/GauchoTriste.jpg' width='200'><h3> Las contraseñas no coinciden</h3>";
				echo '<br /><a href="crear_cuenta.html">Volver a intentarlo</a>';
				echo '<a href="index.php">Enviame un email con mi clave</a>';
				}
				
	} else {echo '<br /><a href="crear_cuenta.html">Debe completar todos los campos</a>';}
		


	$conn->close(); 
	//header('Location: index.php');
	

?>
