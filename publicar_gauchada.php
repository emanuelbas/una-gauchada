<?php
	include 'conectar.php';
?>

<html>
<?php 
	include 'head.php';
 ?>
<body>
	<div class="form-crear-cuenta">
	    <form enctype="multipart/form-data" method="post" action="publicar.php">
			<fieldset>
				<legend>Publicar una gauchada</legend>
				<label>Ingrese el titulo</label>
	            <INPUT REQUIRED id=titulo size=32 name=titulo> 
	            
				<label>Ingrese foto del articulo</label>
	            <input id="image" name="image" type="file" accept="image/jpeg" size="30">
				
				<label>Describa la Gauchada</label>
				<TEXTAREA REQUIRED name="body" rows="10" cols="30"></TEXTAREA><BR>
				
				<label>Lugar</label>
	            <INPUT REQUIRED type="text" id="site" name="site">
				
				<label>Fecha Limite</label>
				<INPUT REQUIRED placeholder="aaaa-dd-mm" type="date" min=<?php echo date('Y-m-d');?> id="date" name="limit_date">
				
					<?php
						echo '<select id="cat" name="cat">';
						//echo '<option value="ninguna" selected="selected">- Seleccione una categoria -</option> '; Con esto se podria hacer que aparezca una preseleccionada
						$consulta = "SELECT name FROM categorias WHERE available=1";
						$respuesta = mysqli_query($conn,$consulta);
						while ($fila = mysqli_fetch_array($respuesta, MYSQL_NUM)){
							echo '<option value='.$fila[0].'>'.$fila[0].'</option>';
						}
						echo '</select>';
						$conn->close(); 
					?>
				<INPUT type="submit" value="Publicar" >   
				<a href="index.php">Cancelar</a>
				</P>
		  
	    	</fieldset>
		</form>
	</div>
</body>
</html>
