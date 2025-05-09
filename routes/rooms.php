<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../controllers/RoomController.php';

$controller = new RoomController($pdo);
$controller->handleRequest($_SERVER['REQUEST_METHOD']);
