<?php
require_once 'functions.php'; // Incluimos las funciones auxiliares
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Computadoras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-slate-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold flex items-center">
                <i class="fas fa-laptop-code mr-2"></i> Tienda PC
            </a>
            <nav class="flex items-center space-x-4">
                <a href="index.php" class="hover:text-blue-400 transition-colors">Inicio</a>
                
                <!-- Carrito de Compras -->
                <a href="carrito.php" class="relative hover:text-blue-400 transition-colors">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            <?php echo array_sum(array_column($_SESSION['carrito'], 'cantidad')); ?>
                        </span>
                    <?php endif; ?>
                </a>

                <?php if (isLoggedIn()): ?>
                    <span class="text-sm">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm transition-colors">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="hover:text-blue-400 transition-colors">Iniciar Sesión</a>
                    <a href="register.php" class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-sm transition-colors">Registrarse</a>
                <?php endif; ?>

                <a href="admin/login.php" class="hover:text-blue-400 transition-colors">
                    <i class="fas fa-cog"></i> Admin
                </a>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">