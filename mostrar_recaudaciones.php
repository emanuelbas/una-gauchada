
<?php
//usuario, fecha, cantidad de crédito comprado, precio, subtotal y el total
	include "head.php";
	include "conectar.php";

	if (isset($_GET['msj'])) echo "<font color='red'>".$_GET['msj'].'</font>';
	if (isset($_POST['fecha1'])){

		$fecha1 = $_POST['fecha1'];
		$fecha2 = $_POST['fecha2'];
		
		$sql = "SELECT * FROM compras WHERE date BETWEEN '".$fecha1."'AND '".$fecha2."'";
		$res = $conn ->query($sql);

		$total = 0;
		echo "<table><tr bgcolor='orange'><th>Usuario</th><th>Fecha</th><th>Cantidad</th><th>Precio por Unidad</th><th>Subtotal</th></tr>";
		while ($row = $res -> fetch_array()){

			echo "<tr bgcolor='darkgrey'>";
			echo "<th>".$row['email']."</th>";
			echo "<th>".$row['date']."</th>";
			echo "<th>".$row['amount']."</th>";
			echo "<th>$".$row['price']."</th>";

			$subtotal = $row['price'] * $row['amount'];
			echo "<th>$".$subtotal."</th>";


			$total = $total + $subtotal;
			echo "</tr>";
		}
		if ($total == 0) header('Location: mostrar_recaudaciones.php?msj=No se registraron ganancias entre esas fechas');
		else
			echo "</table><p style='font-size:25' >Total recaudado entre ".$fecha1." y ".$fecha2.": $".$total."</p>";

	} else { //muestro un form para ingresar las fechas
		echo "<p>Ingrese las fechas entre las cuales desea averiguar las recaudaciones (AAAA-MM-DD)</p><br>";
		echo "<form method='POST' action='mostrar_recaudaciones.php'>";
		echo "<input required placeholder='Fecha A' type='date' name='fecha1'>";
		echo "<input required placeholder='Fecha B' type='date' name='fecha2'>";
		echo "<input type='submit' value='Ver recaudaciones'>";
		echo "</form>";
	}


?>