<?php
 $data = $_POST;
 echo $data['correo'];
 echo $data['puntajeMax'];


 require 'conexion.php';

  $message = '';

  if (!empty($_POST['correo'])) {
    $sql = "UPDATE puntajes SET puntajeMax=:puntajeMax WHERE correo=:correo";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->bindParam(':puntajeMax', $_POST['puntajeMax']);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
