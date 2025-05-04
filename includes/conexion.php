<?php
/**
 * @file    conexion.php
 * @brief   Script para conectar a la base de datos.
 * @details Este script establece la conexión a la base de datos MySQL utilizando MySQLi.
 * @package Sistema de Reservas
 * @author  Francesca Olivares Aqueveque
 * @version 1.0
 * @date    03-05-2025
 * @note    Este script es parte del sistema de reservas y gestión de pedidos.
 */
$host = 'localhost';
$usuario = 'root';
$contrasena = 'Kittie2800.';
$base_datos = 'dulce_hogar';

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
