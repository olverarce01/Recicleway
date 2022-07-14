<?php

  session_start();

  
  require 'conexion.php';

  if (!empty($_POST['correo']) && !empty($_POST['contrasena'])) {
    $records = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (!empty($results) && password_verify($_POST['contrasena'], $results['contrasena'])) {
      $_SESSION['user_id'] = $results['correo'];
    } else {
      $message = 'Los datos ingresados no son correctos';
    }
  }
 if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo');
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
    <title>Recycleway - Usuario</title>
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
          <form class="form-inline my-1 mr-md-2 mt-sm-0" action="historial.php" method="post" autocomplete="off">
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
            <a href="historial.php?logout=true">
            <button class="btn btn-outline-success mx-4 my-1 mr-sm-2">Cerrar sesión</button>
            </a>
        <?php endif; ?>        
      </nav>
    </header>
    <?php if(!empty($message)): ?>
    <p class="text-center mensaje"><?= $message ?></p>
    <?php endif; ?>
    <!-- h1 para el cuerpo de la pagina de historial -->
    <h1 id="tituloInformacion" class="text-center">Rendimiento en el juego</h1>
    <br><br>
    <!-- Tabla del usuario donde diga los materiales que ha fallado el usuario recientemente -->
    <table class="table table-striped bg-info text-white text-center w-75 mx-auto">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Material</th>
          <th scope="col">Contenedor correcto</th>
          <th scope="col">Porcentaje de fallo</th>
        </tr>
      </thead>

      <tbody>

        <?php

        if (isset($_SESSION['user_id'])) {
  
          $qs = $conn->prepare('SELECT *,ma.nombre as nombreMaterial,ma.imagen as imagenResiduo FROM (rendimiento as re INNER JOIN material as ma ON re.idMaterial =ma.id), contenedores c WHERE c.id=ma.idContenedor and re.idUsuario=:idUsuario');
          $qs->bindParam(':idUsuario', $user['id']);
          $qs->execute();
          $materiales = $qs;
          foreach($materiales as $material){
            if($material['frecuenciaJuego']!=0)
            {
            echo '<tr>
            <th scope="row"><img src="'.$material["imagenResiduo"].'" width="50" alt=""></th>
            <td>'.$material["nombreMaterial"].'</td>
           <td scope="row"><img src="'.$material["imagen"].'" width="50" alt=""></td>
            <td>'.round((($material['frecuenciaIncorrecta']/$material['frecuenciaJuego'])*100),2).'%</td>
            </tr>  ';
          }
          else{
            echo '<tr>
          <th scope="row"><img src="'.$material["imagenResiduo"].'" width="50" alt=""></th>
          <td>'.$material["nombreMaterial"].'</td>
          <td scope="row"><img src="'.$material["imagen"].'" width="50" alt=""></td>
          <td>'.(0).'%</td>
          </tr>  ';
          }
          }
        }else{
          echo '<tr>
            <td>Inicia sesión para ver estadística</td>
            </tr>  ';
        }
      
        ?>

      </tbody>

    </table>
    <!-- h1 para la tabla del usuario n°2 -->
    <h1 id="tituloInformacion" class="text-center"> ¡Cuidado! </h1>
    <!-- Tabla del usuario donde diga los materiales que mas ha fallado el usuario -->
    <table class="table table-striped w-75 mx-auto bg-danger text-white text-center">
      <p class= "lead mx-5 text-center" ><strong style="color:white"> Estos son los 4 materiales que mas se ha equivocado de contenedor: </strong></p>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Material</th>
          <th scope="col">Contenedor correcto</th>
          <th scope="col">Porcentaje de fallo</th>
        </tr>
      </thead>

      <tbody>
        <?php


        if (isset($_SESSION['user_id'])) {
          $qs = $conn->prepare('SELECT *, (re.frecuenciaIncorrecta/re.frecuenciaJuego) p, ma.nombre as nombreMaterial,ma.imagen as imagenResiduo FROM (rendimiento as re INNER JOIN material as ma ON re.idMaterial =ma.id), contenedores c WHERE c.id=ma.idContenedor and re.idUsuario=:idUsuario ORDER BY p DESC LIMIT 4');
          $qs->bindParam(':idUsuario', $user['id']);
   
          $qs->execute();
          $materiales = $qs;
          foreach($materiales as $material){


          if($material['frecuenciaJuego']!=0)
          {
          echo '<tr>
          <th scope="row"><img src="'.$material["imagenResiduo"].'" width="50" alt=""></th>
          <td>'.$material["nombreMaterial"].'</td>
          <td scope="row"><img src="'.$material["imagen"].'" width="50" alt=""></td>
          <td>'.round((($material['frecuenciaIncorrecta']/$material['frecuenciaJuego'])*100),2).'%</td>
          </tr>  ';


          }
          else{
            echo '<tr>
          <th scope="row"><img src="'.$material["imagenResiduo"].'" width="50" alt=""></th>
          <td>'.$material["nombreMaterial"].'</td>
          <td scope="row"><img src="'.$material["imagen"].'" width="50" alt=""></td>
          <td>'.(0).'%</td>
          </tr>  ';
          }
          }
        }else{
          echo '<tr>
            <td>Inicia sesión para ver estadística</td>
            </tr>  ';
        }
        ?>
        </tbody>

      </table>

    <!-- Parte del footer, pie de la pagina que contiene links para ir hacia arriba y a la pagina mas informacion -->
    <footer class="container bg-light rounded-lg py-2 px-5 borde-footer">
      <img class="logo" src="./img/logobeta1.png" alt="logo de la pagina">
      <p class="float-right"><a href="#inicio">Volver hacia arriba</a></p>
      <p>© 2022-2022 Company RecycleWay, Inc. · <a href="#">Informacion</a> · <a href="#">Terminos y condiciones</a></p>
    </footer>

    <!-- Scripts utilizados o que se van a utilizar a futuro-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>