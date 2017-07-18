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
					$query = "SELECT * FROM postulaciones WHERE id_gauchada = ".$fila["id"]." AND email = '".$_SESSION['email']."'";
					$res = mysqli_query($conn,$query);
					//me va a dar todas las postulaciones pertenecientes a esta gauchada en las que soy el postulante
					if( mysqli_num_rows($res) == 0){ //No estoy postulado a esta gauchada
						if (!($fila['selected'] <> '')){
							if ($fila['owner'] <> $_SESSION['email']) {
								echo '<form method ="post" action ="postular.php">';
								echo '<input type="hidden" name="id" value="'.$fila['id'].'" />';
								echo '<INPUT type="submit" value="Postularme">';
								echo '</form>';
							} 
						} //else  echo "Ya hay un seleccionado";
					} //else echo "Ya esta postulado";
									//OPCIONES DE AUTOR
					if ($_SESSION['email'] == $fila['owner']){
						echo "<a href='eliminar_gauchada.php?id=".$fila['id']."'>Eliminar gauchada</a>&nbsp;&nbsp;";
						
						//Aca tengo que mostrar un boton para modificarla solo si no hay ningun postulado para $fila['id']
						$con = $conn -> query("SELECT * FROM postulaciones WHERE id_gauchada='".$fila['id']."'") -> num_rows;
						if ($con == 0){
							echo '<form method ="post" action ="modificar_gauchada.php">';
							echo '<input type="hidden" name="id" value="'.$fila['id'].'" />';
							echo '<INPUT type="submit" value="Modificar gauchada">';
							echo '</form>';
						} else {
							//Boton para ver postulados
							echo '<form method ="post" action ="ver_postulantes.php">';
							echo '<input type="hidden" name="id" value="'.$fila['id'].'" />';
							echo '<INPUT type="submit" value="Ver postulados">';
							echo '</form>';
						}

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
	
		<?php
		if ((isset($_SESSION['email']))){
			if ($fila['owner'] <> $_SESSION['email']){
				//imprime el formulario para hacer una pregunta
				//id_publication 	body 	answer 	user 	date 
				echo '<div class = "det-form-question" ><form method="post" action="agregar_pregunta.php">';

				echo '<INPUT REQUIRED style="WIDTH: 100%" name="body" type="text" placeholder="deja tu pregunta aca"><br>';
				echo '<input type="hidden" name="id" value="'.$fila['id'].'" />';
				echo '<input type="hidden" name="user" value="'.$_SESSION["email"].'" />';

				echo '<INPUT type="submit" value="enviar">';
				
				echo '</form><br><br></div>	';
			}
		}

		?>
	
	<div class = "det-questions" >
		<?php
			echo '<h2> Preguntas al autor </h2><br>';
			$sql = "SELECT * FROM preguntas WHERE id_publication = ".$fila["id"]." ORDER BY date DESC";
			$res = $conn -> query($sql);
			while ($pregunta = $res -> fetch_array()){
				echo '<div class = "det-pregunta"><p> <b>'.$pregunta["user"].'</b> pregunta: <br>';
				echo $pregunta["body"];
				if ($pregunta['answer'] <> ''){
					echo '<br><div class = "det-answers"> <b>Respuesta: </b>'.$pregunta["answer"].' </div>';
				} else {
					//si $seesion es $fila [owner] imprime un formulario para que el dueño deje una respuesta
					if (isset($_SESSION['email'])) 
						if ($fila['owner'] == $_SESSION['email']){
							echo '<br><div class = "det-form-respuesta"> ';
							echo '<form method="post" action="agregar_respuesta.php">';

							echo '<INPUT REQUIRED name="body" type="text" placeholder="deja tu respuesta aca"><br>';
							echo '<input type="hidden" name="id" value="'.$pregunta['id'].'" />';

							echo '<INPUT type="submit" value="Agregar respuesta">';
							
							echo '</form></div><br><br>';
					}
				}
				echo '</div>';
			}
		?>
	</div>

</body>

</html>