
## 🗄️ Diseño de la Base de Datos

La aplicación utiliza tres tablas principales:

- **`categorias`**: Almacena los tipos de productos (Laptops, Desktops, etc.).
- **`productos`**: Almacena la información de cada computadora y se relaciona con `categorias` a través de una clave foránea.
- **`usuarios`**: Almacena la información de los clientes registrados, con contraseñas hasheadas de forma segura.

## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP
- **Frontend:** HTML5, CSS3 (Tailwind CSS), JavaScript
- **Base de Datos:** MySQL
- **Servidor:** Apache (vía XAMPP)

## 🚀 Mejoras Futuras

- [ ] Implementar un sistema de búsqueda y filtrado de productos.
- [ ] Desarrollar un historial de pedidos para los usuarios.
- [ ] Integrar una pasarela de pago real (Stripe, PayPal).
- [ ] Añadir un sistema de reseñas y valoraciones de productos.
- [ ] Compilar Tailwind CSS para producción en lugar de usar el CDN.
- [ ] Implementar pruebas unitarias (PHPUnit).

## 🤝 Contributing

Las solicitudes de extracción son bienvenidas. Para cambios importantes, abra un problema primero para discutir lo que le gustaría cambiar.

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para obtener más detalles.