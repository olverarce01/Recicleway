<?php
 $data = $_POST;
 echo $data['correo'];
 echo $data['nombreMaterial'];


 require 'conexion.php';

  $message = '';

  if (!empty($_POST['correo'])) {
    $sql = "UPDATE rendimiento SET frecuenciaJuego=frecuenciaJuego+1 WHERE correo=:correo and nombreMaterial=:nombreMaterial";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->bindParam(':nombreMaterial', $_POST['nombreMaterial']);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
