<?php
	include "head.php";
	include "conectar.php";

	if ((isset($_SESSION['IsAdministador']))AND($_SESSION['IsAdministador']==1)){

		$sql = "SELECT * FROM usuarios WHERE 1 ORDER BY score DESC";
		$res = $conn -> query($sql);

		echo "<h2> Tabla de puntuaciones </h2><br>";
		echo "<table><tr bgcolor='orange'><th>Usuario</th><th>Puntuacion</th></tr>";
		while ($row = $res -> fetch_array()){

			echo "<tr bgcolor='darkgrey'>";
			echo "<th>".$row['email']."</th>";
			echo "<th>".$row['score']."</th>";
			echo "</tr>";

		}


	}


?>