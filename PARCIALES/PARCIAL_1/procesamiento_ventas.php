<?php
// procesamiendo_ventas.php
function calcular_total_ventas($datos_ventas) {
    $total = 0;
    foreach ($datos_ventas as $producto => $regiones) {
        $total += array_sum($regiones);
    }
    return $total;
}

// Función para determinar el producto más vendido
function producto_mas_vendido($datos_ventas) {
    $producto_max = '';
    $venta_max = 0;
    
    foreach ($datos_ventas as $producto => $regiones) {
        $total_producto = array_sum($regiones);
        if ($total_producto > $venta_max) {
            $venta_max = $total_producto;
            $producto_max = $producto;
        }
    }
    return $producto_max;
}

// Función para calcular ventas por región
function ventas_por_region($datos_ventas) {
    $regiones = [];
    
    foreach ($datos_ventas as $producto => $ventas_regionales) {
        foreach ($ventas_regionales as $region => $cantidad) {
            if (!isset($regiones[$region])) {
                $regiones[$region] = 0;
            }
            $regiones[$region] += $cantidad;
        }
    }
    
    arsort($regiones);
    return $regiones;
}

?>