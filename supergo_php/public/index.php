<?php
require_once __DIR__ . '/../includes/auth.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>SuperGO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light navbar-sg sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center me-3" href="index.php">
            <img src="img/logo.png" alt="SuperGO" style="height:70px; width:auto; margin-right:8px;">
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <?php if (estaLogueado()): ?>
                <span class="me-2 fw-semibold">Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                <span class="badge text-bg-secondary me-2"><?php echo htmlspecialchars($_SESSION['rol']); ?></span>
                <?php if (($_SESSION['rol'] ?? '') === 'ADMIN'): ?>
                    <a class="nav-pill nav-pill-admin text-decoration-none" href="admin.php">Panel admin</a>
                <?php endif; ?>
                <a class="nav-pill nav-pill-cart text-decoration-none" href="logout.php">Salir</a>
            <?php else: ?>
                <a class="nav-pill nav-pill-login text-decoration-none" href="login.php">Iniciar sesión</a>
                <a class="nav-pill nav-pill-soft text-decoration-none" href="registro.php">Registrarme</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="container my-5">
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <section class="hero-banner mb-4">
        <img src="img/todos.jpg" alt="Catálogo completo">
        <div class="hero-overlay">
            <div class="hero-content">
                <div class="hero-kicker">Supermercado virtual</div>
                <div class="hero-title">Bienvenido a <span class="accent">SuperGO</span></div>
                <div class="hero-subtitle">Este inicio ya quedó convertido a PHP y conectado al módulo de usuarios y seguridad.</div>
                <div class="d-flex flex-wrap gap-2">
                    <?php if (!estaLogueado()): ?>
                        <a class="btn btn-main px-4" href="registro.php">Crear cuenta</a>
                        <a class="btn btn-light px-4" style="border-radius:999px;font-weight:600;" href="login.php">Entrar</a>
                    <?php else: ?>
                        <a class="btn btn-main px-4" href="perfil.php">Ver mi sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="footer-sg border-top py-3 mt-4">
    <div class="container text-center small text-muted">SuperGO 2026. Todos los Derechos Reservados</div>
</footer>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
