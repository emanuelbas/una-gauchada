<?php
	include 'conectar.php';
	$consulta = "SELECT name FROM categorias";
	$respuesta = mysqli_query($conn,$consulta);
?>

<html>
<head>
	<img src="images/logo.png">
	<title>Publicar gauchada</title>
	<link rel="stylesheet" href="css/estilos.css">

</head>
<body>
    <form enctype="multipart/form-data" method="post" action="publicar.php">
		<div>
			<p>Ingrese el titulo<br>
            <INPUT REQUIRED id=titulo size=32 name=titulo> 
            
			<p>Ingrese foto del articulo(opcional)<br>
            <input id="image" name="image" type="file" accept="image/jpeg" size="30">
			
			<P>Describa la gauchada<BR>
			<TEXTAREA name="body" rows="10" cols="30"></TEXTAREA><BR>
			
			<p>Indique el lugar y la fecha límite<br>
            <INPUT REQUIRED type="text" id="site" name="site"><INPUT REQUIRED placeholder="dd/mm/aaaa" type="date" id="date" name="limit_date">
			
			<br><br>
				<?php
					echo '<select id="cat" name="cat">';
					//echo '<option value="ninguna" selected="selected">- Seleccione una categoria -</option> '; Con esto se podria hacer que aparezca una preseleccionada
					while ($fila = mysqli_fetch_array($respuesta, MYSQL_NUM)){
						echo '<option value='.$fila[0].'>'.$fila[0].'</option>';
					}
					echo '</select>';
					$conn->close(); 
				?>
			<br><br>
			<INPUT type="submit" value="Publicar" >   
			<a href="index.php">Cancelar</a>
				
				
				
			</P>
	  
	  </div>
</form>
</body>
</html>
