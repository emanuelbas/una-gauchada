<?php  

//Quiero modificar la tabla que tiene limit_date body v 	site 	title v	image v	category v	id v
	include 'conectar.php';
	include 'head.php';

	$id = $_POST['id'];
	$sql = "SELECT * FROM publicaciones WHERE id=$id";
	$res = $conn -> query($sql);
	$gauchada = $res -> fetch_array();

	echo '<form enctype="multipart/form-data" method="POST" action="modificar_gauchada_update.php">';

	//Titulo
	echo '<p> Titulo </p><INPUT REQUIRED type="text" name="title" value="'.$gauchada['title'].'" >';

	//Imagen
	if($gauchada['image']=='')	{ 
		echo "Agrega una imagen "; 
		echo '<input id="image" name="image" type="file" accept="image/jpeg" size="30">';
	}	else 	{
		echo "<p>Imagen actual: </p>";
		echo "<img src='data:image/jpg;base64,".base64_encode($gauchada['image'])."'/>";
		echo "<p>Reemplazarla </p>".'<input id="image" name="image" type="file" accept="image/jpeg" size="30">';
	}

	echo '<p>Descripcion</p>';
	echo '<TEXTAREA REQUIRED name="body" rows="10" cols="30">'.$gauchada['body'].'</TEXTAREA>';

	//Categoria
	echo '<p>Categoria</p><select id="cat" name="cat">';
	$consulta = "SELECT name FROM categorias WHERE available=1";
	$respuesta = mysqli_query($conn,$consulta);
	echo '<option value="'.$gauchada['category'].'" selected>'.$gauchada['category'].'</option> ';
	while ($fila = mysqli_fetch_array($respuesta, MYSQL_NUM)){
		if ($fila[0]<>$gauchada['category']) echo '<option value='.$fila[0].'>'.$fila[0].'</option>';
	}
	echo '</select>';
	
	//fecha limite
	echo '<p>Fecha limite</p>';
	echo '<INPUT REQUIRED type="date" min='.date("Y-m-d").' id="date" value="'.$gauchada['limit_date'].'" name="limit_date">';

	//lugar
	echo '<p>Lugar </p>';
	echo '<INPUT REQUIRED type="text" value="'.$gauchada['site'].'" id="site" name="site">';

	//ID
	echo '<INPUT type="hidden" name="id" value="'.$gauchada['id'].'" >';

	//Boton update
	echo '<br><INPUT type="submit" value="Actualizar">';
	echo '</form>';

	$conn -> close();

?>