<?php
/**
 * @file    login.php
 * @brief   Script para iniciar sesión de usuario.
 * @details Este script verifica las credenciales del usuario y redirige a la página correspondiente.
 * @package Sistema de Reservas
 * @author  Francesca Olivares Aqueveque
 * @version 1.0
 * @date    03-05-2025
 * @note    Este script es parte del sistema de reservas y gestión de pedidos.
 */
session_start();

// Mostrar errores 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Asegura que la ruta a conexion.php es correcta
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Verificar que el usuario exista
    $query = "SELECT id_usuario, nombre, password, tipo FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                // Guardar la información del usuario en la sesión
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['tipo'] = $usuario['tipo']; // Guardamos el tipo de usuario (cliente/admin)

                // Redirigir a la página correspondiente dependiendo del tipo de usuario
                if ($_SESSION['tipo'] === 'admin') {
                    header("Location: ../admin.html"); // Redirige a la página de administración
                } else {
                    header("Location: ../catalogo.php"); // Redirige al catálogo
                }
                exit; // Asegura salir después de redirigir
            } else {
                echo "<p>Contraseña incorrecta. <a href='../login.html'>Intentar de nuevo</a></p>";
            }
        } else {
            echo "<p>Correo no registrado. <a href='../login.html'>Intentar de nuevo</a></p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error en la consulta. Intente más tarde.</p>";
    }

    $conn->close();
} else {
    echo "<p>Acceso no permitido.</p>";
}
?>
