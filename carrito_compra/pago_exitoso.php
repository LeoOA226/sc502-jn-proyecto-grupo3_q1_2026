<?php
/**
 * pago_exitoso.php
 * Muestra un mensaje de éxito después de realizar la compra.
 */
require_once __DIR__ . '/includes/auth.php';
$pedido = $_GET['pedido'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compra exitosa - SuperGO</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-box {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .success-icon {
            font-size: 64px;
            color: #3DB563;
            margin-bottom: 20px;
        }
        .order-number {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 12px;
            font-family: monospace;
            font-size: 1.2rem;
            display: inline-block;
            margin: 15px 0;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="success-box">
            <div class="success-icon">✅</div>
            <h1>¡Pago simulado exitoso!</h1>
            <p>Tu pedido ha sido registrado correctamente.</p>
            <div class="order-number">
                Número de pedido: <strong><?php echo htmlspecialchars($pedido); ?></strong>
            </div>
            <p>Recibirás un correo de confirmación (simulado).</p>
            <div class="mt-4">
                <a href="index.php" class="btn btn-main">Seguir comprando</a>
                <a href="historial.php" class="btn btn-outline-primary ms-2">Ver mis pedidos</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>