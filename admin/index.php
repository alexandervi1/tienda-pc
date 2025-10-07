<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

 $stmt = $pdo->query("SELECT p.*, c.nombre AS categoria_nombre FROM productos p JOIN categorias c ON p.id_categoria = c.id ORDER BY p.id DESC");
 $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-700">Gestión de Productos</h1>
            <div class="space-x-2">
                <a href="categorias.php" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition-colors">
                    <i class="fas fa-tags mr-2"></i> Gestionar Categorías
                </a>
                <a href="agregar_producto.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Añadir Nuevo Producto
                </a>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full table-auto">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Imagen</th>
                        <th class="px-4 py-3 text-left">Nombre</th>
                        <th class="px-4 py-3 text-left">Categoría</th>
                        <th class="px-4 py-3 text-left">Precio</th>
                        <th class="px-4 py-3 text-left">Stock</th>
                        <th class="px-4 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><img src="../uploads/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="" class="w-16 h-16 object-cover rounded"></td>
                        <td class="px-4 py-3 font-semibold"><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td class="px-4 py-3"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></td>
                        <td class="px-4 py-3">$<?php echo number_format($producto['precio'], 2); ?></td>
                        <td class="px-4 py-3"><?php echo $producto['stock']; ?></td>
                        <td class="px-4 py-3">
                            <a href="editar_producto.php?id=<?php echo $producto['id']; ?>" class="text-blue-600 hover:text-blue-800 mr-4">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="login.php?logout=true" class="mt-6 inline-block text-sm text-gray-600 hover:text-gray-800">Cerrar sesión</a>
    </div>
</body>
</html>