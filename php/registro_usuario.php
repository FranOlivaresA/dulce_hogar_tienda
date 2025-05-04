<?php
/**
 * registro_usuario.php
 * Script para registrar un nuevo usuario en la base de datos.
 * 
 * @package    Sistema de Reservas
 * @author     Francesca Olivares Aqueveque
 * @version    1.0
 * @date       03-05-2025
 * @note       Este script es parte del sistema de reservas y gestión de pedidos.
 * @details    Este script recibe los datos del formulario de registro, los valida y los inserta en la base de datos.
 *             Si el registro es exitoso, redirige al usuario a la página de inicio de sesión.
 *             Si hay un error, muestra un mensaje de error.
 */
// Iniciar sesión y conectar a la base de datos
require_once '../includes/conexion.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, email, password, tipo) VALUES (?, ?, ?, 'cliente')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $password);
$stmt->execute();

header("Location: ../login.html");
?>
