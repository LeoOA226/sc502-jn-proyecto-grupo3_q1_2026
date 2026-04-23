<?php
$charset = 'utf8mb4';

$candidatos = [
    [
        'host' => getenv('DB_HOST') ?: 'db',
        'dbname' => getenv('DB_NAME') ?: 'appdb',
        'usuario' => getenv('DB_USER') ?: 'root',
        'contrasena' => getenv('DB_PASS') ?: 'root',
    ],
    [
        'host' => 'localhost',
        'dbname' => 'appdb',
        'usuario' => 'root',
        'contrasena' => '',
    ],
];

$pdo = null;
$ultimoError = 'No se pudo establecer conexión';

foreach ($candidatos as $cfg) {
    try {
        $dsn = "mysql:host={$cfg['host']};dbname={$cfg['dbname']};charset={$charset}";
        $pdo = new PDO($dsn, $cfg['usuario'], $cfg['contrasena'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        break;
    } catch (PDOException $e) {
        $ultimoError = $e->getMessage();
    }
}

if (!$pdo) {
    die('Error de conexión a la base de datos: ' . $ultimoError);
}