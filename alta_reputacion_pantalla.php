<?php
	include "head.php";
	include "conectar.php";


	$sql = "SELECT * FROM reputaciones WHERE 1 ORDER BY score DESC";
	$query = $conn -> query($sql);

	if (isset($_GET['error'])) echo "<font color='red'>".$_GET['error']."</font><br><br>";
	echo "<h2>Reputaciones</h2><br><table>";
	if ($row = $query -> fetch_array()) {
		if (isset($_GET['editar']) AND $row['name']==$_GET['editar']){
			echo "<tr><form method='POST' action='actualizar_reputacion.php?name=".$row['name']."'>";

			echo "<th><input type='submit' value='ok'></th>";
			echo "<th><a  href='alta_reputacion_pantalla.php'>X</a></th>";
			echo "<th><input name='name' type='text' value='".$row['name']."'></th>";
			echo "<th><input name='score' type='number' value='".$row['score']."'></th>";

			echo "</tr></form>";

		} else {
			echo "<tr>";

			echo "<th><a  href='borrar_reputacion.php?name=".$row['name']."'><img src='images/borrar.png'></a></th>";
			echo "<th><a href='alta_reputacion_pantalla.php?editar=".$row['name']."' </a><img src='images/editar.png'></th>";
			echo "<th>".$row['name']."</th>";
			echo "<th>".$row['score']."+</th>";

			echo "</tr>";
		}
	}
	while ($row = $query -> fetch_array()){
		if ($row['score']<=0){
		if (isset($_GET['editar']) AND $row['name']==$_GET['editar']){
			echo "<tr><form method='POST' action='actualizar_reputacion.php?name=".$row['name']."'>";

			echo "<th><input type='submit' value='ok'></th>";
			echo "<th><a  href='alta_reputacion_pantalla.php'>X</a></th>";
			echo "<th><input name='name' type='text' value='".$row['name']."'></th>";
			echo "<th><input name='score' type='number' value='".$row['score']."'></th>";

			echo "</tr></form>";

		} else {
			echo "<tr>";

			echo "<th>-</th>";
			echo "<th>-</th>";
			echo "<th>".$row['name']."</th>";
			if ($row['score']==0) echo "<th>".$row['score']."</th>";
			else echo "<th>< 0</th>";

			echo "</tr>";
		}
			}else{
				if (isset($_GET['editar']) AND $row['name']==$_GET['editar']){
					echo "<tr><form method='POST' action='actualizar_reputacion.php?name=".$row['name']."'>";

					echo "<th><input type='submit' value='ok'></th>";
					echo "<th><a  href='alta_reputacion_pantalla.php'>X</a></th>";
					echo "<th><input name='name' type='text' value='".$row['name']."'></th>";
					echo "<th><input name='score' type='number' value='".$row['score']."'></th>";

					echo "</tr></form>";

				} else {
						echo "<tr>";

						echo "<th><a  href='borrar_reputacion.php?name=".$row['name']."'><img href='borrar_reputacion.php?name=".$row['name']."' src='images/borrar.png'></a></th>";
						echo "<th><a href='alta_reputacion_pantalla.php?editar=".$row['name']."'</a><img src='images/editar.png'></th>";
						echo "<th>".$row['name']."</th>";
						echo "<th>".$row['score']."</th>";

						echo "</tr>";
					}
				}
	}

	
	echo "</table><br><br>";
	echo "<h4>Agregar reputacion</h4>";
	echo "<form method='POST'action='agregar_reputacion.php'>";
	echo "<table><tr>";
	echo "<th><input type='submit' value='+'></th><th><input name='name' type='text' required></th><th><input name='score' type='number' required></th>";
	echo "</tr></table>";
	echo "</form>";



	$conn -> close();
?>

