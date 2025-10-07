<?php
require_once 'includes/functions.php';
require_once 'includes/header.php';

// Lógica para actualizar cantidades o eliminar productos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['cantidades'] as $product_id => $cantidad) {
            if ($cantidad > 0) {
                $_SESSION['carrito'][$product_id]['cantidad'] = (int)$cantidad;
            } else {
                unset($_SESSION['carrito'][$product_id]);
            }
        }
        redirect('carrito.php?status=updated');
    } elseif (isset($_POST['remove_item'])) {
        $product_id_to_remove = $_POST['remove_item'];
        unset($_SESSION['carrito'][$product_id_to_remove]);
        redirect('carrito.php?status=removed');
    }
}
?>

<h1 class="text-4xl font-bold text-center mb-8 text-slate-700">Tu Carrito de Compras</h1>

<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] == 'updated'): ?>
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">Carrito actualizado.</div>
    <?php elseif ($_GET['status'] == 'removed'): ?>
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">Producto eliminado del carrito.</div>
    <?php endif; ?>
<?php endif; ?>

<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <?php if (empty($_SESSION['carrito'])): ?>
        <p class="text-center text-gray-600 text-lg">Tu carrito está vacío. <a href="index.php" class="text-blue-600 hover:underline">¡Ve a comprar algo!</a></p>
    <?php else: ?>
        <form action="carrito.php" method="POST">
            <div class="space-y-4">
                <?php foreach ($_SESSION['carrito'] as $item): ?>
                    <div class="flex items-center justify-between border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="uploads/<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="w-20 h-20 object-cover rounded">
                            <div>
                                <h3 class="font-semibold"><?php echo htmlspecialchars($item['nombre']); ?></h3>
                                <p class="text-gray-600">$<?php echo number_format($item['precio'], 2); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <input type="number" name="cantidades[<?php echo $item['id']; ?>]" value="<?php echo $item['cantidad']; ?>" min="0" class="w-16 border rounded px-2 py-1 text-center">
                            <p class="font-semibold">$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></p>
                            <button type="submit" name="remove_item" value="<?php echo $item['id']; ?>" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-6 flex justify-between items-center">
                <button type="submit" name="update_cart" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">Actualizar Carrito</button>
                <div class="text-right">
                    <p class="text-2xl font-bold">Total: $<?php echo number_format(calcularTotal(), 2); ?></p>
                </div>
            </div>
        </form>
        <div class="mt-6 text-right">
            <a href="checkout.php" class="bg-green-600 text-white text-lg font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors">
                Proceder al Pago
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>