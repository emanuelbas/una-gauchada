
<?php  
	include 'conectar.php';
	$cons = "SELECT name FROM categorias"; // Aca se arma la query para luego ejecutarla
	$resp = mysqli_query($conn,$cons);// aca se ejecuta la query y se guarda en una variable $respuesta
	//mysqli_close($conn);
	/*if($_POST==null){//CON ESTO LOGRO Q SE QUEDEN MARCADAS LAS OPCIONES DE TITULO Y LUGAR PERO NO SE COMO HACER LA DE CATEGORIA
		$value="";
		$value2="";
		$value3="";
		$valuen="- Seleccione una categoria -";
	}
	else{
		$value=$_POST['tit'];
		$value2=$_POST['lug'];
		$value3=$_POST['cat'];
	}*/
	$value = (isset($_POST['tit']))? $_POST['tit'] :"";

	$value3 = (isset($_POST['cat']))? $_POST['cat'] : "";

	$value2 = (isset($_POST['lug']))? $_POST['lug'] : "";

//	creo q con esto anda 
	/* yo esto lo arregle con alambres en mi filtrar*/
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
			Buscar por categoria:
			<select id="cat" name="cat">
			<option value="<?php 
				if(isset($_POST['cat']))
					$val=$_POST['cat'];
				else
					$val="-Seleccione una categoria-";?>" selected="selected"><?php echo $val ?></option> 

			<?php
				while ($fila = mysqli_fetch_array($resp)){
					echo '<option value='.$fila['name'].'>'.$fila['name'].'</option>';
				}	
			?>
			</select>
			Buscar por lugar:
			<input type="text" id="lug" name="lug" value="<?php echo $value2; ?>">
			<input type="submit" value="Filtrar"><a href="index.php">Limpiar</a>
		</fieldset>

	</form>
	</div>
</body>
</html>
<?php 
if(isset ($_POST['tit']) || isset ($_POST['cat']) || isset ($_POST['lug']) )
{
/* aca ejecutas las query ( " FALTARIA ARMAR LA QUERY")
   deberias usar 	
peraaaa hay un liojajajaja por ?me dic
sii ya me parecia 
porq no me tomaba 
el filtrado de canceladas


*/
/*if(isset ($_POST['tit'])){ // continuas armando la query que vas a ejecutar
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
			$consulta = ( "SELECT * FROM publicaciones ORDER BY publication_date DESC");
		}
/* con el "pre" imprimis la query que fuiste armando
	
	echo "<pre>";
	print_r($resultado);
	echo"</pre>";
*/	
	//ASIGNARIA EL VALOR EJ: CAMBO O SINO %% SE UTILIZA PARA LA QUERY
	$tit = (isset($_POST['tit']))? "%".$_POST['tit']."%":"%%";

	//ASIGNARIA EL VALOR EJ: ANIMALES O SINO %% SE UTILIZA PARA LA QUERY
	$cat = (isset($_POST['cat']))? "%".$_POST['cat']."%":"%%";

	//ASIGNARIA EL VALOR EJ: LA PLATA O SINO %% SE UTILIZA PARA LA QUERY
	$lug = (isset($_POST['lug']))? "%".$_POST['lug']."%":"%%";

//*************************************** EXPLICACION 1 ***************************************//
// Esta Query retorna una tabla con la cantidad de postulaciones que tiene cada publicacion
// Ej1 publicacion con id 1 --> 4 postulaciones .. Ej2 publicacion con id 2 --> 2 postulaciones
// Pruebenla en la base de datos asi lo entienden mejor.. Recuerden cargar varias publicaciones y postulaciones 

/*		select post.id_gauchada , count(post.id_gauchada) as num from postulaciones as post GROUP BY post.id_gauchada
HAVING COUNT(post.id_gauchada)) as post ON(publ.id=post.id_gauchada*/
//*******************************************************************************************//

//*************************************** EXPLICACION 2 ***************************************//
// Esta Query retorna la tabla de publicaciones ordenada por el numero de postulaciones y por algun criterio de busqueda, ya sea por un titulo, categorio o sitio
// Ej1 publicacion con id 1 --> 4 postulaciones y titulo hola .. Ej2 publicacion con id 2 --> 2 postulaciones y sitio "la plata"
// Pruebenla en la base de datos asi lo entienden mejor.. Recuerden cargar varias publicaciones y postulaciones 

/* SELECT * FROM publicaciones as publ left JOIN (select post.id_gauchada , count(post.id_gauchada) as num from postulaciones as post GROUP BY post.id_gauchada
HAVING COUNT(post.id_gauchada)) as post ON(publ.id=post.id_gauchada) where title like '".$tit."' and category like '".$cat."' and site like '".$lug."' ORDER BY num DESC*/
//*******************************************************************************************//


	$consulta = ( "SELECT * FROM publicaciones as publ left JOIN (select post.id_gauchada , count(post.id_gauchada) as num from postulaciones as post GROUP BY post.id_gauchada
		HAVING COUNT(post.id_gauchada)) as post ON(publ.id=post.id_gauchada) where title like '".$tit."' and category like '".$cat."' and site like '".$lug."' ORDER BY num ASC");
	//echo $consulta;
	$resultado = mysqli_query($conn,$consulta);
	while($fila =  mysqli_fetch_array($resultado,MYSQLI_ASSOC))
	{	
		echo '<div align="left" style="border:1px solid #dbdbdb;padding:2% 1%; border-radius: 10px; 0 auto; width:35%;"><h2></h2>';
		if($fila['image']=='') 
			echo "<img src=images/logo.png>";
		else 
			echo "<img src='data:image/jpg;base64,".base64_encode($fila['image'])."'/>";
		echo '<h2><p>' .$fila['title'].'</p></h2>';
		echo '<p>' .$fila['body']. '</p>';
		echo '<p><b>Lugar</b>: ' .$fila['site']. '</p>';
		echo '<p> <b>Categoria:</b> ' .$fila['category']. '</p>';
		echo '<a href="ver_detalles.php?id='.$fila['id'].'">Ver detalles</a></div>';

	}	

}
else
{
	/*$consulta = ( "SELECT * FROM publicaciones as publ left JOIN (select post.id_gauchada , count(post.id_gauchada) as num from postulaciones as post GROUP BY post.id_gauchada
HAVING COUNT(post.id_gauchada)) as post ON(publ.id=post.id_gauchada) order by num DESC");
	echo $consulta;
	*/
	$consulta = ( "SELECT * FROM publicaciones WHERE  selected='' AND limit_date >=CURRENT_DATE() ORDER BY publication_date DESC");
	$resultado = mysqli_query($conn,$consulta);
	
	while($fila =  mysqli_fetch_array($resultado,MYSQLI_ASSOC))
	{
		echo '<br>';
		if($fila['image']=='') 
			echo "<img src=images/logo.png>";
		else 
			echo "<img src='data:image/jpg;base64,".base64_encode($fila['image'])."'/>";
		echo '<div align="left" style="border:1px solid #dbdbdb;padding:2% 1%; border-radius: 10px; 0 auto; width:35%;"><h2><p>' .$fila['title'].'</p></h2>';
		echo '<p>' .$fila['body']. '</p>';
		echo '<p><b>Lugar</b>: ' .$fila['site']. '</p>';
		echo '<p> <b>Categoria:</b> ' .$fila['category']. '</p>';
		echo '<a href="ver_detalles.php?id='.$fila['id'].'">Ver detalles</a></div>';
	}	

}
?>