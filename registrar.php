<?php

  require 'conexion.php';

  $message = '';

  if (!empty($_POST['correo']) && !empty($_POST['contrasena'])) {
    $sql = "INSERT INTO usuarios (id,nombre,apellido,correo,contrasena) VALUES (NULL,:nombre, :apellido,:correo,:contrasena)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':correo', $_POST['correo']);


    $contrasenaHash=password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
   // $contrasena = password_hash(, PASSWORD_BCRYPT);


    $stmt->bindParam(':contrasena', $contrasenaHash);

    if ($stmt->execute()) {
          $message = 'La cuenta se agrego';
          $records = $conn->prepare('SELECT id FROM usuarios WHERE correo = :correo');
          $records->bindParam(':correo', $_POST['correo']);
          $records->execute();
          $results = $records->fetch(PDO::FETCH_ASSOC);
          if (!empty($results)) {
            $idUsuario=$results['id'];


            $sql = "INSERT INTO puntajes (id,idUsuario,puntajeMax) VALUES (NULL,:idUsuario, :puntajeMax)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $puntajeMax=0;
            $stmt->bindParam(':puntajeMax', $puntajeMax);
            $stmt->execute();



            $qs = $conn->prepare('SELECT id FROM material');
            $qs->execute();
            $materiales = $qs;
            foreach($materiales as $material){
              $sql = "INSERT INTO rendimiento (id,idUsuario,idMaterial,frecuenciaJuego,frecuenciaIncorrecta) VALUES (NULL,:idUsuario,:idMaterial,:frecuenciaJuego,:frecuenciaIncorrecta)";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':idUsuario', $idUsuario);
              $stmt->bindParam(':idMaterial', $material["id"]);
              $frecuencias=0;
              $stmt->bindParam(':frecuenciaJuego', $frecuencias);
              $stmt->bindParam(':frecuenciaIncorrecta', $frecuencias);
              $stmt->execute(); 
            }
          }
    } else {
      $message = 'No se pudo agregar la cuenta';

      $records = $conn->prepare('SELECT correo, contrasena FROM usuarios WHERE correo = :correo');
      $records->bindParam(':correo', $_POST['correo']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

      $user = null;

      if (count($results) > 0) {
        $message=$message .' porque el correo ya esta usado';
      }

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
    <title>Recycleway - Registrarse</title>
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
            <li class="nav-item">
              <a class="nav-link" href="registrar.php">Registrate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="historial.php">Historial</a>
            </li>
          </ul>
        </div>     
      </nav>
    </header>

  <?php if(!empty($message)): ?>
      <p class="text-center mensaje"> <?= $message ?></p>
    <?php endif; ?>
    <!-- Contenido div main de registrar -->
    <div class="main" role="main">
      <!-- Contenido div donde estara el formulario -->
      <div class="formulario py-4 my-3 mx-2 px-4 rounded-lg">
        <form action="registrar.php" method="post">

          <!-- filas de dos que tiene los inputs nombre y apellido -->
          <div class="form-row buscador">
            <div class="col-md-12 mb-3">
              <label for="validationServer01">Nombre</label>
              <input type="text" class="form-control is-invalid w-50" id="validationServer01" placeholder="Nombre" value="" name="nombre" required>

              <!-- Muestra de ejemplo cuando se completa el input -->
              <div class="valid-feedback">
              Se ve bien!
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationServer02">Apellido</label>
              <input type="text" class="form-control is-invalid w-50" id="validationServer02" placeholder="Apellido" value="" name="apellido" required>

              <div class="valid-feedback">
              Se ve bien!
              </div>
            </div>
          </div>
          <!-- Filas de dos donde contiene el input del correo y la contraseña-->
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationServer01">Correo</label>
              <input type="email" class="form-control is-invalid w-50" id="validationServer01" placeholder="Correo" value="" name="correo" required>
              <div class="valid-feedback">
              Se ve bien!
              </div>  
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationServer02">Contraseña</label>

              <input type="password" class="form-control is-invalid w-50" id="validationServer02" placeholder="Contraseña" value="" name="contrasena" required>
              <div class="valid-feedback">
              Se ve bien!
              </div>
            </div>
          </div>
          <!-- Clase contenedor div donde contiene el check input de aceptar terminos y condiciones, si no esta aceptado diria el mensaje "Debe estar de acuerod antes de enviar" -->
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" name="terminos" onclick="handleClick(this)" required>
              <label class="form-check-label" for="invalidCheck3">
              Aceptar terminos y servicios
              </label>
              <div id="invalidCheck3Feedback" class="invalid-feedback">
              Debe estar de acuerdo antes de enviar.
              </div>
            </div>
          </div>
          <!-- Boton para registrar el formulario -->
          <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
      </div>
    </div>

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
    <script type="text/javascript">
      $('input[name=nombre]').change( function () {
        if(this.value.length>=3){
          $('input[name=nombre]').removeClass("is-invalid");
          $('input[name=nombre]').addClass("is-valid");
        }else{
          $('input[name=nombre]').removeClass("is-valid");
          $('input[name=nombre]').addClass("is-invalid");
        }
      });
      $('input[name=apellido]').change( function () {
        if(this.value.length>=3){
          $('input[name=apellido]').removeClass("is-invalid");
          $('input[name=apellido]').addClass("is-valid");
        }else{
          $('input[name=apellido]').removeClass("is-valid");
          $('input[name=apellido]').addClass("is-invalid");
        }
      });
      $('input[name=correo]').change( function () {
        if(this.value.length>=3){
          $('input[name=correo]').removeClass("is-invalid");
          $('input[name=correo]').addClass("is-valid");
        }else{
          $('input[name=correo]').removeClass("is-valid");
          $('input[name=correo]').addClass("is-invalid");
        }
      });
      $('input[name=contrasena]').change( function () {
        if(this.value.length>=3){
          $('input[name=contrasena]').removeClass("is-invalid");
          $('input[name=contrasena]').addClass("is-valid");
        }else{
          $('input[name=contrasena]').removeClass("is-valid");
          $('input[name=contrasena]').addClass("is-invalid");
        }
      });
      
      function handleClick(cb){
        if(cb.checked)
        {
            $('input[name=terminos]').removeClass("is-invalid");
            $('input[name=terminos]').addClass("is-valid");
        }else{
          $('input[name=terminos]').removeClass("is-valid");
          $('input[name=terminos]').addClass("is-invalid");
        }
      }
    </script>
  </body>
</html>
