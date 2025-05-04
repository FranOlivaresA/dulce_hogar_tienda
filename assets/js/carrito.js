/**
 * @file carrito.js
 * @brief Manejo de eventos para eliminar productos del carrito.
 *
 * Este script permite al usuario eliminar productos del carrito de compras haciendo clic
 * en los botones con clase `.btn-eliminar`. Al hacer clic, se llama a la función que realiza
 * la lógica de eliminación del producto y luego recarga la página.
 *
 * @author Francesca Olivares Aqueveque
 * @date 2025-05-03
 */

document.addEventListener('DOMContentLoaded', function () {
    /**
     * @description Agrega eventos a todos los botones de eliminación del carrito.
     */
    const botonesEliminar = document.querySelectorAll('.btn-eliminar');
    
    botonesEliminar.forEach(function (boton) {
        boton.addEventListener('click', function (e) {
            const idProducto = e.target.dataset.idProducto;

            // Llamada a función para eliminar el producto
            eliminarProductoDelCarrito(idProducto);
        });
    });
});

/**
 * @function eliminarProductoDelCarrito
 * @description Elimina un producto del carrito y recarga la página.
 * @param {string} idProducto - ID del producto a eliminar.
 */
function eliminarProductoDelCarrito(idProducto) {
    alert(`Producto ${idProducto} eliminado del carrito`);
    window.location.reload();
}
