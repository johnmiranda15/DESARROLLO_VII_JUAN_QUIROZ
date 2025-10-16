<?php
require_once 'config_sesion.php';

$productos = json_decode(file_get_contents('productos.json'), true);

$mensaje = '';
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
}

$nombre_usuario = '';
if (isset($_COOKIE['nombre_usuario'])) {
    $nombre_usuario = htmlspecialchars($_COOKIE['nombre_usuario']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Tienda Online</h1>
    
    <?php if ($nombre_usuario): ?>
        <p>Bienvenido de nuevo, <strong><?php echo $nombre_usuario; ?></strong>!</p>
    <?php endif; ?>
    
    <?php if ($mensaje): ?>
        <p><strong><?php echo htmlspecialchars($mensaje); ?></strong></p>
    <?php endif; ?>
    
    <p><a href="ver_carrito.php">Ver Carrito (<?php echo count($_SESSION['carrito']); ?> productos)</a></p>
    
    <h2>Productos Disponibles</h2>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Accion</th>
        </tr>
        <?php foreach ($productos as $id => $producto): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td>$<?php echo number_format($producto['precio'], 2); ?></td>
            <td>
                <form action="agregar_al_carrito.php" method="POST">
                    <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                    <input type="number" name="cantidad" value="1" min="1" max="10">
                    <button type="submit">Agregar al Carrito</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>