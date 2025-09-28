<?php
// 1. Crear un arreglo asociativo de productos con su inventario
$inventario = [
    "laptop" => ["cantidad" => 50, "precio" => 800],
    "smartphone" => ["cantidad" => 100, "precio" => 500],
    "tablet" => ["cantidad" => 30, "precio" => 300],
    "smartwatch" => ["cantidad" => 25, "precio" => 150]
];

// Agregar HTML para mostrar correctamente en navegador
echo "<h1>Sistema de Inventario</h1>";
echo "<pre>"; // Esto hace que se respeten los saltos de línea

// 2. Función para mostrar el inventario
function mostrarInventario($inv) {
    foreach ($inv as $producto => $info) {
        echo "- $producto\n";
        echo "  Cantidad: {$info['cantidad']} unidades\n";
        echo "  Precio: \${$info['precio']}\n";
        echo "  Valor total: $" . ($info['cantidad'] * $info['precio']) . "\n\n";
    }
}

// 3. Mostrar inventario inicial
echo "Inventario inicial:\n";
mostrarInventario($inventario);

// 4. Función para actualizar el inventario
function actualizarInventario(&$inv, $producto, $cantidad, $precio = null) {
    if (!isset($inv[$producto])) {
        $inv[$producto] = ["cantidad" => $cantidad, "precio" => $precio];
    } else {
        $inv[$producto]["cantidad"] += $cantidad;
        if ($precio !== null) {
            $inv[$producto]["precio"] = $precio;
        }
    }
}

// 5. Actualizar inventario
actualizarInventario($inventario, "laptop", -5); // Venta de 5 laptops
actualizarInventario($inventario, "smartphone", 50, 450); // Nuevo lote de smartphones con precio actualizado
actualizarInventario($inventario, "auriculares", 100, 50); // Nuevo producto

// 6. Mostrar inventario actualizado
echo "\nInventario actualizado:\n";
mostrarInventario($inventario);

// 7. Función para calcular el valor total del inventario
function valorTotalInventario($inv) {
    $total = 0;
    foreach ($inv as $producto => $info) {
        $total += $info['cantidad'] * $info['precio'];
    }
    return $total;
}

// 8. Mostrar valor total del inventario
echo "\nValor total del inventario: $" . valorTotalInventario($inventario) . "\n";

// TAREA: Función que encuentra el producto con mayor valor total en inventario
function productoMayorValor($inv) {
    $mayorValor = 0;
    $productoMayor = "";
    
    foreach ($inv as $producto => $info) {
        $valorTotal = $info['cantidad'] * $info['precio'];
        if ($valorTotal > $mayorValor) {
            $mayorValor = $valorTotal;
            $productoMayor = $producto;
        }
    }
    
    return [
        'producto' => $productoMayor,
        'valor' => $mayorValor,
        'cantidad' => $inv[$productoMayor]['cantidad'],
        'precio' => $inv[$productoMayor]['precio']
    ];
}

// Mostrar el resultado
echo "\n=== PRODUCTO CON MAYOR VALOR TOTAL ===\n";
$resultado = productoMayorValor($inventario);
echo "Producto ganador: {$resultado['producto']}\n";
echo "Cantidad en stock: {$resultado['cantidad']} unidades\n";
echo "Precio por unidad: \${$resultado['precio']}\n";
echo "Valor total del producto: \${$resultado['valor']}\n\n";

// Función adicional: mostrar todos los productos ordenados por valor
function mostrarPorValor($inv) {
    $productos = [];
    
    foreach ($inv as $producto => $info) {
        $productos[$producto] = $info['cantidad'] * $info['precio'];
    }
    
    arsort($productos); // Ordenar de mayor a menor
    
    echo "\n=== PRODUCTOS ORDENADOS POR VALOR TOTAL ===\n";
    foreach ($productos as $producto => $valor) {
        $info = $inv[$producto];
        echo "• $producto\n";
        echo "  Stock: {$info['cantidad']} unidades\n";
        echo "  Precio: \${$info['precio']} c/u\n";
        echo "  Valor total: \$valor\n\n";
    }
}

// Mostrar productos ordenados por valor
mostrarPorValor($inventario);

echo "</pre>"; // Cerrar el tag pre
echo "<p><strong>Sistema de inventario completado!</strong></p>";
?>