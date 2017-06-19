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
				echo '<a href="">ver todas mis gauchadas</a>&nbsp;&nbsp;';
				echo '<a href="index.php">volver al menu</a>&nbsp;&nbsp;';
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
							} //else echo "Usuario dueño de la gauchada";
						} //else  echo "Ya hay un seleccionado";
					} //else echo "Ya esta postulado";
				} else echo "<a href='iniciar_sesion.php'>Inicia sesion para postularte</a>";
			?>

		</div>	
	</div>

</body>

</html>