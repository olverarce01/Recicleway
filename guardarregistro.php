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
    <title>Recycleway - Registrado </title>
  </head>
  <body>
    <!-- Parte del Header, este contendra la barra de navegacion, al clickear el logo se devolvera a la pagina principal
    Tendra 4 links de navegacion, "Jugar ahora", "Informacion", "Registrarse" y "Historial" donde se muestra si se inicio sesion
    Tambien una seccion para que el usuario pueda ingresar a su cuenta -->
    <header class="header pb-md-0 borde-header mb-2">
      <nav class="navbar navbar-expand-md navbar-light bg-light rounded-lg">
        <!-- Logo de la pagina -->
        <a class="navbar-brand" href="index.html" name="inicio"><img class="logo" src="./img/logobeta1.png" alt="logo de la pagina"></a>
        <!-- Opcion que entrega otra barra de navegacion cuando si tenga una distancia de pantalla menor a la pagina -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Contenido del div, donde involucra los links de navegacion -->
        <div class="navbar-collapse collapse show" id="navbarCollapse">
          <!-- Lista no ordenada que contiene los links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="juego.html">Jugar ahora<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="informacion.html">Información</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="registrar.html">Registrate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="historial.html">Historial</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Implementacion php -->
      <?php
        include "conexion.php";
            $sql = "INSERT INTO basededatosproyecto.usuario (id, Nombre, Apellido, Correo, Contraseña)
            VALUES ( '', '$_POST[Nombre]', '$_POST[Apellido]', '$_POST[Correo]', '$_POST[Contraseña]' ) ";

            if ($conn->query($sql) === TRUE){
              echo '<br><div row ejemplos w-100 style="text-align: center"> <p class="lead" style="color:white; font-size: 30px;"> Registro agregado satisfactoriamente </p> </div> <br> ';
            }else{
              echo "Error: ". $sql . "<br>" . $conn->error;
            }

            $conn->close();
        ?>

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
