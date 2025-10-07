<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
require_once '../config/database.php';

// Obtener todas las categorías
 $categorias = $pdo->query("SELECT * FROM categorias ORDER BY nombre")->fetchAll(PDO::FETCH_ASSOC);

// Mensajes de éxito o error
 $mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
 $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['mensaje'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Categorías</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-700">Gestión de Categorías</h1>
            <a href="index.php" class="text-gray-600 hover:text-gray-800">← Volver a Productos</a>
        </div>

        <?php if ($mensaje): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Añadir Nueva Categoría</h2>
            <form action="procesar_categoria.php" method="POST">
                <div class="flex space-x-4">
                    <input type="text" name="nombre" placeholder="Nombre de la categoría" required class="flex-grow shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Añadir Categoría
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full table-auto">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nombre</th>
                        <th class="px-4 py-3 text-left">Descripción</th>
                        <th class="px-4 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><?php echo $categoria['id']; ?></td>
                        <td class="px-4 py-3 font-semibold"><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                        <td class="px-4 py-3"><?php echo htmlspecialchars($categoria['descripcion']); ?></td>
                        <td class="px-4 py-3">
                            <a href="procesar_categoria.php?delete=<?php echo $categoria['id']; ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('¿Estás seguro? Esto eliminará la categoría y todos sus productos asociados.');">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>