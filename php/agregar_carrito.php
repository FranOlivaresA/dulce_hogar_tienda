<?php
/**
 * @file    agregar_carrito.php
 * @brief   Script para agregar productos al carrito de compras.
 * @details Este script recibe el ID del producto y la cantidad, y los agrega al carrito de compras almacenado en la sesión.
 * @package Sistema de Reservas
 * @author  Francesca Olivares Aqueveque
 * @version 1.0
 * @date    03-05-2025
 * @note    Este script es parte del sistema de reservas y gestión de pedidos.
 */
session_start();

$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$producto_existente = false;
foreach ($_SESSION['carrito'] as &$item) {
    if ($item['id_producto'] == $id_producto) {
        $item['cantidad'] += $cantidad;
        $producto_existente = true;
        break;
    }
}

if (!$producto_existente) {
    $_SESSION['carrito'][] = [
        'id_producto' => $id_producto,
        'cantidad' => $cantidad
    ];
}

header('Location: ../carrito.php');
exit;
?>