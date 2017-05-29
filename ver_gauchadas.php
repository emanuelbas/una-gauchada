

<?php
	//ESTE MODULO ES UTILIZADO EN INDEX.PHP
	include 'conectar.php';

	
	//Todas las publicaciones que no expiraron
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$date = date('Y-m-d', time());
	$sql = "SELECT * FROM publicaciones WHERE selected='' AND limit_date >= '".$date."' ORDER BY publication_date"; //hay que arreglar el tema del date WHERE limit_date < '$date'
	$resultado = mysqli_query($conn,$sql);
	while ($fila = mysqli_fetch_array($resultado,MYSQLI_ASSOC)){//Para cada publicacion
		
		echo '<br>';
		if($fila['image']=='') 
			echo "<img src=images/logo.png>";
		else 
			echo "<img src='data:image/jpg;base64,".base64_encode($fila['image'])."'/>";
		
		echo '<div align="left" style="border:1px solid #dbdbdb;padding:2% 1%; border-radius: 10px; 0 auto; width:35%;"><h2>'.$fila['title'].'</h2>';
		echo '<p>'.$fila['body'].'</p>';
		echo '<a href="ver_detalles.php?id='.$fila['id'].'">Ver detalles</a></div>';
		echo '<br><br>';
		
		
	}
	
	
?>