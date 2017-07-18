<?php
	include "head.php";
	include "conectar.php";

	$sql = "SELECT * FROM categorias WHERE 1";
	$res = $conn -> query($sql);

	if (isset($_GET['msj'])) echo "<h5><font color='red'>".$_GET['msj']."</font></h5>";
	echo "<h2>Categorias</h2>";
	echo "<table>";
	while ($row = $res -> fetch_array()){
		if ((isset($_GET['editar']))AND($_GET['editar']==$row['name'])){
			echo "<form action='editar_categoria.php?name=".$row['name']."' method='POST'><tr>";

			echo "<th> <input type='submit' value='ok'> </th>";
			echo "<th> <a href='ventana_categorias.php'>X</a> </th>";
			echo "<th> <input type='text' name='name' value='".$row['name']."'> </th>";

			echo "</tr></form>";
		} else {
			if ($row['available']==1){
				echo "<tr>";

				echo "<th> <a href='borrar_categoria.php?name=".$row['name']."'><img src='images/borrar.png'></a> </th>";
				echo "<th> <a href='ventana_categorias.php?editar=".$row['name']."'><img src='images/editar.png'></a> </th>";
				echo "<th> ".$row['name']." </th>";

				echo "</tr>";
			} else {
				echo "<tr>";

				echo "<th></th>";
				echo "<th></th>";
				echo "<th><font color='grey'> ".$row['name']."</font> </th>";

				echo "</tr>";
			}
		}
	}
	echo "</table><br><br>";

	echo "<h4>Agregar categoria</h4>";
	echo "<form method='POST' action='agregar_categoria.php'><table>";

	echo "<tr>";
	echo "<th><input type='submit' value='+'></th><th><input name='name' type='text' required></th>";
	echo "</tr>";

	$conn -> close();


?>