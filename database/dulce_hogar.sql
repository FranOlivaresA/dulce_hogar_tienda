-- @file esquema_dulce_hogar.sql
-- @brief Script de creación de base de datos para Tienda Dulce Hogar.
-- @details Este script define las tablas principales del sistema de pedidos, usuarios y pagos.
-- @author Francesca Olivares Aqueveque
-- @date 2025-05-03

-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS dulce_hogar;
USE dulce_hogar;

-- Tabla de usuarios
-- Almacena los datos de los usuarios registrados
CREATE TABLE usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único del usuario
  nombre VARCHAR(100),                       -- Nombre completo
  email VARCHAR(100),                        -- Correo electrónico
  password VARCHAR(255),                     -- Contraseña cifrada
  tipo ENUM('cliente', 'admin')              -- Tipo de usuario (cliente o administrador)
);

-- Tabla de productos
-- Contiene los productos disponibles para pedido
CREATE TABLE productos (
  id_producto INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único del producto
  nombre VARCHAR(100),                        -- Nombre del producto
  descripcion TEXT,                           -- Descripción del producto
  precio DECIMAL(10,2),                       -- Precio unitario
  stock INT                                   -- Stock disponible
);

-- Tabla de pedidos
-- Representa los pedidos realizados por los usuarios
CREATE TABLE pedidos (
  id_pedido INT AUTO_INCREMENT PRIMARY KEY,    -- Identificador del pedido
  id_usuario INT,                              -- Referencia al usuario que hizo el pedido
  fecha_reserva DATE,                          -- Fecha de la reserva
  hora_reserva TIME,                           -- Hora de la reserva
  estado VARCHAR(50),                          -- Estado del pedido (ej: pendiente, confirmado)
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Tabla de detalle de pedido
-- Almacena los productos incluidos en cada pedido
CREATE TABLE detalle_pedido (
  id_detalle INT AUTO_INCREMENT PRIMARY KEY,   -- Identificador del detalle
  id_pedido INT,                               -- Referencia al pedido
  id_producto INT,                             -- Referencia al producto
  cantidad INT,                                -- Cantidad del producto en el pedido
  subtotal DECIMAL(10,2),                      -- Subtotal = cantidad * precio_unitario
  FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
  FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

-- Tabla de pagos
-- Registra los pagos realizados por los pedidos
CREATE TABLE pagos (
  id_pago INT AUTO_INCREMENT PRIMARY KEY,     -- Identificador del pago
  id_pedido INT,                              -- Referencia al pedido
  metodo VARCHAR(50),                         -- Método de pago (ej: tarjeta, efectivo)
  estado VARCHAR(50),                         -- Estado del pago (ej: pagado, pendiente)
  fecha_pago DATE,                            -- Fecha en que se realizó el pago
  total DECIMAL(10,2),                        -- Total pagado
  FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido)
);

-- Inserción de productos iniciales
-- Carga de productos para pruebas y catálogo inicial
INSERT INTO productos (nombre, descripcion, precio, stock)
VALUES 
('Empanadas de Queso (3x1000)', 'Tres empanadas rellenas de queso fundido, ideales para compartir.', 1000, 50),
('Empanada Jamón-Queso', 'Empanada individual con jamón y queso.', 1000, 50),
('Empanada Napolitana', 'Empanada rellena estilo napolitano: tomate, jamón, queso y orégano.', 1500, 50),
('Berlines Fritos (Bandeja 10)', 'Bandeja de 10 berlines fritos rellenos de crema o mermelada.', 3000, 30);
