<?php
$ventas = [
    "Norte" => [
        "Producto A" => [100, 120, 140, 110, 130],
        "Producto B" => [85, 95, 105, 90, 100],
        "Producto C" => [60, 55, 65, 70, 75]
    ],
    "Sur" => [
        "Producto A" => [80, 90, 100, 85, 95],
        "Producto B" => [120, 110, 115, 125, 130],
        "Producto C" => [70, 75, 80, 65, 60]
    ],
    "Este" => [
        "Producto A" => [110, 115, 120, 105, 125],
        "Producto B" => [95, 100, 90, 105, 110],
        "Producto C" => [50, 60, 55, 65, 70]
    ],
    "Oeste" => [
        "Producto A" => [90, 85, 95, 100, 105],
        "Producto B" => [105, 110, 100, 115, 120],
        "Producto C" => [80, 85, 75, 70, 90]
    ]
];

echo "<h1>Analisis de Ventas por Regiones</h1>";
echo "<pre>";

function promedioVentas($ventas) {
    return array_sum($ventas) / count($ventas);
}

echo "\n=== PROMEDIO DE VENTAS POR REGION Y PRODUCTO ===\n";
foreach ($ventas as $region => $productos) {
    echo "$region:\n";
    foreach ($productos as $producto => $ventasProducto) {
        $promedio = promedioVentas($ventasProducto);
        echo "  $producto: " . number_format($promedio, 2) . " unidades promedio\n";
    }
    echo "\n";
}

function productoMasVendido($productos) {
    $maxVentas = 0;
    $productoTop = '';
    
    foreach ($productos as $producto => $ventas) {
        $totalVentas = array_sum($ventas);
        if ($totalVentas > $maxVentas) {
            $maxVentas = $totalVentas;
            $productoTop = $producto;
        }
    }
    
    return [$productoTop, $maxVentas];
}

echo "\n=== PRODUCTO MAS VENDIDO POR REGION ===\n";
foreach ($ventas as $region => $productos) {
    [$productoTop, $ventasTop] = productoMasVendido($productos);
    echo "$region: $productoTop (Total: $ventasTop unidades)\n";
}

$ventasTotalesPorProducto = [];
foreach ($ventas as $region => $productos) {
    foreach ($productos as $producto => $ventasProducto) {
        if (!isset($ventasTotalesPorProducto[$producto])) {
            $ventasTotalesPorProducto[$producto] = 0;
        }
        $ventasTotalesPorProducto[$producto] += array_sum($ventasProducto);
    }
}

echo "\n=== VENTAS TOTALES POR PRODUCTO ===\n";
arsort($ventasTotalesPorProducto);
foreach ($ventasTotalesPorProducto as $producto => $total) {
    echo "$producto: $total unidades\n";
}

$ventasTotalesPorRegion = array_map(function($productos) {
    return array_sum(array_map('array_sum', $productos));
}, $ventas);

$regionTopVentas = array_keys($ventasTotalesPorRegion, max($ventasTotalesPorRegion))[0];
echo "\n=== REGION LIDER EN VENTAS ===\n";
echo "Region con mayores ventas totales: $regionTopVentas\n";
echo "Total de ventas: " . number_format(max($ventasTotalesPorRegion)) . " unidades\n";

function calcularCrecimiento($ventasPorMes) {
    $primerMes = $ventasPorMes[0];
    $ultimoMes = end($ventasPorMes);
    
    if ($primerMes == 0) {
        return $ultimoMes > 0 ? 100 : 0;
    }
    
    return (($ultimoMes - $primerMes) / $primerMes) * 100;
}

function analizarCrecimientoVentas($ventas) {
    $crecimientoPorRegionProducto = [];
    $mayorCrecimiento = -PHP_FLOAT_MAX;
    $menorCrecimiento = PHP_FLOAT_MAX;
    $mejorCombo = '';
    $peorCombo = '';
    
    foreach ($ventas as $region => $productos) {
        $crecimientoPorRegionProducto[$region] = [];
        
        foreach ($productos as $producto => $ventasProducto) {
            $crecimiento = calcularCrecimiento($ventasProducto);
            $crecimientoPorRegionProducto[$region][$producto] = $crecimiento;
            
            $combo = "$producto en $region";
            
            if ($crecimiento > $mayorCrecimiento) {
                $mayorCrecimiento = $crecimiento;
                $mejorCombo = $combo;
            }
            
            if ($crecimiento < $menorCrecimiento) {
                $menorCrecimiento = $crecimiento;
                $peorCombo = $combo;
            }
        }
    }
    
    return [
        'crecimiento_detallado' => $crecimientoPorRegionProducto,
        'mayor_crecimiento' => $mayorCrecimiento,
        'mejor_combo' => $mejorCombo,
        'menor_crecimiento' => $menorCrecimiento,
        'peor_combo' => $peorCombo
    ];
}

