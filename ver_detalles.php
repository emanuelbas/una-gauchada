<html>
<?php include 'head.php';?>
<body>
<?php
	include 'conectar.php';
	$id= $_GET['id'];
	$sql="SELECT * FROM publicaciones WHERE id='$id'";
	$cons=mysqli_query($conn,$sql);
	if(!$cons){
		
		echo'No se pudo encontrar la publicacion' . mysqli_error();
		exit;
	}
	$fila=mysqli_fetch_array($cons,MYSQLI_ASSOC);
	
?>

	<div class = "det-post">
		<div class = "det-post-image">

			<?php 
			if($fila['image']=='')
			{ 
				echo "<img class= 'post-image' src=images/logo.png>"; 
			}
			else 
			{
				echo "<img src='data:image/jpg;base64,".base64_encode($fila['image'])."'/>";
			}

			?>
		</div>
		<div class = "det-post-article" >
			<?php 
				echo '<h2>' .$fila['title'].'</h2>';
				echo '<p><b>Autor</b>: ' .$fila['owner'].'</p>';
				echo '<p>' .$fila['body'].'</p>';
				echo '<p> <b>Fecha limite:</b> ' .$fila['limit_date'].'</p>';
				echo '<p><b>Lugar</b>: ' .$fila['site'].'</p>';
				echo '<p> <b>Categoria:</b> ' .$fila['category'].'</p>';
				if (isset($_SESSION['email'])){
					echo '<a href="ver_mis_gauchadas.php">ver todas mis gauchadas</a>&nbsp;&nbsp;';
					echo '<a href="ver_mis_postulaciones.php">ver mis postulaciones</a>&nbsp;&nbsp;';
				}
				echo '<a href="index.php">volver al menu</a>&nbsp;&nbsp;';
				//El siguiente if es un boton para postularse
				if ((isset($_SESSION['email']))){
					//Aca voy a comprobar si estoy postulado
					$query = "SELECT * FROM postulaciones WHERE `id_gauchada` = ".$fila["id"]." AND `email` = '".$_SESSION['email']."'";
					$res = mysqli_query($conn,$query);

					if( mysqli_num_rows($res) < 1){
						if (!($fila['selected'] <> '')){
							if ($fila['owner'] <> $_SESSION['email']) {
								echo '<form method ="post" action ="postular.php">';
								echo '<input type="hidden" name="id" value="'.$fila['id'].'" />';
								echo '<INPUT type="submit" value="Postularme">';
								echo '</form>';
							} //else echo "<a href='ver_postulantes.php'>Ver postulados</a>";
						} //else  echo "Ya hay un seleccionado";
					} //else echo "Ya esta postulado";
									//El siguiente if es un boton para ver y seleccionar postulantes
					if ($_SESSION['email'] == $fila['owner']){
						echo '<form method ="post" action ="ver_postulantes.php">';
						echo '<input type="hidden" name="id" value="'.$fila['id'].'" />';
						echo '<INPUT type="submit" value="Ver postulados">';
						echo '</form>';

						if (!($fila['selected'] == '') AND ($fila['selected_calification'] == 'pendiente')){ //Si hay algun seleccionado muestro un boton para calificarlo
							echo '<form method ="post" action ="calificar_postulante.php">';
							echo '<input type="hidden" name="email" value="'.$fila['selected'].'" />';
							echo '<input type="hidden" name="id" value="'.$fila['id'].'" />';
							echo '<INPUT type="submit" value="Calificar a '.$fila['selected'].'">';
							echo '</form>';
						}

					}
				} else echo "<a href='iniciar_sesion.php'>Inicia sesion para mas opciones</a>";


			?>

		</div>	
	</div>

</body>

</html>