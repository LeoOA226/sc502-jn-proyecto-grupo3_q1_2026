<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mi sesión - SuperGO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card card-sg">
        <div class="card-body p-4">
            <h1 class="h3 mb-3">Sesión iniciada</h1>
            <p><strong>ID usuario:</strong> <?php echo (int) $_SESSION['id_usuario']; ?></p>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['correo']); ?></p>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($_SESSION['rol']); ?></p>
            <a href="index.php" class="btn btn-main">Volver al inicio</a>
            <a href="logout.php" class="btn btn-outline-secondary">Cerrar sesión</a>
        </div>
    </div>
</div>
</body>
</html>
