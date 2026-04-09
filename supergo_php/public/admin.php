<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Panel Admin - SuperGO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="alert alert-success">Entraste al panel de administrador porque tu rol es ADMIN.</div>
    <a href="index.php" class="btn btn-main">Volver</a>
</div>
</body>
</html>
