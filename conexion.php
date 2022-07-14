<!-- Implementacion de conexion por la base de datos del usuario -->
<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'juego';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);

  
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>


