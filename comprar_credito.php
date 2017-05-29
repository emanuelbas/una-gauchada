<?php include 'head.php';?>

<!doctype html>
<html lang="en">

<body>

<div class="form-crear-cuenta">

		<form action="validar_compra.php" method="post">
			<fieldset>
			<legend>Compra de Credito </legend>
			
			<label> Cantidad de credito:</label> <input REQUIRED placeholder="El costo es de $50 por credito" type="numbrer" maxlength="10" name="amount" id="amount">
			<label>Titular:</label> <input REQUIRED type="text" maxlength="16" name="titular" id="titular">
			<label>Numero de su tarjeta:</label> <input REQUIRED type="numbrer" maxlength="16" name="card" id="card">
			<label>Codigo de validación:</label> <input REQUIRED type="password" maxlength="30" name="password" id="password">
			

			<input type="submit" value="Confirmar pago" name="confirmar">
			
			<a href="index.php">Cancelar</a>
		</fieldset>
		</form>
	</div><!--
	<footer id ="footer">
		<p>Grupo 34 - 2017</p>
	</footer>-->
</body>

</html>