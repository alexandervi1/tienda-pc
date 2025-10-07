<?php
// includes/functions.php

// Inicia la sesión si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar si el usuario ha iniciado sesión
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Función para verificar si el administrador ha iniciado sesión
function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']);
}

// Función para redirigir
function redirect($url) {
    header("Location: $url");
    exit();
}

// Función para calcular el total del carrito
function calcularTotal() {
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
    }
    return $total;
}
?>