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
<!doctype html>
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
    <title>Recycleway - Pagina principal</title>
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
          <form class="form-inline my-1 mr-md-2 mt-sm-0" action="index.php" method="post">
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
 
    <!-- Contenido main de la pagina principal -->
    <main role="main pt-2" class="main">
      <!-- Contenido div que se encarga de los items del carrusel, serie de dispositivas que recorre una serie de contenido -->
      <div id="myCarousel" class="carousel slide pb-5" data-interval="false">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class=""></li>
          <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        </ol>
        <!-- Contenido div que se encarga de las tres dispositivas del carrusel -->
        <div class="carousel-inner">
          <!-- Item n°1 - carrusel -->
          <div class="carousel-item px-5">
      	    <div class="row featurette pt-2">
              <div class="col-md-6 text-center mt-5">
                <h2 class="featurette-heading">Información. <span class="text-muted">Guia detallada de los materiales reciclables.</span></h2>
                <p class="lead">Mediante esta sección podras informarte de los distintos materiales y su contenedor correspondiente.</p>
		            <p><a class="btn btn-lg btn-primary btn-lg " href="informacion.php">Información</a></p>
              </div>    
              <div class="col-12 col-md-6 pb-2">
                <img class="mx-auto d-block w-75 h-100" src="./img/informacion.png" alt="contenedores de reciclaje" >
              </div>
            </div>
          </div>
          <!-- Item n°2 - carrusel -->
          <div class="carousel-item active px-5">
            <div class="row featurette pt-2">
              <div class="col-12 col-md-6 pb-2">
                <video controls autoplay loop width="500" class="mx-auto d-block w-100 h-100">
                  <source src="./juego.mp4" type="video/mp4">
                </video>
              </div>
              <div class="col-md-6 text-center mt-5">
		            <h2 class="featurette-heading">!!Juega Ya¡¡<span class="text-muted"> Entretención y aprendizaje.</span></h2>
                <p class="lead">Juega y diviertete, destacate entre los demas con el mejor puntaje, aprende a reciclar.</p>
                <p><a class="btn btn-lg btn-primary btn-lg " href="juego.php">Jugar</a></p>
              </div>
            </div>
          </div>
          <!-- Item n°3 - carrusel -->
          <div class="carousel-item px-5">
            <div class="row featurette pt-2">
              <div class="col-md-6 text-center mt-5">
                <h2 class="featurette-heading">Registrate. <span class="text-muted">Crea una cuenta.</span></h2>
                <p class="lead">Crea una cuenta personal para poder guardar tu progreso.</p>
                <p><a class="btn btn-lg btn-primary btn-lg " href="registrar.php">Registrate</a></p>
              </div>
              <div class="col-12 col-md-6 pb-2">
                <img class="mx-auto d-block w-75 h-100" src="./img/historial.png" alt="estadistica del jugador">
              </div>
            </div> 
          </div>
          <!-- Botones que cambian el contenido item del carrusel -->
          <button class="carousel-control-prev" type="button" data-target="#myCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-target="#myCarousel" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
          </button>
        </div>
      </div>
      <!-- Fila de los items de las cartas  -->
      <div class="row pb-4 rounded-lg">
        <!-- Item de carta n°1 -->
        <div class="py-2 mx-auto px-0">
          <div class="card" style="width: 18rem;">
            <img src="./img/reciclaje.png" class="card-img-top p-3" alt="simbolo reciclaje">
            <div class="card-body">
              <h5 class="card-title">La importancia de reciclar</h5>
              <p class="card-text">Estas acciones por muy pequeñas que sean van en ayuda del entorno, es por ello que debemos de fomentarlas con todos.</p>
            </div>
          </div>
        </div>
        <!-- Item de carta n°2 -->
        <div class="py-2 mx-auto px-0">
          <div class="card" style="width: 18rem;">
            <img src="./img/basura playa.png" class="card-img-top p-3" alt="basura playa">
            <div class="card-body">
              <h5 class="card-title">Problemas del no-reciclaje</h5>
              <p class="card-text">En el mundo en el que vivimos los recursos son limitados y el no reciclar nos invade de desechos estos pueden dañar la salud de las personas.</p>
            </div>
          </div>
        </div>
        <!-- Item de carta n°3 -->
        <div class="py-2 mx-auto px-0">
          <div class="card" style="width: 18rem;">
            <img src="./img/pagina web.png" class="card-img-top p-3" alt="juego">
            <div class="card-body">
              <h5 class="card-title">Como te ayuda una web</h5>
              <p class="card-text">Esto es gracias a la informacion que procionan las web y los distos metodos de reciclar, para este caso es el de un videojuego que te indica donde debes de reciclar los desechos.</p>
            </div>
          </div>
        </div>
        <!-- Item de carta n°4 -->
        <div class="py-2 mx-auto px-0">
          <div class="card" style="width: 18rem;">
            <img src="./img/planeta.png" class="card-img-top p-3" alt="planeta">
            <div class="card-body">
              <h5 class="card-title">Ayuda a tu planeta</h5>
              <p class="card-text">Todos compartimos el planeta y tarde o temprano tendremos familiares y no queremos dejar como recuerdo solo desechos, por eso demos de cuidar nuestro planeta.</p>
            </div>
          </div>
        </div>
      </div>   
    </main>
    
    <!-- Parte del footer, pie de la pagina que contiene links para ir hacia arriba y a la pagina mas informacion -->
    <footer class="container bg-light rounded-lg py-2 px-5 borde-footer">
      <img class="logo" src="./img/logobeta1.png" alt="logo de la pagina">
      <p class="float-right"><a href="#inicio">Volver hacia arriba</a></p>
      <p>© 2022-2022 Company RecycleWay, Inc. · <a href="#">Informacion</a> · <a href="#">Terminos y condiciones</a></p>
    </footer>

    <!-- Scripts utilizados o que se van a utilizar a futuro-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Script que "normaliza" las alturas de los elementos del carrusel de Bootstrap -->
    <script type="text/javascript">
      function normalizeSlideHeights() {
        $('.carousel').each(function(){
          var items = $('.carousel-item', this);
          // Reinicia la altura
          items.css('min-height', 0);
          // Asigna la altura
          var maxHeight = Math.max.apply(null, 
            items.map(function(){
              return $(this).outerHeight()}).get() );
          items.css('min-height', maxHeight + 'px');
        })
      }
      $(window).on(
        'load resize orientationchange', 
        normalizeSlideHeights);   
    </script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
