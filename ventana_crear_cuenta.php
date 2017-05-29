<?php
	include 'head.php';
?>
<html>
<body>

	<div class="form-crear-cuenta">

		<form action="crear_cuenta.php" method="post">
			<fieldset>
				<legend>Formulario para registrarse</legend>
				<label>Nombre</label><input REQUIRED type="text" maxlength="30" name="name" id="name" placeholder="Ingresa Nombre">
				<label>Apellido</label><input REQUIRED type="text" maxlength="30" name="last_name" id="last_name" placeholder="Ingresa Apellido">
				<label>Fecha de nacimiento:</label><input REQUIRED type="date" placeholder="Ej. 12/09/1994" maxlength="30" name="bdate" id="bdate">
				<label>Telefono:</label><input REQUIRED type="numbrer" placeholder="2214508022" maxlength="16" name="phone" id="phone">
				<label>Email:</label><input REQUIRED type="email" maxlength="30" name="email" id="email" placeholder="Ingresa Email">
				<label>Clave:</label><input REQUIRED type="password" maxlength="30" name="password1" id="password1" placeholder="Ingresa Una Clave">
				<label>Confirmar clave:</label><input REQUIRED type="password" maxlength="30" name="password2" id="password2" placeholder="Ingresa Nuevamente una Clave">
				
				<input type="submit" value="Crear cuenta" />
				<a href="index.php">Cancelar</a>
			</fieldset>
		</form>
	</div>
	
	
	
</body>