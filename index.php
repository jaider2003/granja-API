<?php
require_once 'Controlador/API/UserController.php';
require_once 'Controlador/API/AnimalController.php';

header("Content-Type: application/json");

$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$method = $_SERVER['REQUEST_METHOD'];

if (isset($uri[0])) {
    switch ($uri[0]) {
        case 'usuarios':
            $controller = new UserController();
            $controller->handleRequest($method, array_slice($uri, 1));
            break;

        case 'animales':
            $controller = new AnimalController();
            $controller->handleRequest($method, array_slice($uri, 1));
            break;

        default:
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado']);
            break;
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Ruta no especificada']);
}
