<?php
require_once 'config.php';

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Autocarga de modelos
spl_autoload_register(function ($class) {
    $rutaModelo = __DIR__ . '/../Modelo/' . $class . '.php';
    if (file_exists($rutaModelo)) {
        require_once $rutaModelo;
    }
});
