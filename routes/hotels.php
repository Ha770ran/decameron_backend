<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../controllers/HotelController.php';

// Crear instancia del controlador con la conexión PDO
$controller = new HotelController($pdo);

// Llamar al método correspondiente según el método HTTP
$controller->handleRequest($_SERVER['REQUEST_METHOD']);
