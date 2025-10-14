<?php
include 'procesamiento_ventas.php';

# Precios Unitarios
// Laptop Dell Inspirion I3530-5623BLK-PUS → B/.600.00
// Smartphone S24 Ultra → B/.1000.00
// Tablet Redmi Pad 2 → B/.200.00
// Monitor LED HIKVISION D5019S0 → B/.70.00
// Teclado Xtech XTK-301S → B/.12.99

//Array Asociativo total de ventas
$datos_ventas = [
    'Laptop Dell Inspirion I3530-5623BLK-PUS' => [
        'Panamá Norte' => 21000.00,
        'Panamá Este' => 24000.00,
        'Panamá Oeste' => 16800.00
    ],
    'Smartphone S24 Ultra' => [
        'Panamá Norte' => 25000.00,
        'Panamá Este' => 30000.00,
        'Panamá Oeste' => 20000.00
    ],
    'Tablet Redmi Pad 2' => [
        'Panamá Norte' => 8000.00,
        'Panamá Este' => 10000.00,
        'Panamá Oeste' => 9000.00
    ],
    'Monitor LED HIKVISION D5019S0' => [
        'Panamá Norte' => 2100.00,
        'Panamá Este' => 3150.00,
        'Panamá Oeste' => 1750.00
    ],
    'Teclado Xtech XTK-301S' => [
        'Panamá Norte' => 649.50,
        'Panamá Este' => 519.60,
        'Panamá Oeste' => 454.65
    ]
];

//Llamada a las funciones para calcular totales y productos más vendidos
$total_ventas = calcular_total_ventas($datos_ventas);
$producto_top = producto_mas_vendido($datos_ventas);
$ventas_regionales = ventas_por_region($datos_ventas);

//Calculo de totales por producto para mostrar en la tabla de ventas por producto
$totales_productos = [];
foreach ($datos_ventas as $producto => $regiones) {
    $totales_productos[$producto] = array_sum($regiones);
}
arsort($totales_productos);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Analisis de Ventas</title>
</head>
<body>
    <h1>Analisis de Ventas</h1>
    
    <h2>Total de Ventas de la Empresa</h2>
    <table border="1">
        <tr>
            <th>Total General</th>
        </tr>
        <tr>
            <td><?php echo number_format($total_ventas, 0, ',', '.'); ?></td>
        </tr>
    </table>
    
    <h2>Producto Mas Vendido</h2>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Total de Ventas</th>
        </tr>
        <tr>
            <td><?php echo $producto_top; ?></td>
            <td><?php echo number_format($totales_productos[$producto_top], 0, ',', '.'); ?></td>
        </tr>
    </table>
    
    <h2>Ventas por Producto</h2>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Total de Ventas</th>
        </tr>
        <?php foreach ($totales_productos as $producto => $total): ?>
        <tr>
            <td><?php echo $producto; ?></td>
            <td><?php echo number_format($total, 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>Ventas por Region (Orden Descendente)</h2>
    <table border="1">
        <tr>
            <th>Region</th>
            <th>Total de Ventas</th>
        </tr>
        <?php
        $filas = array_map(function($region, $total) {
            return "<tr><td>{$region}</td><td>" . number_format($total, 0, ',', '.') . "</td></tr>";
        }, array_keys($ventas_regionales), $ventas_regionales);
        echo implode("\n", $filas);
        ?>
    </table>
</body>
</html>