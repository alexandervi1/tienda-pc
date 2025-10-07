<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    redirect('index.php');
}

 $id = $_GET['id'];
 $stmt = $pdo->prepare("SELECT p.*, c.nombre AS categoria_nombre FROM productos p JOIN categorias c ON p.id_categoria = c.id WHERE p.id = ?");
 $stmt->execute([$id]);
 $producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    redirect('index.php');
}

// Lógica para añadir al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $product_id = $producto['id'];
    $quantity = (int)$_POST['cantidad'];

    if (isset($_SESSION['carrito'][$product_id])) {
        $_SESSION['carrito'][$product_id]['cantidad'] += $quantity;
    } else {
        $_SESSION['carrito'][$product_id] = [
            'id' => $producto['id'],
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'imagen' => $producto['imagen'],
            'cantidad' => $quantity
        ];
    }
    redirect("producto.php?id=$id&status=added");
}

require_once 'includes/header.php';
?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'added'): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">¡Producto añadido al carrito!</strong>
    </div>
<?php endif; ?>

<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
    <img src="uploads/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="w-full h-96 object-cover">
    <div class="p-8">
        <div class="flex justify-between items-start mb-4">
            <div>
                <span class="text-sm text-blue-600 font-semibold uppercase"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></span>
                <h1 class="text-3xl font-bold mt-1"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-green-600">$<?php echo number_format($producto['precio'], 2); ?></p>
                <p class="text-sm text-gray-500 mt-1">Stock: <?php echo $producto['stock']; ?> unidades</p>
            </div>
        </div>
        <div class="border-t pt-4">
            <h2 class="text-xl font-semibold mb-2">Descripción</h2>
            <p class="text-gray-700 leading-relaxed"><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
        </div>
        <div class="mt-6">
            <form action="producto.php?id=<?php echo $producto['id']; ?>" method="POST" class="flex items-center space-x-4">
                <input type="hidden" name="add_to_cart" value="1">
                <label for="cantidad" class="font-semibold">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?php echo $producto['stock']; ?>" class="w-20 border rounded px-2 py-1">
                <button type="submit" class="bg-green-600 text-white text-lg font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-shopping-cart mr-2"></i> Añadir al Carrito
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>