<?php
require_once 'config_sesion.php';

$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Mi Carrito</h1>
    
    <p><a href="productos.php">Seguir Comprando</a></p>
    
    <?php if (empty($_SESSION['carrito'])): ?>
        <p>El carrito esta vacio</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Accion</th>
            </tr>
            <?php foreach ($_SESSION['carrito'] as $id => $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                <td><?php echo $item['cantidad']; ?></td>
                <td>$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                <td>
                    <form action="eliminar_del_carrito.php" method="POST">
                        <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>TOTAL</strong></td>
                <td colspan="2"><strong>$<?php echo number_format($total, 2); ?></strong></td>
            </tr>
        </table>
        <br>
    <?php endif; ?>
</body>
</html>