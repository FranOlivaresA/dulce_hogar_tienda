<?php
/**
 * carrito.php
 * Página para mostrar el carrito de compras.
 * 
 * @package    Sistema de Reservas
 * @author     Francesca Olivares Aqueveque
 * @version    1.0
 * @date       03-05-2025
 */
// Iniciar sesión y conectar a la base de datos
session_start();
require_once 'includes/conexion.php';
include 'includes/header.php';

$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h1>Carrito de Compras</h1>

  <?php if (!empty($carrito)) : ?>
    <table>
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
      </tr>
      <?php foreach ($carrito as $item): 
        $sql = "SELECT nombre, precio FROM productos WHERE id_producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $item['id_producto']);
        $stmt->execute();
        $res = $stmt->get_result();
        $producto = $res->fetch_assoc();

        $subtotal = $producto['precio'] * $item['cantidad'];
        $total += $subtotal;
      ?>
        <tr>
          <td><?= $producto['nombre'] ?></td>
          <td><?= $item['cantidad'] ?></td>
          <td>$<?= number_format($subtotal, 0) ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="2"><strong>Total:</strong></td>
        <td><strong>$<?= number_format($total, 0) ?></strong></td>
      </tr>
    </table>

    <a href="pedido.php"><button>Confirmar Pedido</button></a>
  <?php else : ?>
    <p>Tu carrito está vacío.</p>
  <?php endif; ?>

  <a href="catalogo.php"><button>Volver al Catálogo</button></a>
</body>
</html>
