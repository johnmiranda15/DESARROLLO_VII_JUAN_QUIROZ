<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electrónica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electrónica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electrónica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electrónica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electrónica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
}
';

echo "<h1>Sistema de Tienda ElectroTech</h1>";
echo "<pre>";

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    foreach ($productos as $producto) {
        echo "• {$producto['nombre']}\n";
        echo "  Precio: \${$producto['precio']}\n";
        echo "  Categorías: " . implode(", ", $producto['categorias']) . "\n\n";
    }
}

echo "=== PRODUCTOS DE {$tiendaData['tienda']} ===\n";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "=== ESTADÍSTICAS DEL INVENTARIO ===\n";
echo "Valor total del inventario: \$$valorTotal\n";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "Producto más caro: {$productoMasCaro['nombre']} (\${$productoMasCaro['precio']})\n\n";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "=== PRODUCTOS EN CATEGORÍA 'COMPUTADORAS' ===\n";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electrónica", "accesorios", "wearables"]
];

$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo "=== PRODUCTO AGREGADO ===\n";
echo "Nuevo producto: {$nuevoProducto['nombre']} agregado exitosamente.\n\n";

// TAREA: Sistema de ventas completo

// Crear arreglo de ventas simuladas
$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 2, "fecha" => "2024-01-15"],
    ["producto_id" => 2, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-01-16"],
    ["producto_id" => 3, "cliente_id" => 103, "cantidad" => 3, "fecha" => "2024-01-17"],
    ["producto_id" => 1, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-01-18"],
    ["producto_id" => 4, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2024-01-19"],
    ["producto_id" => 2, "cliente_id" => 102, "cantidad" => 2, "fecha" => "2024-01-20"],
    ["producto_id" => 5, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-01-21"],
    ["producto_id" => 3, "cliente_id" => 101, "cantidad" => 2, "fecha" => "2024-01-22"],
    ["producto_id" => 6, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-01-23"]
];

// Función para buscar producto por ID
function buscarProducto($productos, $id) {
    foreach ($productos as $producto) {
        if ($producto['id'] == $id) {
            return $producto;
        }
    }
    return null;
}

// Función para buscar cliente por ID
function buscarCliente($clientes, $id) {
    foreach ($clientes as $cliente) {
        if ($cliente['id'] == $id) {
            return $cliente;
        }
    }
    return null;
}

// Función principal: generar resumen de ventas
function generarResumenVentas($ventas, $productos, $clientes) {
    $resumen = [
        'total_ventas' => 0,
        'total_productos_vendidos' => 0,
        'numero_transacciones' => count($ventas),
        'productos_vendidos' => [],
        'clientes_compradores' => [],
        'ventas_por_fecha' => []
    ];
    
    // Procesar cada venta
    foreach ($ventas as $venta) {
        $producto = buscarProducto($productos, $venta['producto_id']);
        $cliente = buscarCliente($clientes, $venta['cliente_id']);
        
        if ($producto && $cliente) {
            // Calcular valor de la venta
            $valorVenta = $producto['precio'] * $venta['cantidad'];
            $resumen['total_ventas'] += $valorVenta;
            $resumen['total_productos_vendidos'] += $venta['cantidad'];
            
            // Contar productos vendidos
            $productoNombre = $producto['nombre'];
            if (!isset($resumen['productos_vendidos'][$productoNombre])) {
                $resumen['productos_vendidos'][$productoNombre] = [
                    'cantidad' => 0,
                    'valor_total' => 0,
                    'precio_unitario' => $producto['precio']
                ];
            }
            $resumen['productos_vendidos'][$productoNombre]['cantidad'] += $venta['cantidad'];
            $resumen['productos_vendidos'][$productoNombre]['valor_total'] += $valorVenta;
            
            // Contar compras por cliente
            $clienteNombre = $cliente['nombre'];
            if (!isset($resumen['clientes_compradores'][$clienteNombre])) {
                $resumen['clientes_compradores'][$clienteNombre] = [
                    'productos_comprados' => 0,
                    'total_gastado' => 0,
                    'transacciones' => 0
                ];
            }
            $resumen['clientes_compradores'][$clienteNombre]['productos_comprados'] += $venta['cantidad'];
            $resumen['clientes_compradores'][$clienteNombre]['total_gastado'] += $valorVenta;
            $resumen['clientes_compradores'][$clienteNombre]['transacciones']++;
            
            // Ventas por fecha
            $fecha = $venta['fecha'];
            if (!isset($resumen['ventas_por_fecha'][$fecha])) {
                $resumen['ventas_por_fecha'][$fecha] = 0;
            }
            $resumen['ventas_por_fecha'][$fecha] += $valorVenta;
        }
    }
    
    return $resumen;
}

// Generar y mostrar resumen de ventas
echo "=== RESUMEN DE VENTAS ===\n";
$resumenVentas = generarResumenVentas($ventas, $tiendaData['productos'], $tiendaData['clientes']);

echo "TOTALES GENERALES:\n";
echo "- Total en ventas: \$" . number_format($resumenVentas['total_ventas'], 2) . "\n";
echo "- Productos vendidos: {$resumenVentas['total_productos_vendidos']} unidades\n";
echo "- Número de transacciones: {$resumenVentas['numero_transacciones']}\n";
echo "- Ticket promedio: \$" . number_format($resumenVentas['total_ventas'] / $resumenVentas['numero_transacciones'], 2) . "\n\n";

// Encontrar producto más vendido
$productoMasVendido = '';
$mayorCantidad = 0;
foreach ($resumenVentas['productos_vendidos'] as $nombre => $datos) {
    if ($datos['cantidad'] > $mayorCantidad) {
        $mayorCantidad = $datos['cantidad'];
        $productoMasVendido = $nombre;
    }
}

echo "PRODUCTO MÁS VENDIDO:\n";
echo "- Producto: $productoMasVendido\n";
echo "- Unidades vendidas: $mayorCantidad\n";
echo "- Valor total generado: \$" . number_format($resumenVentas['productos_vendidos'][$productoMasVendido]['valor_total'], 2) . "\n\n";

// Encontrar cliente que más ha comprado
$clienteTopComprador = '';
$mayorGasto = 0;
foreach ($resumenVentas['clientes_compradores'] as $nombre => $datos) {
    if ($datos['total_gastado'] > $mayorGasto) {
        $mayorGasto = $datos['total_gastado'];
        $clienteTopComprador = $nombre;
    }
}

echo "CLIENTE TOP:\n";
echo "- Cliente: $clienteTopComprador\n";
echo "- Total gastado: \$" . number_format($mayorGasto, 2) . "\n";
echo "- Productos comprados: {$resumenVentas['clientes_compradores'][$clienteTopComprador]['productos_comprados']} unidades\n";
echo "- Transacciones realizadas: {$resumenVentas['clientes_compradores'][$clienteTopComprador]['transacciones']}\n\n";

// Mostrar detalle de productos vendidos
echo "DETALLE DE PRODUCTOS VENDIDOS:\n";
foreach ($resumenVentas['productos_vendidos'] as $producto => $datos) {
    echo "• $producto\n";
    echo "  Unidades vendidas: {$datos['cantidad']}\n";
    echo "  Precio unitario: \${$datos['precio_unitario']}\n";
    echo "  Valor total: \$" . number_format($datos['valor_total'], 2) . "\n\n";
}

// Mostrar detalle de clientes
echo "DETALLE DE CLIENTES:\n";
foreach ($resumenVentas['clientes_compradores'] as $cliente => $datos) {
    echo "• $cliente\n";
    echo "  Total gastado: \$" . number_format($datos['total_gastado'], 2) . "\n";
    echo "  Productos comprados: {$datos['productos_comprados']} unidades\n";
    echo "  Transacciones: {$datos['transacciones']}\n\n";
}

// Mostrar ventas por fecha
echo "VENTAS POR FECHA:\n";
ksort($resumenVentas['ventas_por_fecha']); // Ordenar por fecha
foreach ($resumenVentas['ventas_por_fecha'] as $fecha => $total) {
    echo "• $fecha: \$" . number_format($total, 2) . "\n";
}

echo "\n";
echo "</pre>";
echo "<p><strong>Sistema de tienda con análisis de ventas completado!</strong></p>";
?>