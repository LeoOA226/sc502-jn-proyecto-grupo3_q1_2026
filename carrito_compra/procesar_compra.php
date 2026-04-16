<?php
/**
 * procesar_compra.php
 * Finaliza la compra: guarda pedido, vacía carrito y simula pago.
 * Requiere usuario logueado.
 */
require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/includes/auth.php';

// Solo usuarios autenticados
requireLogin();

$idUsuario = (int)$_SESSION['id_usuario'];

// Obtener items del carrito del usuario actual
$sqlItems = "SELECT c.id_producto, c.cantidad, p.precio, p.nombre, p.stock
             FROM carrito c
             INNER JOIN productos p ON c.id_producto = p.id
             WHERE c.id_usuario = ?";
$stmt = $pdo->prepare($sqlItems);
$stmt->execute([$idUsuario]);
$items = $stmt->fetchAll();

// Validar que el carrito no esté vacío
if (empty($items)) {
    header('Location: carrito.php?error=Tu carrito está vacío');
    exit;
}

// Calcular totales (misma lógica que en carrito.php)
$subtotal = 0;
foreach ($items as $item) {
    $subtotal += $item['cantidad'] * $item['precio'];
}
$impuestos = $subtotal * 0.13;      // 13% de impuesto simulado
$envio = $subtotal > 0 ? 2500 : 0;  // Envío fijo ₡2500 si hay productos
$total = $subtotal + $impuestos + $envio;

// Generar número de pedido único
$numeroPedido = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);

// Obtener dirección y teléfono del perfil del usuario (opcional)
$stmtUser = $pdo->prepare("SELECT direccion, telefono FROM usuarios WHERE id = ?");
$stmtUser->execute([$idUsuario]);
$userData = $stmtUser->fetch();
$direccion = $userData['direccion'] ?? '';
$telefono = $userData['telefono'] ?? '';

// Iniciar transacción para asegurar consistencia
try {
    $pdo->beginTransaction();

    // 1. Insertar el pedido en la tabla pedidos
    $sqlPedido = "INSERT INTO pedidos (numero_pedido, id_usuario, subtotal, impuestos, envio, total, direccion_envio, telefono_envio)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtPedido = $pdo->prepare($sqlPedido);
    $stmtPedido->execute([
        $numeroPedido,
        $idUsuario,
        $subtotal,
        $impuestos,
        $envio,
        $total,
        $direccion,
        $telefono
    ]);
    $idPedido = $pdo->lastInsertId();

    // 2. Insertar cada producto en detalle_pedido y descontar stock
    $sqlDetalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal)
                   VALUES (?, ?, ?, ?, ?)";
    $stmtDetalle = $pdo->prepare($sqlDetalle);

    $sqlUpdateStock = "UPDATE productos SET stock = stock - ? WHERE id = ?";
    $stmtStock = $pdo->prepare($sqlUpdateStock);

    foreach ($items as $item) {
        $subtotalItem = $item['cantidad'] * $item['precio'];
        $stmtDetalle->execute([
            $idPedido,
            $item['id_producto'],
            $item['cantidad'],
            $item['precio'],
            $subtotalItem
        ]);

        // Descontar stock (evitar stock negativo)
        if ($item['cantidad'] > $item['stock']) {
            throw new Exception("Stock insuficiente para el producto: " . $item['nombre']);
        }
        $stmtStock->execute([$item['cantidad'], $item['id_producto']]);
    }

    // 3. Vaciar el carrito del usuario
    $sqlVaciar = "DELETE FROM carrito WHERE id_usuario = ?";
    $stmtVaciar = $pdo->prepare($sqlVaciar);
    $stmtVaciar->execute([$idUsuario]);

    // Confirmar transacción
    $pdo->commit();

    // Redirigir a página de éxito con el número de pedido
    header("Location: pago_exitoso.php?pedido=" . urlencode($numeroPedido));
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    // En caso de error, redirigir al carrito con mensaje
    $errorMsg = urlencode("Error al procesar la compra: " . $e->getMessage());
    header("Location: carrito.php?error=$errorMsg");
    exit;
}
?>