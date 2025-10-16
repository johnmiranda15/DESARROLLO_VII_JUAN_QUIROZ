<?php
require_once 'config_sesion.php';

$productos = json_decode(file_get_contents('productos.json'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_SANITIZE_STRING);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
    
    if ($producto_id && $cantidad && $cantidad > 0 && isset($productos[$producto_id])) {
        if (isset($_SESSION['carrito'][$producto_id])) {
            $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$producto_id] = [
                'nombre' => $productos[$producto_id]['nombre'],
                'precio' => $productos[$producto_id]['precio'],
                'cantidad' => $cantidad
            ];
        }
        $_SESSION['mensaje'] = 'Producto agregado al carrito';
    } else {
        $_SESSION['mensaje'] = 'Error al agregar producto';
    }
}

header('Location: productos.php');
exit;
?>