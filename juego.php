<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuario, puntajeMax FROM puntajes p INNER JOIN usuarios u on p.idUsuario = u.id  and correo = :correo');
    $records->bindParam(':correo', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }else{
    header('Location: /reciclaje-main');
  }
?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/estilosJuego.css">
    <!-- Estilos de fontawesome, cargado con todos los estilos-->
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script defer src="fontawesome/js/all.js"></script>
    <link rel="icon" href="favicon.ico">
    <!-- Titulo de la pagina --> 
    <title>Recicla</title>
</head>
<!-- Declara que cuando mantenemos presionado el click primario, podemos subir o bajar el volumen mediante el movimiento del mouse -->
<body onkeydown="move(event)">

 

    <div id="contenedor">
        <a class="navbar-brand" href="index.php" name="inicio"><img class="logo" src="./img/logobeta1.png" alt="logo de la pagina" width="300px"></a>
        <!-- Puntaje del jugador, perdera puntos si el elemento a poner en contenedor choca con los elementos flotantes -->
        <p id="puntaje">Puntaje: - /<?=$user['puntajeMax']?></p> 
        <!-- Contenedor div del reproductor-->
        <div id="reproductor">
            <!-- Proporciona informacion en el navegador para cambiar de musica cuando el jugador da click en los botones del reproductor -->
            <audio id="player" ontimeupdate="updateProgress();">
            <source  id="source">   
            Audio no soportado  
            </audio>
            <div id="controls">
                <!-- Duracion de la musica -->
                <div class="timer" id="timer">
                    &nbsp;
                </div>
                <div class="volumen">
                    Vol: 
                    <i class="fas fa-volume-down"></i> 
                    <input type="range" name="volumen" id="volumen" min="0" max="1" step="0.01" value="0.75"> 
                    <i class="fas fa-volume-up"></i>
                </div>
                <!-- Iconos de musica del reproductor, al darles click activara sus funciones de la anterior musica,
                activar/pausar musica y siguiente musica -->
                <i class="fas fa-backward fa-2x" onclick="prevMusic();"></i>
                <i class="far fa-play-circle fa-2x" onclick="togglePlay();" id="iconPlay"></i> 
                <i class="fas fa-forward fa-2x" onclick="nextMusic();"></i>
                <br>
                <!-- Nombre de la musica que se esta escuchando actualmente -->
                <span id="currentPlay"></span><br>
                <progress id="progress" value="0" max="100" ></progress>
            </div>
        </div>
        <button id="jugar">Jugar</button>
        
    </div>
    <p id="comentarios">-</p> 
    <!-- Parte del videojuego, se enfoca en canvas -->
    <canvas id="canvas"></canvas>

    <!-- Scripts utilizados en el videojuego-->
    <script src="./js/reproductor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">

        var idUsuario="<?=$user['idUsuario']?>";
        var puntajeMaxT="<?=$user['puntajeMax']?>";
        
        function actualizarPuntajeMax(puntajeMax){
            
     



        if(puntajeMaxT<puntajeMax){
            puntajeMaxT=puntajeMax;
            $.post('actualizarPuntaje.php',{idUsuario: idUsuario, puntajeMax:puntajeMax});
             
        }
        }

        function sumarFallo(nombreMaterial){
            $.post('sumarFallo.php',{idUsuario: idUsuario, nombreMaterial:nombreMaterial});
        }
        function sumarFrecuencia(nombreMaterial){
            $.post('sumarFrecuencia.php',{idUsuario: idUsuario, nombreMaterial:nombreMaterial});
        }
    </script>
    <script src="./js/funciones.js"></script>
    <script src="./js/juego.js"></script>
</body>
</html>
