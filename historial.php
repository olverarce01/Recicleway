<?php

  session_start();

  
  require 'conexion.php';

  if (!empty($_POST['correo']) && !empty($_POST['contrasena'])) {
    $records = $conn->prepare('SELECT correo, contrasena FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && $_POST['contrasena']==$results['contrasena']) {
      $_SESSION['user_id'] = $results['correo'];
    } else {
      $message = 'Sorry, those credentials do not match';
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

    <?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
    <?php endif; ?>


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
            <li class="nav-item">
              <a class="nav-link" href="registrar.php">Registrate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="historial.php">Historial</a>
            </li>
          </ul>
        </div>
        <!-- Formulario para iniciar sesion -->
        <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="form-login">
          <form class="form-inline my-1 mr-md-2 mt-sm-0" action="historial.php" method="post">
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
             <br> Welcome. <?= $user['correo']; ?>
            <br>You are Successfully Logged In
            <a href="cerrarSesion.php">
            Logout
            </a>
        <?php endif; ?>        
      </nav>
    </header>

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
        <tr>
          <th scope="row"><img src="./img/caja.png" width="50" alt="caja"></th>
          <td>Caja</td>
          <td scope="row"><img src="./img/contenedor azul.png" width="50" alt="contenedor azul"></td>
          <td>0%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/bateria.png" width="50" alt="bateria"></th>
          <td>Bateria</td>
          <td scope="row"><img src="./img/contenedor rojo.png" width="50" alt="contenedor rojo"></td>
          <td>98%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/pasta dental.png" width="50" alt="pasta dental"></th>
          <td>Pasta dental</td>
          <td scope="row"><img src="./img/contenedor gris oscuro.png" width="50" alt="contenedor gris oscuro"></td>
          <td>76%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/teclado.png" width="50" alt="teclado"></th>
          <td>Teclado</td>
          <td scope="row"><img src="./img/contenedor purpura.png" width="50" alt="contenedor purpura"></td>
          <td>85%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/botella de vidrio.png" width="50" alt="botella vidrio"></th>
          <td>Botella de vidrio</td>
          <td scope="row"><img src="./img/contenedor verde.png" width="50" alt="contenedor verde"></td>
          <td>25%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/manzana.png" width="50" alt="manzana"></th>
          <td>Manzana</td>
          <td scope="row"><img src="./img/contenedor cafe.png" width="50" alt="contenedor cafe"></td>
          <td>90%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/tetrapack leche.png" width="50" alt="tetrapack leche"></th>
          <td>Tetrapack de leche</td>
          <td scope="row"><img src="./img/contenedor cafe claro.png" width="50" alt="contenedor cafe claro"></td>
          <td>56%</td>
        </tr>
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
        <tr>
          <th scope="row"><img src="./img/bateria.png" width="50" alt="bateria"></th>
          <td>Bateria</td>
          <td scope="row"><img src="./img/contenedor rojo.png" width="50" alt="contenedor rojo"></td>
          <td>98%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/pasta dental.png" width="50" alt="pasta dental"></th>
          <td>Pasta dental</td>
          <td scope="row"><img src="./img/contenedor gris oscuro.png" width="50" alt="contenedor gris oscuro"></td>
          <td>76%</td>
          </tr>

        <tr>
          <th scope="row"><img src="./img/teclado.png" width="50" alt="teclado"></th>
          <td>Teclado</td>
          <td scope="row"><img src="./img/contenedor purpura.png" width="50" alt="contenedor purpura"></td>
          <td>85%</td>
        </tr>

        <tr>
          <th scope="row"><img src="./img/manzana.png" width="50" alt="manzana"></th>
          <td>Manzana</td>
          <td scope="row"><img src="./img/contenedor cafe.png" width="50" alt="contenedor cafe"></td>
          <td>90%</td>
        </tr>

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