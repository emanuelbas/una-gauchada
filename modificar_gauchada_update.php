
<?php

//Quiero modificar la tabla que tiene limit_date body v 	site 	title v	image v	category v	id v
include 'conectar.php';

$title = $_POST['title'];
$body = $_POST['body'];
$cat = $_POST['cat'];
$limit_date = $_POST['limit_date'];
$site = $_POST['site'];
$id = $_POST['id'];
$category = $_POST['cat'];

//por el tema de la imagen
if (($_FILES['image']['tmp_name']) != "") {
					//Si se leyo una imagen la almaceno en la BD
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$sql = "UPDATE publicaciones SET limit_date = '$limit_date', body = '$body', site = '$site', title = '$title', image = '$image', category = '$category' WHERE id = $id";
}else {
	$sql = "UPDATE publicaciones SET limit_date = '$limit_date', body = '$body', site = '$site', title = '$title', category = '$category' WHERE id = $id";
}

$conn -> query($sql);
header('Location: index.php');
$conn -> close();

?>