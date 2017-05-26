<html>
    <head><title>Una gauchada</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<div style="position:relative">
			<img src="images/banner.png" width="1000"  height="268"  />
			<div style="position:absolute; top:220; left:480;">
				<img border="0"  src="images/logo.png" width="80" /></a>
			</div>
		</div>
		<link rel="stylesheet" href="css/index.css">
    </head>
    <body>
		    <?php 
				SESSION_START();
				//Si hay usuario logueado entonces me muestra las funciones
				//Sino me muestra registrar e iniciar
				
				if ((isset($_SESSION['email']))){ 
					echo '<a href="comprar_credito.html">Comprar credito</a> &nbsp;'.'<a href="cerrar_sesion.php">Cerrar sesion</a> &nbsp;'.'<a href="publicar_gauchada.php">Publicar gauchada</a> &nbsp;';
				} else { echo '<a href="iniciar_sesion.html">Iniciar sesion</a>'.'   '.'<a href="crear_cuenta.html">Crear una cuenta</a>'; }
				
			?>
		<div align="center"><h1 ALIGN=center>Una Gauchada</h2>
        <br><br>
		<?php
			include 'ver_gauchadas.php';
		?>
        </div>
		
		<footer>
			<p>Grupo 34 - 2017</p>
		</footer>
    </body>
</html>