<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/auth.php';

requireAdmin();

$sql = "SELECT p.*, c.nombre AS categoria_nombre
        FROM productos p
        INNER JOIN categorias c ON p.id_categoria = c.id
        ORDER BY p.id DESC";
$productos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$ok = $_GET['ok'] ?? '';
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{font-family:Arial,sans-serif;background:#f5f5f5;margin:0}
        header{background:#198754;color:#fff;padding:15px 25px}
        header a{color:#fff;text-decoration:none;margin-left:10px}
        .container{max-width:1200px;margin:25px auto;padding:0 20px}
        .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px}
        .btn{display:inline-block;background:#198754;color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none}
        .btn:hover{background:#157347}
        table{width:100%;border-collapse:collapse;background:#fff}
        th,td{padding:12px;border:1px solid #ddd;text-align:left;vertical-align:middle}
        th{background:#222;color:#fff}
        .acciones a{margin-right:8px;text-decoration:none;font-weight:bold}
        .editar{color:#0d6efd}
        .eliminar{color:#dc3545}
        .thumb{width:70px;height:70px;object-fit:cover;border-radius:8px;border:1px solid #ccc}
        .msg{padding:12px;border-radius:8px;margin-bottom:15px}
        .ok{background:#d1e7dd;color:#0f5132}
        .error{background:#f8d7da;color:#842029}
    </style>
</head>
<body>

<header>
    <strong>Panel Admin - SuperGO</strong>
    <span style="float:right;">
        <a href="index.php">Catálogo</a>
        <a href="logout.php">Salir</a>
    </span>
</header>

<div class="container">
    <div class="top">
        <h1>Gestión de productos</h1>
        <a class="btn" href="crear_producto.php">+ Crear producto</a>
    </div>

    <?php if ($ok): ?>
        <div class="msg ok"><?= htmlspecialchars($ok) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="msg error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= (int)$p['id'] ?></td>
                    <td>
                        <?php if (!empty($p['ruta_imagen'])): ?>
                            <img class="thumb" src="<?= htmlspecialchars($p['ruta_imagen']) ?>" alt="img">
                        <?php else: ?>
                            Sin imagen
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td><?= htmlspecialchars($p['categoria_nombre']) ?></td>
                    <td>₡<?= number_format($p['precio'], 2) ?></td>
                    <td><?= (int)$p['stock'] ?></td>
                    <td><?= htmlspecialchars($p['descripcion']) ?></td>
                    <td class="acciones">
                        <a class="editar" href="editar_producto.php?id=<?= (int)$p['id'] ?>">Editar</a>
                        <a class="eliminar" href="eliminar_producto.php?id=<?= (int)$p['id'] ?>" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>