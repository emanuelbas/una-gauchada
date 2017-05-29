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
				echo '<p>' .$fila['body'].'</p>';
				echo '<p> <b>Fecha limite:</b> ' .$fila['limit_date'].'</p>';
				echo '<p><b>Lugar</b>: ' .$fila['site'].'</p>';
				echo '<p> <b>Categoria:</b> ' .$fila['category'].'</p>';
				echo '<a href="">ver todas mis gauchadas</a>&nbsp;&nbsp;';
				echo '<a href="index.php">volver al menu</a>';
			?>

		</div>	
	</div>

</body>

</html>