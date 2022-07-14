<!-- Implementacion php sobre actualizar el puntuaje del usuario -->
<?php
 $data = $_POST;
 echo $data['idUsuario'];
 echo $data['puntajeMax'];


 require 'conexion.php';

  $message = '';

  if (!empty($_POST['idUsuario'])) {
    $sql = "UPDATE puntajes SET puntajeMax=:puntajeMax WHERE idUsuario=:idUsuario";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idUsuario', $_POST['idUsuario']);
    $stmt->bindParam(':puntajeMax', $_POST['puntajeMax']);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
