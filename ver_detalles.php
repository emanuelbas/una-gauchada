<html>
<head>
	<title>Una gauchada</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<div style="position:relative">
		<img src="images/banner.png" width="1000"  height="268"  />
		<div style="position:absolute; top:220; left:480;">
			<img border="0"  src="images/logo.png" width="80" /></a>
		</div>
	</div>
	<link rel="stylesheet" href="css/index.css">
    
</head>
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
	echo '<h2>' .$fila['title'].'</h2><br>';
	if($fila['image']=='') 
			echo "<img src=images/logo.png>";
		else 
			echo "<img src='data:image/jpg;base64,".base64_encode($fila['image'])."'/>";
	echo '<br><p>' .$fila['body'].'</p>';
	echo '<p> <b>Fecha limite:</b> ' .$fila['limit_date'].'</p>';
	echo '<p><b>Lugar</b>: ' .$fila['site'].'</p>';
	echo '<p> <b>Categoria:</b> ' .$fila['category'].'</p>';
	echo '<a href="">ver todas mis gauchadas</a>&nbsp;&nbsp;';
	echo '<a href="index.php">volver al menu</a>';

?>
</body>

</html>