<?php
/**
 * pedido.php
 * Página para confirmar el pedido.
 * 
 * @package    Sistema de Reservas
 * @author     Francesca Olivares Aqueveque
 * @version    1.0
 */
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
  header('Location: login.html');
  exit;
}
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmar Pedido</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h1>Confirmar Pedido</h1>

  <form action="php/procesar_pedido.php" method="POST">
    <label>Fecha de reserva:</label>
    <input type="date" name="fecha" required>

    <label>Hora de reserva:</label>
    <input type="time" name="hora" required>

    <button type="submit">Finalizar Pedido</button>
  </form>

  <a href="carrito.php"><button>Volver al Carrito</button></a>
</body>
</html>
