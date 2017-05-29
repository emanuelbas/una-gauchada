<?php  
  SESSION_START();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Iniciar sesion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/estilos.css">
  

</head>
<body>
<header class="banner row-fluid">
  <div class="image-banner">
      <img src="images/banner.png"></img>
  </div>
</header>
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
       <?php
      //Si hay usuario logueado entonces me muestra las funciones
  //Sino me muestra registrar e iniciar
      if ((isset($_SESSION['email']))){ 
        echo '<li><a href="comprar_credito.html">Comprar credito</a></li> &nbsp;'
            .'<li><a href="cerrar_sesion.php">Cerrar sesion</a></li> &nbsp;'
            .'<li><a href="publicar_gauchada.php">Publicar gauchada</a></li> &nbsp;';
      } 
    ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php
      //Si hay usuario logueado entonces me muestra las funciones
  //Sino me muestra registrar e iniciar
      if (!(isset($_SESSION['email']))){ ?>
        <li><a href="crear_cuenta.html"><span class="glyphicon glyphicon-user"></span> Crear una cuenta</a></li>
        <li><a href="iniciar_sesion.html"><span class="glyphicon glyphicon-log-in"></span>Iniciar sesion</a></li>
      <?php 
        }
      ?>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid">
  <h3>Navbar With Dropdown</h3>
  <p>This example adds a dropdown menu for the "Page 1" button in the navigation bar.</p>
   <div class="row">
    <div class="col-sm-4" style="background-color:lavender;">.col-sm-4</div>
    <div class="col-sm-4" style="background-color:lavenderblush;">
      <header>
      <div><img src="images/logo.png" width="70" alt="logo">
      <h2 align="center"> Inicio de sesion </h2></div>
    </header>
    
        <br/><br/><br/><br/>
    
        <form method ="post" action ="validar_usuario.php">
            <DIV ALIGN = CENTER>
        Correo: <input REQUIRED type ="text" name="email"/><br/>        
        Clave:  <input REQUIRED type ="password" name="pw"><br/>
        <input type="submit" value="Enviar">
        <a href="index.php">Olvide mi clave, enviame un correo</a>
        <a href="index.php">Cancelar</a>
      </DIV>
        </form>
        
    <footer>
      <p>Grupo 34 - 2017</p>
    </footer>

    </div>
    
    <div class="col-sm-4" style="background-color:lavender;">.col-sm-4</div>
  </div>
</div>

</body>
</html>