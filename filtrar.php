<?php  
	include 'conectar.php';
	$consulta = "SELECT name FROM categorias"; // Aca se arma la query para luego ejecutarla
	$respuesta = mysqli_query($conn,$consulta);// aca se ejecuta la query y se guarda en una variable $respuesta
	//mysqli_close($conn);
	if($_POST==null){//CON ESTO LOGRO Q SE QUEDEN MARCADAS LAS OPCIONES DE TITULO Y LUGAR PERO NO SE COMO HACER LA DE CATEGORIA
		$value="";
		$value2="";
	}
	else{
		$value=$_POST['tit'];
		$value2=$_POST['lug'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body >
	<div><form method="POST" action="">
		<fieldset>
			Buscar por titulo:
			<input type="text" id="tit" name="tit" value="<?php echo $value; ?>">
			
			<?php

						echo 'Buscar por categoria:';
						echo '<select id="cat" name="cat">';
						echo '<option value="ninguna" selected="selected">- Seleccione una categoria -</option> ';// Con esto se podria hacer que aparezca una preseleccionada
						while ($fila = mysqli_fetch_array($respuesta, MYSQL_NUM)){
							echo '<option value='.$fila[0].'>'.$fila[0].'</option>';
						}
						echo '</select>';
			?>
			Buscar por lugar:
			<input type="text" id="lug" name="lug" value="<?php echo $value2; ?>">
			<input type="submit" value="Filtrar"><input type="reset" value="Limpar">
		</fieldset>

	</form>
	</div>
</body>
</html>
<?php 
$sql='';
if(isset ($_POST['tit']) || isset ($_POST['cat']) || isset ($_POST['lug']) )
{
/* aca ejecutas las query ( " FALTARIA ARMAR LA QUERY")
   deberias usar 	

*/
if(isset ($_POST['tit'])){ // continuas armando la query que vas a ejecutar
	$tit=$_POST['tit'];
	if($tit!='')
	{	if($sql != '')
		{
			$sql=" title like '%$tit%'  ";
		}
	
		else
		{
			$sql="WHERE title like '%$tit'";
		}
	}
	//$consulta= $consulta."title='".$tit."' AND ";

}

if(isset ($_POST['cat'])){ // continuas armando la query que vas a ejecutar
	$cat=$_POST['cat'];
	if($cat!='ninguna')
	{
		if($sql != '')
			{
			$sql.=" AND category like '%$cat%' ";
			}
		else 
 		{
			$sql = "WHERE category LIKE '%$cat%'";	
		}
	}
	//$consulta= $consulta."category='".$cat."' AND ";

//}

if(isset ($_POST['lug'])){ // continuas armando la query que vas a ejecutar
	$lug=$_POST['lug'];
	if($lug!='')
		{
			if($sql!='')
			{
				$sql.=" AND site like '%$lug%' ";
			}
		
			else
			{
				$sql= "WHERE site like '%$lug%' ";
			}
		
		}	
	//$consulta= $consulta."site='".$lug."' ";
}
}
		if($sql!=''){
			$consulta = ( "SELECT * FROM publicaciones ". $sql);
		}
		else
		{
			$consulta = ( "SELECT * FROM publicaciones");
		}
/* con el "pre" imprimis la query que fuiste armando
	
	echo "<pre>";
	print_r($resultado);
	echo"</pre>";

	
*/	$resultado = mysqli_query($conn,$consulta);
	echo $consulta;
	
	while($fila =  mysqli_fetch_array($resultado,MYSQLI_ASSOC))
	{	

		echo '<h2><p><b>Titulo:</b>' .$fila['title'].'</p></h2>';
		echo '<p>' .$fila['body']. '</p>';
		echo '<p><b>Lugar</b>: ' .$fila['site']. '</p>';
		echo '<p> <b>Categoria:</b> ' .$fila['category']. '</p>';
		echo '<a href="ver_detalles.php?id='.$fila['id'].'">Ver detalles</a></div>';
	}	

}
?>