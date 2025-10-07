<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

// Añadir nueva categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (?)");
    if ($stmt->execute([$nombre])) {
        $_SESSION['mensaje'] = "Categoría añadida correctamente.";
    } else {
        $_SESSION['error'] = "Error al añadir la categoría.";
    }
}

// Eliminar categoría
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
    if ($stmt->execute([$id])) {
        $_SESSION['mensaje'] = "Categoría eliminada correctamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar la categoría. Asegúrate de que no tenga productos asociados.";
    }
}

header('Location: categorias.php');
exit;
?>