<?php
/**
 * @file    header.php
 * @brief   Encabezado común para todas las páginas.
 * @details Este archivo incluye la configuración de sesión y el encabezado HTML.
 * @package Sistema de Reservas
 * @author  Francesca Olivares Aqueveque
 * @version 1.0
 * @date    03-05-2025
 * @note    Este archivo es parte del sistema de reservas y gestión de pedidos.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Dulce Hogar'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
</head>
<body>
    <header>
        <h2>Dulce Hogar</h2>
        <?php if (isset($_SESSION['id_usuario'])): ?>
            <nav class="menu-usuario">
                <span>Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                <a href="catalogo.php">Catálogo</a>
                <a href="carrito.php">Carrito</a>
                <a href="php/logout.php" class="btn-logout">Cerrar sesión</a>
            </nav>
        <?php endif; ?>
    </header>
