<?php
//debe contener  la calificación, el comentario y el título de la gauchada, adicionalmente puede tener una imagen
	include "head.php";
	include "conectar.php";


	$email = $_SESSION['email'];

	$sql = "SELECT * FROM publicaciones WHERE selected_calification<>'pendiente' AND selected='".$email."'";
	$res = $conn -> query($sql);
	$con = $res -> num_rows;
	if ($con==0) echo "<h5>Aun no has recibido calificaciones </h5>";
	else echo "<h2>Calificaciones</h2>";
	echo "<table>";
	echo "<tr bgcolor='orange'><th>Calificacion</th><th>Comentario</th><th>Titulo</th><th>Imagen</th></tr>";
	while ($row = $res -> fetch_array()){
		echo "<tr bgcolor='lightgrey'>";

		if ($row['selected_calification']=='positive') 
			echo "<th><img src='images/positivo.png'</th>";
		else if ($row['selected_calification']=='negative') 
			echo "<th><img src='images/negativo.png'</th>";
		else 
			echo "<th><img src='images/neutral.png'</th>";

		echo "<th>".$row['selected_coment']."</th>";

		echo "<th>".$row['title']."</th>";

		if($row['image']=='')
			echo "<th><img class= 'post-image' src=images/logo.png></th>"; 
		else 
			echo "<th><img src='data:image/jpg;base64,".base64_encode($row['image'])."'/></th>";

		echo "</tr>";
	}
	echo "</table>";

?>