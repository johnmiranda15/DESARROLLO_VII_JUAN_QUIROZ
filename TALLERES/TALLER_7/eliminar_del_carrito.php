<?php
require_once 'config_sesion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
    
    if ($producto_id && isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
}

header('Location: ver_carrito.php');
exit;
?>