<?php
/**
 * @file    logout.php
 * @brief   Script para cerrar sesión del usuario.
 * @details Este script destruye la sesión actual y redirige al usuario a la página de inicio.
 * @package Sistema de Reservas
 * @author  Francesca Olivares Aqueveque
 * @version 1.0
 * @date    03-05-2025
 * @note    Este script es parte del sistema de reservas y gestión de pedidos.
 */
session_start();
session_unset();  // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión

header("Location: ../index.html");  // Redirige al inicio
exit;
