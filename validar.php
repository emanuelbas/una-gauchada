<?php
   $con= new mysqli("Localhost", "root", "root", "cuentas"); 
   if($con->connect_error){
       die("la conexion fallo" . $con->connect_error);   }
       $username=$_POST[$usuario];
       $pass=$_POST[$password];
    $sql = "SELECT * FROM usuario WHERE email = '$username'"; 
    $result = $con->query($sql);
    if ($result->num_rows > 0) {     
	 }
	 $row = $result->fetch_array(MYSQLI_ASSOC);
    if(($_POST["usuario"]==$usuario)&&($_POST["password"]==$password))
    {
       $_SESSION["usuario"]=$usuario;
       $_SESSION["password"]=$password;
        
    }
    else{
        header("Location: file-1.php");
    }
    header("Location: bienvenido.html");
    mysqli_close($conexion);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

