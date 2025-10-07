<?php
// config/database.php
 $host = 'localhost';
 $dbname = 'tienda_computadoras';
 $user = 'root'; // Usuario por defecto de XAMPP
 $password = ''; // Contraseña por defecto de XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>