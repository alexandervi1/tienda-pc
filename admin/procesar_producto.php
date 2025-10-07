<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];
    $imagen_actual = $_POST['imagen_actual'] ?? null;

    $imagen_nombre = $imagen_actual; // Por defecto, mantenemos la imagen actual

    // Procesar la nueva imagen solo si se subió una
    if (!empty($_FILES['imagen']['name'])) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_error = $_FILES['imagen']['error'];
        $imagen_extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagen_nuevo_nombre = uniqid('product_', true) . '.' . $imagen_extension;
        $ruta_destino = '../uploads/' . $imagen_nuevo_nombre;

        if ($imagen_error === UPLOAD_ERR_OK && move_uploaded_file($imagen_tmp, $ruta_destino)) {
            // Si la nueva imagen se subió correctamente, la usaremos
            // Y eliminamos la antigua si existe
            if ($imagen_actual && file_exists('../uploads/' . $imagen_actual)) {
                unlink('../uploads/' . $imagen_actual);
            }
            $imagen_nombre = $imagen_nuevo_nombre;
        }
    }

    if ($id) {
        // Modo Edición
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, imagen = ?, id_categoria = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $stock, $imagen_nombre, $id_categoria, $id]);
        $_SESSION['mensaje'] = "Producto actualizado correctamente.";
    } else {
        // Modo Inserción
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen, id_categoria) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $stock, $imagen_nombre, $id_categoria]);
        $_SESSION['mensaje'] = "Producto añadido correctamente.";
    }

    header('Location: index.php');
    exit;
}
?>