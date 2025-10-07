# Tienda de Computadoras con PHP y Tailwind CSS

Una aplicación web simple para la venta de computadoras, con un panel de administración para gestionar productos.

## Características

- **Catálogo de Productos:** Vista pública de todos los productos en una cuadrícula responsive.
- **Detalles del Producto:** Página individual para cada producto con su descripción completa.
- **Panel de Administración:**
  - Login simple para el administrador.
  - Añadir nuevos productos con imagen.
  - Eliminar productos existentes.
  - Listado de todos los productos.
- **Diseño Profesional:** Interfaz moderna y responsive construida con Tailwind CSS.
- **Base de Datos Relacional:** Uso de MySQL con tablas de `productos` y `categorias`.

## Requisitos

- XAMPP (o un servidor web local con Apache, PHP y MySQL).
- Un navegador web moderno.

## Instalación y Configuración

1.  **Clonar o Descargar:** Coloca los archivos del proyecto en la carpeta `htdocs` de tu instalación de XAMPP (ej: `C:/xampp/htdocs/tienda-pc`).

2.  **Base de Datos:**
    - Inicia Apache y MySQL desde el panel de control de XAMPP.
    - Abre tu navegador y ve a `http://localhost/phpmyadmin`.
    - Crea una nueva base de datos llamada `tienda_computadoras`.
    - Selecciona la base de datos, ve a la pestaña "SQL" y pega el contenido del script SQL proporcionado en la documentación para crear las tablas e insertar datos de ejemplo.

3.  **Permisos:** Asegúrate de que la carpeta `uploads` exista dentro de `tienda-pc` y que el servidor web tenga permisos para escribir en ella.

4.  **Acceder a la Aplicación:**
    - **Tienda Pública:** Abre `http://localhost/tienda-pc/` en tu navegador.
    - **Panel de Administración:** Ve a `http://localhost/tienda-pc/admin/login.php`.
      - **Usuario:** `admin`
      - **Contraseña:** `password123`

## Estructura de Archivos