echo "\n=== ANALISIS DE CRECIMIENTO DE VENTAS ===\n";
$analisisCrecimiento = analizarCrecimientoVentas($ventas);

foreach ($analisisCrecimiento['crecimiento_detallado'] as $region => $productos) {
    echo "$region:\n";
    foreach ($productos as $producto => $crecimiento) {
        $direccion = $crecimiento >= 0 ? "+" : "";
        echo "  $producto: $direccion" . number_format($crecimiento, 2) . "%\n";
    }
    echo "\n";
}

echo "\n=== DESTACADOS EN CRECIMIENTO ===\n";
echo "MAYOR CRECIMIENTO:\n";
echo "{$analisisCrecimiento['mejor_combo']}: " . number_format($analisisCrecimiento['mayor_crecimiento'], 2) . "%\n\n";

echo "MENOR CRECIMIENTO:\n";
echo "{$analisisCrecimiento['peor_combo']}: " . number_format($analisisCrecimiento['menor_crecimiento'], 2) . "%\n\n";

function crecimientoPromedioPorRegion($ventas) {
    $crecimientoRegiones = [];
    
    foreach ($ventas as $region => $productos) {
        $crecimientos = [];
        foreach ($productos as $producto => $ventasProducto) {
            $crecimientos[] = calcularCrecimiento($ventasProducto);
        }
        $crecimientoRegiones[$region] = array_sum($crecimientos) / count($crecimientos);
    }
    
    return $crecimientoRegiones;
}

echo "\n=== CRECIMIENTO PROMEDIO POR REGION ===\n";
$crecimientoRegiones = crecimientoPromedioPorRegion($ventas);
arsort($crecimientoRegiones);

foreach ($crecimientoRegiones as $region => $crecimientoPromedio) {
    $direccion = $crecimientoPromedio >= 0 ? "+" : "";
    echo "$region: $direccion" . number_format($crecimientoPromedio, 2) . "% promedio\n";
}

function crecimientoPromedioPorProducto($ventas) {
    $crecimientoProductos = [];
    $productos = ["Producto A", "Producto B", "Producto C"];
    
    foreach ($productos as $producto) {
        $crecimientos = [];
        foreach ($ventas as $region => $productosRegion) {
            if (isset($productosRegion[$producto])) {
                $crecimientos[] = calcularCrecimiento($productosRegion[$producto]);
            }
        }
        if (!empty($crecimientos)) {
            $crecimientoProductos[$producto] = array_sum($crecimientos) / count($crecimientos);
        }
    }
    
    return $crecimientoProductos;
}

echo "\n=== CRECIMIENTO PROMEDIO POR PRODUCTO ===\n";
$crecimientoProductos = crecimientoPromedioPorProducto($ventas);
arsort($crecimientoProductos);

foreach ($crecimientoProductos as $producto => $crecimientoPromedio) {
    $direccion = $crecimientoPromedio >= 0 ? "+" : "";
    echo "$producto: $direccion" . number_format($crecimientoPromedio, 2) . "% promedio\n";
}

echo "\n=== RESUMEN EJECUTIVO ===\n";
echo "Total de productos analizados: 3\n";
echo "Total de regiones analizadas: 4\n";
echo "Periodo de analisis: 5 meses\n";
echo "Mejor desempenio: {$analisisCrecimiento['mejor_combo']} (" . number_format($analisisCrecimiento['mayor_crecimiento'], 2) . "%)\n";
echo "Necesita atencion: {$analisisCrecimiento['peor_combo']} (" . number_format($analisisCrecimiento['menor_crecimiento'], 2) . "%)\n";

$mejorRegion = array_keys($crecimientoRegiones)[0];
$mejorProducto = array_keys($crecimientoProductos)[0];

echo "Region con mejor crecimiento promedio: $mejorRegion\n";
echo "Producto con mejor crecimiento promedio: $mejorProducto\n";

echo "\n";
echo "</pre>";
echo "<p><strong>Analisis completo de ventas y crecimiento completado!</strong></p>";
?>