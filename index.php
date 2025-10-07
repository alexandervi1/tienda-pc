<?php
require_once 'config/database.php';
require_once 'includes/header.php';

 $stmt = $pdo->query("SELECT p.*, c.nombre AS categoria_nombre FROM productos p JOIN categorias c ON p.id_categoria = c.id ORDER BY p.created_at DESC");
 $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (isLoggedIn()): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">¡Bienvenido de nuevo, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</strong>
    </div>
<?php endif; ?>

<h1 class="text-4xl font-bold text-center mb-8 text-slate-700">Nuestros Productos</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    <?php foreach ($productos as $producto): ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <img src="uploads/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="w-full h-48 object-cover">
            <div class="p-4 flex-grow">
                <span class="text-xs text-blue-600 font-semibold"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></span>
                <h2 class="text-xl font-bold mt-1 mb-2"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                <p class="text-gray-600 text-sm mb-4"><?php echo substr(htmlspecialchars($producto['descripcion']), 0, 80) . '...'; ?></p>
            </div>
            <div class="p-4 pt-0 flex justify-between items-center">
                <span class="text-2xl font-bold text-green-600">$<?php echo number_format($producto['precio'], 2); ?></span>
                <a href="producto.php?id=<?php echo $producto['id']; ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                    Ver Detalles
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>