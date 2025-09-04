
<?php

function leerInventario() {
    $contenido = file_get_contents('inventario.json');
    $inventario = json_decode($contenido, true);
    return $inventario;
}

function ordenarInventario($inventario) {
    usort($inventario, function($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });
    return $inventario;
}

function mostrarInventario($inventario) {
    $inventario = ordenarInventario($inventario);
    
    echo "INVENTARIO:\n";
    echo "----------------------------------------\n";
    
    foreach ($inventario as $producto) {
        echo "Producto: " . $producto['nombre'] . "\n";
        echo "Precio: $" . $producto['precio'] . "\n";
        echo "Cantidad: " . $producto['cantidad'] . "\n";
        echo "----------------------------------------\n";
    }
}

function calcularValorTotal($inventario) {
    $subtotales = array_map(function($producto) {
        return $producto['precio'] * $producto['cantidad'];
    }, $inventario);
    
    $total = array_sum($subtotales);
    return $total;
}

function stockBajo($inventario) {
    $productos_bajo_stock = array_filter($inventario, function($producto) {
        return $producto['cantidad'] < 5;
    });
    
    return $productos_bajo_stock;
}

function mostrarStockBajo($productos) {
    echo "\nPRODUCTOS CON STOCK BAJO:\n";
    echo "----------------------------------------\n";
    
    if (count($productos) == 0) {
        echo "No hay productos con stock bajo\n";
    } else {
        foreach ($productos as $producto) {
            echo "Producto: " . $producto['nombre'] . "\n";
            echo "Cantidad: " . $producto['cantidad'] . "\n";
            echo "----------------------------------------\n";
        }
    }
}

$inventario = leerInventario();

mostrarInventario($inventario);

$valor_total = calcularValorTotal($inventario);
echo "\nValor total del inventario: $" . $valor_total . "\n";

$productos_stock_bajo = stockBajo($inventario);
mostrarStockBajo($productos_stock_bajo);

?>