<head>
	<title>Una gauchada</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<div class= "banner">
		<img class= "image-banner" src="images/banner.png"/>
		<div class="nav-icono">
			<a href="index.php"><img class="nav-icono-logo" src="images/logo.png" width="80" /></a></a>
		</div>
	</div>
	<link rel="stylesheet" href="css/index.css">
</head>
<nav class="nav-menu">
		

<?php 
	session_start();

	include "conectar.php";
	echo "<div style='margin: 0.5%;'>";			
	if ((isset($_SESSION['email']))){ 

		$sql = "SELECT * FROM usuarios WHERE `email`='".$_SESSION['email']."'";
		$res = $conn -> query($sql);
		$row = $res -> fetch_array();

		if ($row['IsAdministrador']==1){
			echo '<li><a href="mostrar_ranking.php">Ranking</a></li> '.'<li><a href="ventana_categorias.php">Configurar categorias</a></li> '.'<li><a href="mostrar_recaudaciones.php">Ver recaudaciones</a></li> '.'<li><a href="alta_reputacion_pantalla.php">Configurar reputaciones</a></li> '.'<li><a href="cerrar_sesion.php">Cerrar sesion</a></li> ';
		} else {
		echo '<li><a href="comprar_credito.php">Comprar credito</a></li> '.'<li><a href="cerrar_sesion.php">Cerrar sesion</a></li> &nbsp;'.'<li><a href="publicar_gauchada.php">Publicar gauchada</a></li>'.'<li><a href="ver_perfil.php">Ver perfil</a></li> &nbsp;';
		}
	} else { echo '<li><a href="iniciar_sesion.php">Iniciar sesion</a></li>'.'   '.'<li><a href="ventana_crear_cuenta.php">Crear una cuenta</a></li>'; }
	echo "</div>";		

?>

</nav>	