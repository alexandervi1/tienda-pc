<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

// Obtener el producto a editar
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
 $id = $_GET['id'];

 $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
 $stmt->execute([$id]);
 $producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: index.php');
    exit;
}

// Obtener categorías para el select
 $stmt_categorias = $pdo->query("SELECT * FROM categorias");
 $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <h1 class="text-3xl font-bold text-slate-700 mb-6">Editar Producto</h1>
        <form action="procesar_producto.php" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <input type="hidden" name="imagen_actual" value="<?php echo $producto['imagen']; ?>">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="precio">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" value="<?php echo $producto['precio']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" value="<?php echo $producto['stock']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_categoria">Categoría</label>
                    <select name="id_categoria" id="id_categoria" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['id']; ?>" <?php echo ($categoria['id'] == $producto['id_categoria']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($categoria['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="imagen">Imagen del Producto (Deja vacío para mantener la actual)</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-sm text-gray-600 mt-2">Imagen actual:</p>
                <img src="../uploads/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="" class="w-32 h-32 object-cover rounded mt-2">
            </div>
            <div class="flex items-center justify-between">
                <a href="index.php" class="text-gray-600 hover:text-gray-800">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Actualizar Producto
                </button>
            </div>
        </form>
    </div>
</body>
</html>