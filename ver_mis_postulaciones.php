<?php
include "conectar.php";
include "head.php";

//Se muestra una tabla con Nombre | Imagen (default o la de la base)| Estado (Aceptado, No aceptado, Postulado, Gauchada realizada) | Fecha limite (solo se muestra si fue seleccionado y aun no finaliza) | Detalles (link a ver detalles de gauchada) 

$sql = "SELECT * FROM publicaciones INNER JOIN postulaciones ON publicaciones.id=postulaciones.id_gauchada WHERE '".$_SESSION['email']."' = email";
$res = $conn -> query($sql);

echo "<h2> Gauchadas en las que me postule </h2><table>";
echo "<tr><th>Gauchada</th><th>Imagen</th><th>Estado</th><th>Fecha limite</th><th>Detalles</th></tr>";
while ($publicacion = $res -> fetch_array()){
	if($publicacion['image']=='') 
		$img= "<img src=images/logo.png>";
	else 
		$img= "<img src='data:image/jpg;base64,".base64_encode($publicacion['image'])."'/>";
	$nombre = $publicacion['title'];
	if ($publicacion['selected'] == $_SESSION['email']) {
		$calificacion = "Aceptado";
		$limite = $publicacion['limit_date'];
		if ($publicacion['selected_calification']<>'pendiente') {
			$calificacion = "Gauchada realizada";
			$limite = "-";
		}
	} else {
		$calificacion = "No aceptado";
		$limite = "-";
	} 
	if ($publicacion['selected']=="") $calificacion = "Postulado";
	$boton = '<a href="ver_detalles.php?id='.$publicacion['id_gauchada'].'">Ver detalles</a></div>';
	echo "<tr><td align='center'>".$nombre."</td><td align='center'>".$img."</td><td align='center'>".$calificacion."</td><td><div align='center'>".$limite."</div></td><td align = 'center'>".$boton."</td></tr>";
}


?>