<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Obtener el nombre de la imagen para borrarla del servidor
    $stmt = $pdo->prepare("SELECT imagen FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        $imagen_path = '../uploads/' . $producto['imagen'];

        // 2. Eliminar el producto de la base de datos
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
        if ($stmt->execute([$id])) {
            // 3. Si la eliminación en la BD fue exitosa, borrar la imagen
            if (file_exists($imagen_path)) {
                unlink($imagen_path);
            }
            $_SESSION['mensaje'] = "Producto eliminado correctamente.";
        } else {
            $_SESSION['error'] = "Error al eliminar el producto.";
        }
    } else {
        $_SESSION['error'] = "Producto no encontrado.";
    }
}

header('Location: index.php');
exit;
?>