<?php
/**
 * procesar_pedido.php
 * Script para procesar el pedido y guardar en la base de datos.
 * 
 * @package    Sistema de Reservas
 * @author     Francesca Olivares Aqueveveque
 * @version    1.0
 * @date       03-05-2025
 * @note       Este script es parte del sistema de reservas y gestión de pedidos.
 * @details    Este script procesa el pedido realizado por el usuario, guarda la información en la base de datos y redirige al usuario a la página de pago simulado.
 */
// Iniciar sesión y conectar a la base de datos
session_start();
require_once '../includes/conexion.php';

if (!isset($_SESSION['id_usuario']) || empty($_SESSION['carrito'])) {
    header("Location: ../carrito.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$carrito = $_SESSION['carrito'];

// Insertar pedido
$sql = "INSERT INTO pedidos (id_usuario, fecha_reserva, hora_reserva, estado) VALUES (?, ?, ?, 'pendiente')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $id_usuario, $fecha, $hora);
$stmt->execute();
$id_pedido = $stmt->insert_id;

// Insertar detalle del pedido
foreach ($carrito as $item) {
    $sql = "SELECT precio FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item['id_producto']);
    $stmt->execute();
    $res = $stmt->get_result();
    $producto = $res->fetch_assoc();

    $subtotal = $producto['precio'] * $item['cantidad'];

    $sql_detalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, subtotal) VALUES (?, ?, ?, ?)";
    $stmt_detalle = $conn->prepare($sql_detalle);
    $stmt_detalle->bind_param("iiid", $id_pedido, $item['id_producto'], $item['cantidad'], $subtotal);
    $stmt_detalle->execute();
}

// Vaciar carrito
unset($_SESSION['carrito']);

header("Location: ../pago_simulado.php?id_pedido=$id_pedido");
exit;
