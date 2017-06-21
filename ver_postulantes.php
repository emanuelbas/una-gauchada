<?php
	include 'head.php';
	include 'conectar.php';

	$sql = "SELECT * FROM postulaciones INNER JOIN usuarios ON postulaciones.email=usuarios.email INNER JOIN publicaciones ON publicaciones.id=postulaciones.id_gauchada WHERE postulaciones.id_gauchada =".$_POST['id'];
	$res = mysqli_query($conn,$sql);
	echo "<h2> Lista de postulados </h2><table>";
	echo "<tr><th>Usuario</th><th>Reputacion</th><th>Estado de postulacion</th></tr>";
	while ($fila = mysqli_fetch_array($res,MYSQLI_BOTH)) 

		if ($fila['selected']=='') {
			//Tengo que crear un boton seleccionar que manda por post "id" de la gauchada y "email" para insertarlos
			$boton = '<form method ="post" action ="pick_postulante.php"><input type="hidden" name="id" value="'.$fila['id'].'" /><input type="hidden" name="email" value="'.$fila['email'].'" /><INPUT type="submit" value="Seleccionar"></form>';
			echo "<tr><td>".$fila['email']."</td><td>".$fila['reputation']."</td><td>"."$boton"."</td></tr>";
		}			
		else 
			if ($fila['selected']<>$fila['email'])echo "<tr><td>".$fila['email']."</td><td>".$fila['reputation']."</td><td>"."No seleccionado"."</td></tr>";
				else
					echo "<tr><td>".$fila['email']."</td><td>".$fila['reputation']."</td><td>"."Elegido"."</td></tr>";
	
	$conn->close();	
?>