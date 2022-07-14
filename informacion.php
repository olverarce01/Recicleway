<?php

  session_start();

  
  require 'conexion.php';

  if (!empty($_POST['correo']) && !empty($_POST['contrasena'])) {
    $records = $conn->prepare('SELECT correo, contrasena FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';


    if (!empty($results) && $_POST['contrasena']==$results['contrasena']) {
      $_SESSION['user_id'] = $results['correo'];
    } else {
      $message = 'Los datos ingresados no son correctos';
    }

  }
 if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT correo, contrasena FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
  if(isset($_GET['logout'])){

    session_unset();
    session_destroy();
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Estilos, css, bootstrap -->
    <link Type="text/css" rel="stylesheet" href="./css/bootstrap.min.css">
    <link Type="text/css" rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" href="favicon.ico">
    <!-- Titulo de la pagina -->
    <title>Recycleway - Informacion de contenedores</title>
  </head>
  <body>
     
    <!-- Parte del Header, este contendra la barra de navegacion, al clickear el logo se devolvera a la pagina principal
    Tendra 4 links de navegacion, "Jugar ahora", "Informacion", "Registrarse" y "Historial" donde se muestra si se inicio sesion
    Tambien una seccion para que el usuario pueda ingresar a su cuenta -->
    <header class="header pb-md-0 borde-header mb-2">
      <nav class="navbar navbar-expand-md navbar-light bg-light rounded-lg">
        <!-- Logo de la pagina -->
        <a class="navbar-brand" href="index.php" name="inicio"><img class="logo" src="./img/logobeta1.png" alt="logo de la pagina"></a>
        <!-- Opcion que entrega otra barra de navegacion cuando si tenga una distancia de pantalla menor a la pagina -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Contenido del div, donde involucra los links de navegacion -->
        <div class="navbar-collapse collapse show" id="navbarCollapse">
          <!-- Lista no ordenada que contiene los links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="juego.php">Jugar ahora<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="informacion.php">Información</a>
            </li>
             <?php if (!isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="registrar.php">Registrate</a>
            </li>
            <?php endif; ?>   
            <li class="nav-item">
              <a class="nav-link" href="historial.php">Historial</a>
            </li>
          </ul>
        </div>
        <!-- Formulario para iniciar sesion -->
        <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="form-login">
          <form class="form-inline my-1 mr-md-2 mt-sm-0" action="informacion.php" method="post">
            <div class="row">
              <div class="col">
                <i class="bi bi-file-earmark-person icono"></i>
                <input type="email" class="form-control my-1 w-md-25 w-sm-50" placeholder="Correo" name="correo">
                <i class="bi bi-lock-fill icono"></i>
                <input type="password" class="form-control my-1 w-md-25 w-sm-50" placeholder="Contraseña" name="contrasena">
                <button class="btn btn-outline-success my-1 mr-sm-2" type="submit">Acceder</button>
              </div>
            </div>
          </form>
        </div>   
        <?php else:?>
            <i class="bi bi-file-earmark-person icono mx-2"></i>
            <?= $user['correo']; ?>
            <a href="informacion.php?logout=true">
            <button class="btn btn-outline-success mx-4 my-1 mr-sm-2">Cerrar sesión</button>
            </a>
        <?php endif; ?>  
      </nav>
    </header>


    <?php if(!empty($message)): ?>
    <p class="text-center mensaje"><?= $message ?></p>
    <?php endif; ?>
    <!-- Contenido main de informacion -->
    <main role="main" class="main">
      <!-- Contenedor div que abarca a las filas de los elementos de los contenederes de basura y su informacion -->
      <div class="container marketing">
        <h1 id="tituloInformacion" class="text-center">Contenedores de acuerdo al material a reciclar</h1>

        <?php
        $qs = $conn->prepare('SELECT * FROM contenedores');
        $qs->execute();
        $contenedores=$qs;



        foreach($contenedores as $contenedor){
          echo '<div class="row featurette item">';
          echo 
          '
            <div class="col-md-7 contenedor">
              <h2 class="featurette-heading">'.$contenedor["nombre"].'</h2>
              <p class="lead">'.$contenedor["descripcion"].'</p>
            </div>
            <div class="col-md-5">
              <img class="mx-auto d-block" src="'.$contenedor["imagen"].'" alt="'.$contenedor["nombre"].'">                
            </div>
            <div class="row ejemplos w-100">
          ';   

        $qs2 = $conn->prepare('SELECT * FROM contenedores co INNER JOIN material ma ON co.id=ma.idContenedor AND co.nombre=:nombre ');
        $qs2->bindParam(':nombre', $contenedor['nombre']);
        $qs2->execute();
        $residuos=$qs2;

        foreach($residuos as $residuo){
        echo 
          '
            <div class="col-lg-4">
              <img src="'.$residuo["imagen"].'" width="100px" class="mx-auto d-block" alt="'.$residuo["nombre"].'">
              <h2 class="text-center">'.$residuo["nombre"].'</h2>
            </div>
          ';

        } 

          echo '</div> </div> <hr class="featurette-divider">';       
        }

        ?>
      </div>
    </main>

    <!-- Parte del footer, pie de la pagina que contiene links para ir hacia arriba y a la pagina mas informacion -->
    <footer class="container bg-light rounded-lg py-2 px-5 borde-footer">
      <img class="logo" src="./img/logobeta1.png" alt="logo de la pagina">
      <p class="float-right"><a href="#inicio">Volver hacia arriba</a></p>
      <p>© 2022-2022 Company RecycleWay, Inc. · <a href="#">Informacion</a> · <a href="#">Terminos y condiciones</a></p>
    </footer>

    <!-- Scripts utilizados o que se van a utilizar a futuro-->
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
