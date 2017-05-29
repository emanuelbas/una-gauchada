<?php include 'head.php'; ?>
<html>


    <body>
		
		<div class="form-crear-cuenta">

        <form method ="post" action ="validar_usuario.php">
        	<fieldset>
        		<legend>Iniciar Sesion</legend>
					<label>Correo:</label><input REQUIRED type ="text" name="email"/>				
					<label>Clave: </label><input REQUIRED type ="password" name="pw">
					<input type="submit" value="Enviar">
					<a href="index.php">Olvide mi clave, enviame un correo</a>
					<a href="index.php"  >Cancelar</a> 
			</fieldset>
        </form>
        </div>




		<footer>
			<p>Grupo 34 - 2017</p>
		</footer>
    </body>
</html>
