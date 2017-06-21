<?php
include "conectar.php";
include "head.php";

//Quiero que se vea para cada gauchada en la que esta postulado el $session[email]: el NOMBRE DE LA GAUCHADA, SI LA GANE calificacion sino que diga "no seleccionado" y BOTON para detalles

$sql = "SELECT * FROM publicaciones INNER JOIN postulaciones ON publicaciones.id=postulaciones.id_gauchada WHERE '".$_SESSION['email']."' = email";
$res = $conn -> query($sql);

echo "<h2> Gauchadas en las que me postule </h2><table>";
echo "<tr><th>Gauchada</th><th>Calificacion</th><th>Detalles</th></tr>";
while ($publicacion = $res -> fetch_array()){
	$nombre = $publicacion['title'];
	if ($publicacion['selected'] == $_SESSION['email']) $calificacion = $publicacion['selected_calification']; else $calificacion = "No seleccionado";
	$boton = '<a href="ver_detalles.php?id='.$publicacion['id'].'">Ver detalles</a></div>';
	echo "<tr><td>".$nombre."</td><td>".$calificacion."</td><td>".$boton."</td></tr>";
}


?>