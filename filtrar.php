
<?php  
	include 'conectar.php';
	$consulta = "SELECT name FROM categorias"; // Aca se arma la query para luego ejecutarla
	$respuesta = mysqli_query($conn,$consulta);// aca se ejecuta la query y se guarda en una variable $respuesta
	//mysqli_close($conn);
	if($_POST==null){//CON ESTO LOGRO Q SE QUEDEN MARCADAS LAS OPCIONES DE TITULO Y LUGAR PERO NO SE COMO HACER LA DE CATEGORIA
		$value="";
		$value2="";
		$value3="";
	}
	else{
		$value=$_POST['tit'];
		$value2=$_POST['lug'];
		$value3=$_POST['cat'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body >
	<div><form method="POST" action="filtrar.php">
		<fieldset>
			Buscar por titulo:
			<input type="text" id="tit" name="tit" value="<?php echo $value; ?>">
			
			<?php

						echo 'Buscar por categoria:';
						echo '<select id="cat" name="cat">';
						if($_POST==null)
						echo '<option value="ninguna" selected="selected">- Seleccione una categoria -</option> ';// Con esto se podria hacer que aparezca una preseleccionada
						else
							echo '<option value="'.$value3.'" selected="'.$value3.'">'.$value3.'</option>';
						while ($fila = mysqli_fetch_array($respuesta, MYSQL_NUM)){
							echo '<option value='.$fila[0].'>'.$fila[0].'</option>';
						}
						echo '</select>';
			?>
			Buscar por lugar:
			<input type="text" id="lug" name="lug" value="<?php echo $value2; ?>">
			<input type="submit" value="Filtrar"><input type="reset" value="Limpar" autofocus>
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
			$sql="WHERE title like '%$tit%'";
		}
	}
	

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
			$sql = "WHERE category like '%$cat%'";	
		}
	}

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

			$sql.="AND limit_date  >= CURRENT_DATE()";
			//$consulta = ( "SELECT * FROM publicaciones ". $sql);
			$consulta = ( "SELECT count(*) FROM publicaciones INNER JOIN postulaciones  ON (publicaciones.id=postulaciones.id_gauchada) GROUP BY count(postulaciones.email)". $sql ."ORDER BY count(email) ASC") ;
			;

		}
		else
		{
			$consulta = ( "SELECT * FROM publicaciones WHERE limit_date >=CURRENT_DATE() ORDER BY publication_date DESC");
		}
/* con el "pre" imprimis la query que fuiste armando
	
	echo "<pre>";
	print_r($resultado);
	echo"</pre>";

	
*/	$resultado = mysqli_query($conn,$consulta);
	//echo $consulta;
	//echo $resultado;
	
	while($fila =  mysqli_fetch_array($resultado,MYSQLI_ASSOC))
	{	
		echo '<div align="left" style="border:1px solid #dbdbdb;padding:2% 1%; border-radius: 10px; 0 auto; width:35%;"><h2></h2>';
		if($fila['image']=='') 
			echo "<img src=images/logo.png>";
		else 
			echo "<img src='data:image/jpg;base64,".base64_encode($fila['image'])."'/>";
		echo '<h2><p><b>Titulo:</b>' .$fila['title'].'</p></h2>';
		echo '<p>' .$fila['body']. '</p>';
		//echo '<p><b>Lugar</b>: ' .$fila['site']. '</p>';
		//echo '<p> <b>Categoria:</b> ' .$fila['category']. '</p>';
		echo '<a href="ver_detalles.php?id='.$fila['id'].'">Ver detalles</a></div>';

	}	

}
else
{
	$consulta = ( "SELECT * FROM publicaciones WHERE limit_date >=CURRENT_DATE() ORDER BY publication_date DESC");
		
/* con el "pre" imprimis la query que fuiste armando
	
	echo "<pre>";
	print_r($resultado);
	echo"</pre>";

	
*/	$resultado = mysqli_query($conn,$consulta);
	//echo $consulta;
	
	while($fila =  mysqli_fetch_array($resultado,MYSQLI_ASSOC))
	{	
		echo '<div align="left" style="border:1px solid #dbdbdb;padding:2% 1%; border-radius: 10px; 0 auto; width:35%;"><h2></h2>';
		if($fila['image']=='') 
			echo "<img src=images/logo.png>";
		else 
			echo "<img src='data:image/jpg;base64,".base64_encode($fila['image'])."'/>";
		echo '<h2><p><b>Titulo:</b>' .$fila['title'].'</p></h2>';
		echo '<p>' .$fila['body']. '</p>';
		//echo '<p><b>Lugar</b>: ' .$fila['site']. '</p>';
		//echo '<p> <b>Categoria:</b> ' .$fila['category']. '</p>';
		echo '<a href="ver_detalles.php?id='.$fila['id'].'">Ver detalles</a></div>';
	}	

}
?>