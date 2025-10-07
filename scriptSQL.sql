-- -----------------------------------------------------------------
-- Base de Datos para la Aplicación de Tienda de Computadoras
-- Versión Mejorada con Sistema de Usuarios
-- -----------------------------------------------------------------

-- Crear la base de datos si no existe para evitar errores
CREATE DATABASE IF NOT EXISTS tienda_computadoras;

-- Seleccionar la base de datos recién creada para todas las operaciones siguientes
USE tienda_computadoras;

-- -----------------------------------------------------------------
-- Tabla `categorias`
-- Almacena las categorías de productos (Laptops, Desktops, etc.).
-- Cada producto pertenece a una categoría.
-- -----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,                 -- ID único para cada categoría
    nombre VARCHAR(100) NOT NULL UNIQUE,               -- Nombre de la categoría (único)
    descripcion TEXT,                                  -- Descripción opcional de la categoría
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP      -- Fecha de creación
);

-- -----------------------------------------------------------------
-- Tabla `usuarios`
-- Almacena la información de los clientes registrados en la tienda.
-- Las contraseñas se guardan de forma segura con un hash.
-- -----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,                 -- ID único para cada usuario
    nombre VARCHAR(100) NOT NULL,                      -- Nombre completo del usuario
    email VARCHAR(150) NOT NULL UNIQUE,                -- Correo electrónico (único)
    password_hash VARCHAR(255) NOT NULL,               -- Contraseña hasheada (NUNCA guardar en texto plano)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP      -- Fecha de registro
);

-- -----------------------------------------------------------------
-- Tabla `productos`
-- Almacena los detalles de cada computadora.
-- Se relaciona con la tabla `categorias` a través de una clave foránea.
-- -----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,                 -- ID único para cada producto
    nombre VARCHAR(255) NOT NULL,                      -- Nombre del producto
    descripcion TEXT NOT NULL,                         -- Despción detallada
    precio DECIMAL(10, 2) NOT NULL,                    -- Precio con 2 decimales
    stock INT NOT NULL DEFAULT 0,                      -- Cantidad disponible en inventario
    imagen VARCHAR(255) NOT NULL,                      -- Nombre del archivo de imagen
    id_categoria INT NOT NULL,                         -- ID de la categoría a la que pertenece
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,     -- Fecha de añadido al catálogo
    
    -- Definición de la relación con la tabla `categorias`
    FOREIGN KEY (id_categoria) REFERENCES categorias(id) ON DELETE CASCADE
    -- ON DELETE CASCADE: Si se elimina una categoría, todos sus productos se eliminan automáticamente.
);

-- -----------------------------------------------------------------
-- Insertar datos de ejemplo (si las tablas están vacías)
-- Se usa INSERT IGNORE para no duplicar datos si el script se ejecuta varias veces.
-- -----------------------------------------------------------------

-- Insertar categorías de ejemplo
INSERT IGNORE INTO categorias (id, nombre, descripcion) VALUES
(1, 'Laptops', 'Computadoras portátiles para trabajo y estudio.'),
(2, 'Desktops', 'Computadoras de escritorio de alto rendimiento.'),
(3, 'Gaming', 'Equipos especializados para videojuegos.');

-- Insertar productos de ejemplo
INSERT IGNORE INTO productos (id, nombre, descripcion, precio, stock, imagen, id_categoria) VALUES
(1, 'Laptop ProBook 15', 'Intel Core i7, 16GB RAM, 512GB SSD. Perfecta para profesionales.', 1200.00, 15, 'laptop_probook.jpg', 1),
(2, 'Desktop WorkStation X1', 'Intel Core i9, 32GB RAM, 1TB NVMe SSD + 2TB HDD. Para las tareas más exigentes.', 2500.00, 8, 'desktop_x1.jpg', 2),
(3, 'Gaming Rig Beast', 'AMD Ryzen 7, NVIDIA RTX 4070, 32GB RAM DDR5. Domina cualquier juego.', 1800.00, 10, 'gaming_beast.jpg', 3),
(4, 'Laptop UltraSlim Air', 'Intel Core i5, 8GB RAM, 256GB SSD. Ligera y portátil.', 750.00, 25, 'laptop_air.jpg', 1);

-- Insertar un usuario de ejemplo para pruebas
-- El hash corresponde a la contraseña: 'password'
INSERT IGNORE INTO usuarios (id, nombre, email, password_hash) VALUES
(1, 'Cliente Prueba', 'cliente@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- -----------------------------------------------------------------
-- ¡Script completado!
-- La base de datos está lista para ser usada por la aplicación.
-- -----------------------------------------------------------------