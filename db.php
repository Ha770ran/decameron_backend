<?php
$host = 'localhost';
$db = 'decameron_hotels';
$user = 'postgres';
$pass = '1702'; // ⚠️ reemplaza esto con tu contraseña real de PostgreSQL
$port = '5432';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit;
}
   