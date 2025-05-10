<?php
$host = 'dpg-d0f2okbe5dus73e2j3pg-a.oregon-postgres.render.com';
$db   = 'decameron_hotels_c8eq';
$user = 'decameron_hotels_c8eq_user';
$pass = 'dU20OPa7jxvh2AhKVk2hR0RmExAj1MYe';
$port = '5432';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    echo "✅ Conexión exitosa a PostgreSQL (Render)";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
?>


   