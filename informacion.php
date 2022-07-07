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
    <title>Recycleway - Informacion de contenedores</title>
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
             <br> Welcome. <?= $user['correo']; ?>
            <br>You are Successfully Logged In
            <a href="cerrarSesion.php">
            Logout
            </a>
        <?php endif; ?>   
      </nav>
    </header>

    <!-- Contenido main de informacion -->
    <main role="main" class="main">
      <!-- Contenedor div que abarca a las filas de los elementos de los contenederes de basura y su informacion -->
      <div class="container marketing">
        <h1 id="tituloInformacion" class="text-center">Contenedores de acuerdo al material a reciclar</h1>

        <!-- Fila de item n°1 - Contenedor amarillo -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor Amarillo (plásticos)</h2>
            <p class="lead">Todo tipo de envases y productos fabricados con plásticos 
            como botellas, envases de alimentación o bolsas. Las botellas y envases de 
            alimentos deben ser enjuagados y entregados secos.</p>
          </div>
          <div class="col-md-5">
            <img class="mx-auto d-block" src="./img/contenedor amarillo.png" alt="contenedor-de-plastico">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/envase de plastico agua.png" width="100px" alt="envase de plastico agua">
              <h2 class="text-center">Envase plastico de agua</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/envase plastico comida.png" width="100px" alt="envase de plastico comida">
              <h2 class="text-center">Envase plastico de comida</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/bolsa plastico.png" width="100px" alt="bolsa">
              <h2 class="text-center">Bolsa de plastico</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/vasos plasticos.png" width="100px" alt="vasos plasticos">
              <h2 class="text-center">Vasos plasticos</h2>
            </div>
          </div>
        </div>   
        <!-- Caracteristica que divide los items -->
        <hr class="featurette-divider">

        <!-- Fila de item n°2 - Contenedor azul -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor Azul (papel y cartón)</h2>
            <p class="lead">Se deposita todo tipo de papeles y cartones, como cajas 
            o envases de alimentos. Periódicos, revistas, papeles de envolver o folletos 
            publicitarios entre otros. Es recomendable plegar correctamente las cajas y envases 
            para almacenar la más residuos.</p>
          </div>
          <div class="col-md-5">
            <img src="./img/contenedor azul.png" class="mx-auto d-block" alt="contenedor azul">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img src="./img/papel.png" width="100px" class="mx-auto d-block" alt="papel">
              <h2 class="text-center">Papel</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/caja.png" width="100px" class="mx-auto d-block" alt="caja">
              <h2 class="text-center">Caja</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/papel de colores.png" width="100px" class="mx-auto d-block" alt="papel de colores">
              <h2 class="text-center">Papel de colores</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/folleto.png" width="100px" class="mx-auto d-block" alt="folleto">
              <h2 class="text-center">Folleto</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/periodico.png" width="100px" class="mx-auto d-block" alt="periodico">
              <h2 class="text-center">periodico</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/envase carton.png" width="100px" class="mx-auto d-block" alt="envase carton">
              <h2 class="text-center">Envase de carton</h2>
            </div>
          </div>
        </div>
        <hr class="featurette-divider">

        <!-- Fila de item n°3 - Contenedor gris claro -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor gris claro (Metales)</h2>
            <p class="lead">Se depositan latas de conservas y de refrescos. Deben 
            ser enjuagados y secados para su depósito.</p>
          </div>
          <div class="col-md-5">
            <img class="mx-auto d-block" src="./img/contenedor gris claro.png" alt="contenedor gris claro">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img src="./img/lata de bebida.png" width="100px" class="mx-auto d-block" alt="lata de bebida">
              <h2 class="text-center">lata de bebida</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/lata conserva.png" width="100px" class="mx-auto d-block" alt="lata de conserva">
              <h2 class="text-center">lata de conserva</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/lata de atun.png" width="100px" class="mx-auto d-block" alt="lata de atun">
              <h2 class="text-center">lata de atun</h2>
            </div>
            <div class="col-lg-4">
              <img src="./img/lata de cerveza.png" width="100px" class="mx-auto d-block" alt="lata de cerveza">
              <h2 class="text-center">lata de cerveza</h2>
            </div>
          </div>
        </div>   
        <hr class="featurette-divider">

        <!-- Fila de item n°4 - Contenedor verde -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor Verde (vidrio)</h2>
            <p class="lead">Se depositan envases de vidrio, como botellas de bebidas 
            alcohólicas, refresco y agua. No usar para cerámica o cristal.</p>
          </div>
          <div class="col-md-5">
            <img class="mx-auto d-block" src="./img/contenedor verde.png" alt="contenedor verde">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/botella de vidrio.png" width="100px" alt="botella de vidrio">
              <h2 class="text-center">botella de vidrio</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/botella de vidrio bebida.png" width="100px" alt="botella de vidrio bebida">
              <h2 class="text-center">botella de vidrio bebida</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/envases de vidrio.png" width="100px" alt="envase de vidrio">
              <h2 class="text-center">envase de vidrio</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/botella vino.png" width="100px" alt="botella de vino">
              <h2 class="text-center">botella de vino</h2>
            </div>
          </div>
        </div> 
        <hr class="featurette-divider">

        <!-- Fila de item n°5 - Contenedor beige -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor Beige (Cartón para bebidas)</h2>
            <p class="lead">Se depositan todos los envases de cartón (treta 
            pack) que contienen refrescos, leches, bebidas alcohólicas y alimentos.</p>
          </div>
          <div class="col-md-5">
            <img class="mx-auto d-block" src="./img/contenedor cafe claro.png" alt="contenedor cafe claro">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/tetrapack leche.png" width="100px" alt="tetrapack leche">
              <h2 class="text-center">tetrapack leche</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/tetrapack leche 2.png" width="100px" alt="tetrapack leche 2">
              <h2 class="text-center">tetrapack leche 2</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/tetrapack jugo.png" width="100px" alt="tetrapack jugo">
              <h2 class="text-center">tetrapack jugo</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/tetrapack desconocido.png" width="100px" alt="tetrapack general">
              <h2 class="text-center">tetrapack en general</h2>
            </div>
          </div>
        </div> 
        <hr class="featurette-divider">

        <!-- Fila de item n°6 - Contenedor rojo -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor Rojo (Desechos peligrosos)</h2>
            <p class="lead">Son considerados para almacenar residuos 
            peligrosos como baterías, pilas, aceites o medicamentos.
            </p>
          </div>
          <div class="col-md-5">
            <img class="mx-auto d-block" src="./img/contenedor rojo.png" alt="contenedor rojo">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/aceite.png" width="100px" alt="aceite">
              <h2 class="text-center">Aceite</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/bateria.png" width="100px" alt="bateria">
              <h2 class="text-center">Batería</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/pilas.png" width="100px" alt="pilas">
              <h2 class="text-center">Pilas</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/medicamentos.png" width="100px" alt="medicamentos">
              <h2 class="text-center">Medicamentos</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/medicamentos 2.png" width="100px" alt="mediamentos 2">
              <h2 class="text-center">Mas medicamentos</h2>
            </div>
          </div>
        </div> 
        <hr class="featurette-divider">

        <!-- Fila de item n°7 - Contenedor burdeo -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor Burdeo (Aparatos eléctricos y electrónicos)</h2>
            <p class="lead">Se depositan electrodomésticos 
            voluminosos, audio y video, computación y electrodomésticos pequeños.</p>
          </div>
          <div class="col-md-5">
            <img  class="mx-auto d-block" src="./img/contenedor purpura.png" alt="contenedor burdeo">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/parlante bluetooth.png" width="100px" alt="parlante">
              <h2 class="text-center">parlante bluetooth</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/laptop.png" width="100px" alt="laptop">
              <h2 class="text-center">laptop</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/teclado.png" width="100px" alt="teclado">
              <h2 class="text-center">teclado</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/celular.png" width="100px" alt="celular">
              <h2 class="text-center">celular</h2>
            </div>
          </div>
        </div> 
        <hr class="featurette-divider">

        <!-- Fila de item n°8 - Contenedor cafe oscuro -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor Cafe oscuro (Desechos orgánicos)</h2>
            <p class="lead">Se depositan restos de alimentos como pieles de 
              frutas, espinas de pescado, plantas, cáscaras de huevo o posos; o servilletas y 
              papel de cocina usados. No depositar objetos de cerámica, pañales, colillas, 
              chicles, toallitas húmedas, arena para mascotas, pelo, etc.</p>
          </div>
          <div class="col-md-5">
            <img class="mx-auto d-block" src="./img/contenedor cafe.png" alt="contenedor cafe">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/manzana.png" width="100px" alt="manzana">
              <h2 class="text-center">manzana</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/espina pescado.png" width="100px" alt="espina pescado">
              <h2 class="text-center">espina de pescado</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/cascara huevo.png" width="100px" alt="cascara huevo">
              <h2 class="text-center">cascara de huevo</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/servilleta.png" width="100px" alt="servilleta">
              <h2 class="text-center">servilleta</h2>
            </div>
          </div>
        </div> 
        <hr class="featurette-divider">

        <!-- Fila de item n°9 - Contenedor gris oscuro -->
        <div class="row featurette item">
          <div class="col-md-7 contenedor">
            <h2 class="featurette-heading">Contenedor gris oscuro (Restos de residuos)</h2>
            <p class="lead">Se depositan los residuos que no pueden ser 
            reciclados o que el mercado aún no está establecido.</p>
          </div>
          <div class="col-md-5">
            <img class="mx-auto d-block" src="./img/contenedor gris oscuro.png" alt="contenedor gris oscuro">                
          </div>
          <div class="row ejemplos w-100">
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/ceramica.png" width="100px" alt="ceramica">
              <h2 class="text-center">ceramica</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/pañal.png" width="100px" alt="pañal">
              <h2 class="text-center">pañal</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/colilla cigarro.png" width="100px" alt="colilla cigarro">
              <h2 class="text-center">colilla de cigarro</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/arena de mascota.png" width="100px" alt="arena mascota">
              <h2 class="text-center">arena de mascota</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/pasta dental.png" width="100px" alt="pasta dental">
              <h2 class="text-center">pasta dental</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/envoltorios.png" width="100px" alt="envoltorios">
              <h2 class="text-center">envoltorios</h2>
            </div>
            <div class="col-lg-4">
              <img class="mx-auto d-block" src="./img/mascarilla.png" width="100px" alt="mascarilla">
              <h2 class="text-center">mascarilla</h2>
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
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>