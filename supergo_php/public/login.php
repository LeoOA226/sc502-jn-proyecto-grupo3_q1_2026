<?php
require_once __DIR__ . '/../includes/auth.php';
if (estaLogueado()) {
    header('Location: index.php');
    exit;
}
$error = $_GET['error'] ?? '';
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login - SuperGO</title>
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
            <a class="nav-pill nav-pill-soft text-decoration-none" href="index.php">Inicio</a>
            <a class="nav-pill nav-pill-login text-decoration-none" href="registro.php">Registrarme</a>
        </div>
    </div>
</nav>

<section class="container auth-shell d-flex justify-content-center align-items-center py-4">
    <div style="width:100%;max-width:460px;">
        <div class="auth-hero">
            <img src="img/todos.jpg" alt="SuperGO">
            <div class="overlay">
                <div>
                    <p class="title">Bienvenido a SuperGO</p>
                    <p class="subtitle">Inicia sesión para entrar al sistema.</p>
                </div>
            </div>
        </div>

        <div class="card auth-card card-sg">
            <div class="card-body p-4 p-md-4">
                <h1 class="h4 mb-1" style="font-weight:700;">Ingresar</h1>
                <p class="text-muted mb-4" style="font-weight:500;">Accede con tu correo y contraseña</p>

                <?php if ($error !== ''): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <?php if ($msg !== ''): ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div>
                <?php endif; ?>

                <form action="procesar_login.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input class="form-control" type="email" name="correo" autocomplete="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input class="form-control" type="password" name="contrasena" autocomplete="current-password" required>
                    </div>
                    <button class="btn btn-auth w-100" type="submit">Entrar</button>
                </form>

                <div class="links mt-3">
                    <a href="registro.php">Registrarme</a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer-sg border-top py-3 mt-4">
    <div class="container text-center small text-muted">SuperGO 2026. Todos los Derechos Reservados</div>
</footer>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
