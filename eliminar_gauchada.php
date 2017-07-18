<html>
<?php include 'head.php';?>
<body>
<?php
	include 'conectar.php';
	$id= $_GET['id'];
	$sql="SELECT * FROM publicaciones WHERE id='$id'";
	$cons=mysqli_query($conn,$sql);
	if(!$cons){
		
		echo'No se pudo encontrar la publicacion' . mysqli_error();
		exit;
	}

	$publicacion=mysqli_fetch_array($cons,MYSQLI_ASSOC);
	

	

 if ($publicacion['selected']<>""){
 	echo "<div align='center'><h2><img src='images/gaucho.jpg' width='15%'>No se puede eliminar gauchada ya que posee un seleccionado";
	echo "<br /><a href='index.php'>Volver al sitio</a></div>";
 }
 else{
 	$cons2=  "select post.id_gauchada , count(post.id_gauchada) as num from postulaciones as post WHERE id_gauchada=$id GROUP BY post.id_gauchada HAVING COUNT(post.id_gauchada)";
	$cons=mysqli_query($conn,$cons2);
	$cant=mysqli_fetch_array($cons,MYSQLI_ASSOC);
	if ($cant['num'] > 0){
		$mail= "select emal from postulaciones WHERE id_gauchada=$id";
		$consE=mysqli_query($conn,$mail);
		
		while($email=mysqli_fetch_array($consE,MYSQLI_ASSOC))
		{
		    echo "se ha enviado un mail a ".$email['emal'];	
			echo "<br>";
		}	
         $borrado= "DELETE FROM publicaciones WHERE id=$id";
         $modBorrar=mysqli_query($conn,$borrado);
         header('Location: index.php');
 	}
 	else {
 		 $devolver= "select credit from usuarios where email='".$publicacion['owner']."'";
 		 $creditos=mysqli_query($conn,$devolver);
	     $cantCred=mysqli_fetch_array($creditos,MYSQLI_ASSOC);
	     $cantCred['credit']= $cantCred['credit'] + 1;
	     $modif= "UPDATE usuarios SET credit = '".$cantCred['credit']."' WHERE email='".$publicacion['owner']."'";
         $mod=mysqli_query($conn,$modif);
         $borrado= "DELETE FROM publicaciones WHERE id=$id";
         $modBorrar=mysqli_query($conn,$borrado);
         header('Location: index.php');
    }
 }


/*
echo "<pre>";
print_r($cant);
echo "</pre>";*/

?>