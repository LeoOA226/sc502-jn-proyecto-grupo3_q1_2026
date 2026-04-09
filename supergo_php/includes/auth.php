<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function estaLogueado(): bool
{
    return isset($_SESSION['id_usuario']);
}

function requireLogin(): void
{
    if (!estaLogueado()) {
        header('Location: login.php?error=Debes iniciar sesión');
        exit;
    }
}

function requireAdmin(): void
{
    requireLogin();
    if (($_SESSION['rol'] ?? '') !== 'ADMIN') {
        header('Location: index.php?error=No tienes permisos para entrar ahí');
        exit;
    }
}
