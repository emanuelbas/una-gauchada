<?php 
	include 'conectar.php';
	include 'head.php';
	$sql = 'SELECT * FROM usuarios WHERE "'.$_SESSION["email"].'" = email'; 
	$res = $conn -> query($sql);
	$user = $res -> fetch_array();
	//Ahora tengo $user['name'] $user['last_name'] $user['phone']
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Perfil</title>
</head>
<body>
<div>
	<form action="" method=POST>
		
	
		<label><h3>Ventana para modificar perfil</h3></label>
		<label>Nombre: </label><input  type="text" maxlength="30" name="name" value='<?php echo $user['name']; ?>' placeholder="Ingresa Nombre">
		<label>Apellido: </label><input type="text" maxlength="30" name="last_name" value='<?php echo $user['last_name']; ?>' placeholder="Ingresa Apellido">
		<label>Telefono: </label><input  type="numbrer" placeholder="2214508022" value='<?php echo $user['phone']; ?>' maxlength="16" name="phone">
		<label>Nueva clave: </label><input  type="password" maxlength="30" name="password1"  placeholder="Ingresa una Nueva Clave">
		<label>Confirmar nueva clave: </label><input type="password" maxlength="30" name="password2"  placeholder="Repite la clave">
		
		<input type="submit" value="Guardar cambios" /><a href="index.php">Volver</a>
	
</form>
</div>
</body>
</html>

<?php
	$user=$_SESSION['email'];
	//echo $user;
	$sql='';
	if(isset($_POST['name']))
		{
			$name=$_POST['name']; 
			if($name!='')
				if($sql!='')
					$sql.=",name='".$name."'";
				else
				
				 $sql="name='".$name."'";
				
		}
		if(isset($_POST['last_name']))
		{	
			$last_name=$_POST['last_name'];
			if($last_name!='')
			{
				if($sql!='')
					$sql.=",last_name='".$last_name."'";
				else
				
				 	$sql=" last_name='".$last_name."'";
				
		    }
		}
		
		if(isset($_POST['password1']))
		{	
			if($_POST['password1']!='')
			{	
				$password1=$_POST['password1'];
		
			if (isset($_POST['password2']))
			{
				if($_POST['password2']!='')
					$password2=$_POST['password2'];
			}
		
			if($password1==$password2)
			{
				if($sql!='')
					$sql.=", password='".$password1."'";
			
				else
					$sql="password='".$password1."'";
			}
			else
			{
				echo "Contraseña no coincide";
			}
			}
		}
		if(isset($_POST['phone']))
		{
			$phone=$_POST['phone'];
			if($phone!='')
				if($sql!='')
					$sql.=",phone='".$phone."'";
				else
				
				 $sql="phone='".$phone."'";

		}
		if($sql!='')
		{
			$consulta="UPDATE usuarios SET ".$sql."WHERE email='".$user."'";
		//	echo $consulta;
			$res=mysqli_query($conn,$consulta) or die(mysqli_error($conn));
			$conn->close();	
			header('Location: ver_perfil.php');
			
		}


?>	