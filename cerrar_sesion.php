<?php
	session_start();
	session_destroy();
	echo 'La sesion se ha cerrado correctamente.';
	echo '<br /><a href="index.html">Ir al sitio</a>';
?>