<?php
include "conectar.php";
include "head.php";

//Quiero imprimir una lista con cada nombre de gauchada, estado (falta seleccionar, falta calificar o realizada) y un boton para ver sus detalles

$sql = "SELECT * FROM publicaciones WHERE '".$_SESSION['email']."' = owner";
$res = $conn -> query($sql);
echo "<div>";
echo "<h2> Gauchadas que tu creaste </h2><table>";
echo "<tr><th>Gauchada</th><th>Estado</th><th>Detalles</th></tr>";
while ($publicacion = $res -> fetch_array()){
	$nombre = $publicacion['title'];
	if ($publicacion['selected'] <> '') {
		if ($publicacion['selected_calification'] == 'pendiente') $estado = "Falta calificar"; else $estado = "Terminada";
	} else $estado = "Sin seleccionado";

	$boton = '<a href="ver_detalles.php?id='.$publicacion['id'].'">Ver detalles</a></div>';
	echo "<tr><td>".$nombre."</td><td>".$estado."</td><td>".$boton."</td></tr>";
}
echo "</div>";


?>