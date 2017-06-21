<?php
	include 'conectar.php';

	$sql = "UPDATE publicaciones SET selected ='".$_POST['email']."' WHERE id =".$_POST['id'];
	$conn -> query($sql);
	$conn->close();
	header("location:index.php");
?>
