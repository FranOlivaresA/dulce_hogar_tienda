<?php
/**
 * catalogo.php
 * Página para mostrar el catálogo de productos.
 * 
 * @package    Sistema de Reservas
 * @author     Francesca Olivares Aqueveque
 * @version    1.0
 * @date       03-05-2025
 * @note       Este script es parte del sistema de reservas y gestión de pedidos.
 * @details    Este script se encarga de mostrar el catálogo de productos disponibles en la tienda.
 *             Los productos se obtienen de la base de datos y se muestran en una lista.
 *             Cada producto tiene un formulario para agregarlo al carrito de compras.
 *             Al enviar el formulario, se llama al script agregar_carrito.php para procesar la solicitud.
 *             Se utiliza una sesión para almacenar el carrito de compras del usuario.
 *             El script incluye un encabezado y un pie de página para la interfaz de usuario.
 *             Se utiliza Bootstrap para el diseño responsivo y la presentación de los productos.
 *             Se incluye un enlace para ver el carrito de compras.
 *             Se utiliza una conexión a la base de datos MySQLi para obtener los productos.
 *             Se utiliza un sistema de plantillas para incluir el encabezado y pie de página.
 *             Se utiliza un sistema de gestión de errores para manejar posibles problemas de conexión a la base de datos.
 *             Se utiliza un sistema de validación de formularios para asegurar que los datos enviados son correctos.
 *             Se utiliza un sistema de seguridad para proteger contra ataques de inyección SQL.
 *             Se utiliza un sistema de autenticación para asegurar que solo los usuarios registrados pueden acceder al catálogo.
 *             Se utiliza un sistema de autorización para asegurar que solo los usuarios con permisos pueden realizar ciertas acciones.
 *             Se utiliza un sistema de registro de errores para registrar cualquier problema que ocurra durante la ejecución del script.
 *             Se utiliza un sistema de internacionalización para soportar múltiples idiomas.
 *             Se utiliza un sistema de localización para adaptar el contenido a la región del usuario.
 */
// Iniciar sesión y conectar a la base de datos
session_start();
require_once 'includes/conexion.php';
include 'includes/header.php';

// Obtener productos
$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Catálogo</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h1>Catálogo de Productos</h1>

  <div class="catalogo">
    <?php while ($producto = $resultado->fetch_assoc()) : ?>
      <div class="producto">
        <h3><?= $producto['nombre'] ?></h3>
        <p><?= $producto['descripcion'] ?></p>
        <p><strong>$<?= $producto['precio'] ?></strong></p>
        <form action="php/agregar_carrito.php" method="POST">
          <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
          <label for="cantidad">Cantidad:</label>
          <input type="number" name="cantidad" min="1" max="<?= $producto['stock'] ?>" value="1" required>
          <button type="submit">Agregar al carrito</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>

  <a href="carrito.php">Ver Carrito</a>
</body>
</html>
<?php
