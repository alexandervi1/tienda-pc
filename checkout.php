<?php
require_once 'includes/functions.php';
require_once 'includes/header.php';

if (!isLoggedIn()) {
    redirect('login.php?redirect=checkout.php');
}

if (empty($_SESSION['carrito'])) {
    redirect('carrito.php');
}

// Simulación de proceso de pago
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_pedido'])) {
    // Aquí iría la lógica de pago real (pasarela de pago, etc.)
    // Y la lógica para guardar el pedido en la base de datos.
    
    // Por ahora, solo vaciamos el carrito y mostramos un mensaje.
    unset($_SESSION['carrito']);
    redirect('checkout.php?status=success');
}
?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="max-w-2xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center">
        <strong class="font-bold text-2xl">¡Pedido Confirmado!</strong>
        <p class="mt-2">Gracias por tu compra. Hemos procesado tu pedido exitosamente.</p>
        <a href="index.php" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Volver a la Tienda</a>
    </div>
<?php else: ?>
    <h1 class="text-4xl font-bold text-center mb-8 text-slate-700">Confirmar Pedido</h1>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Resumen del Pedido</h2>
        <div class="space-y-2 mb-6">
            <?php foreach ($_SESSION['carrito'] as $item): ?>
                <div class="flex justify-between">
                    <span><?php echo htmlspecialchars($item['nombre']); ?> (x<?php echo $item['cantidad']; ?>)</span>
                    <span>$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="border-t pt-4">
            <div class="flex justify-between text-xl font-bold">
                <span>Total a Pagar:</span>
                <span>$<?php echo number_format(calcularTotal(), 2); ?></span>
            </div>
        </div>
        <form action="checkout.php" method="POST" class="mt-6">
            <button type="submit" name="confirmar_pedido" class="w-full bg-green-600 text-white text-lg font-bold py-3 rounded-lg hover:bg-green-700 transition-colors">
                Confirmar y Pagar
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>