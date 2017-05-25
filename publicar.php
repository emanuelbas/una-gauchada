<?php
	include("conectar.php");
	session_start(); 
	
	$user=$_SESSION['email'];	
	//hago la consulta para ver si puede publicar
	//consulto si adeuda calificar usuarios
	$sql = "SELECT owner,selected_calification FROM publicaciones WHERE owner='$user' AND selected_calification='pendiente'"; 
	$comprobar = mysqli_query($conn, $sql);

		
	if (mysqli_num_rows($comprobar)==0){ 
		//consulto para saber si tiene credito
		echo $user;
		$sql= "SELECT * FROM usuarios WHERE credit>0 AND email='$user'"; 
		$comprobar = mysqli_query($conn,$sql); 
				
		if(mysqli_num_rows($comprobar)>0){
			//Como se que tiene credito voy a descontarselo
			$query= "UPDATE usuarios SET credit = credit - 1 WHERE email='$user'";	
			if ($conn->query($query)){
				//Inicio variables que voy a guardar
				$limit_date=$_POST['limit_date']; //tiene problema
				$site=$_POST['site']; //tiene problema
				$category=$_POST['cat'];//tiene problema
				$title=$_POST['titulo'];
				$text=$_POST['body'];
				date_default_timezone_set('America/Argentina/Buenos_Aires');
				$date = date('m/d/Y h:i:s a', time());
				
				if (($_FILES['image']['tmp_name']) != "") {
					//Si se leyo una imagen la almaceno en la BD
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //Use este video https://www.youtube.com/watch?v=K9YW1sWJuR4
					$query= "INSERT INTO publicaciones(publication_date,owner,selected,selected_coment,selected_calification,limit_date,body,site,title,image,category)
					VALUES('$date','$user','','','pendiente','$limit_date','$text','$site','$title','$image','$category')";
				} else { 
					//Si no se leyo entonces guardo solo guardo los demas datos
					$query= "INSERT INTO publicaciones(publication_date,owner,selected,selected_coment,selected_calification,limit_date,body,site,title,category)
					VALUES('$date','$user','','','pendiente','$limit_date','$text','$site','$title','$category')";
					
					}
			} else {
				echo "Error al conectar con la base de datos";
			}
		
		

		} else{
			echo 'No posee creditos suficientes para realizar la publicacion';
			echo '<br /><a href="comprar_creditos.html">Comprar creditos</a>'.' '.'<br /><a href="index.php">Volver al sitio</a>';
		}
	}
	else{
		echo 'Adeuda calificar usuarios';
		echo '<br /><a href="">Ver mis gauchadas(todavia no disponible)</a>'.' '.'<br /><a href="index.php">Volver al sitio</a>';
	}
	
	mysqli_close($conn);
?>
