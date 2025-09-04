<?php
// Ejemplo básico de array_sum()
$numeros = [10, 20, 30, 40, 50];
$suma = array_sum($numeros);
echo "La suma de " . implode(", ", $numeros) . " es: $suma</br>";

// Suma de números decimales
$decimales = [1.5, 2.3, 3.7, 4.1, 5.8];
$sumaDecimales = array_sum($decimales);
echo "</br>La suma de los decimales es: " . round($sumaDecimales, 2) . "</br>";

// Ejercicio: Calcular el total de ventas
$ventas = [
    "Lunes" => 100.50,
    "Martes" => 200.75,
    "Miércoles" => 50.25,
    "Jueves" => 300.00,
    "Viernes" => 250.50
];
$totalVentas = array_sum($ventas);
echo "</br>Total de ventas de la semana: $" . number_format($totalVentas, 2) . "</br>";

// Bonus: Calcular el promedio de calificaciones
$calificaciones = [85, 92, 78, 95, 88];
$promedio = array_sum($calificaciones) / count($calificaciones);
echo "</br>Calificaciones: " . implode(", ", $calificaciones);
echo "</br>Promedio de calificaciones: " . round($promedio, 2) . "</br>";

// Extra: Suma de valores en un array multidimensional
$gastosMensuales = [
    "Enero" => ["Comida" => 300, "Transporte" => 100, "Entretenimiento" => 150],
    "Febrero" => ["Comida" => 280, "Transporte" => 90, "Entretenimiento" => 120],
    "Marzo" => ["Comida" => 310, "Transporte" => 110, "Entretenimiento" => 140]
];

$totalGastos = array_sum(array_map('array_sum', $gastosMensuales));
echo "</br>Total de gastos en el trimestre: $" . number_format($totalGastos, 2) . "</br>";

// Desafío: Función para sumar solo valores pares
function sumaPares($array) {
    return array_sum(array_filter($array, function($num) {
        return $num % 2 == 0;
    }));
}

$numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
echo "</br>Números: " . implode(", ", $numeros);
echo "</br>Suma de números pares: " . sumaPares($numeros) . "</br>";

// Ejemplo adicional: Cálculo de impuestos
$productos = [
    ["nombre" => "Laptop", "precio" => 1000, "impuesto" => 0.16],
    ["nombre" => "Teléfono", "precio" => 500, "impuesto" => 0.10],
    ["nombre" => "Tablet", "precio" => 300, "impuesto" => 0.08]
];

$totalImpuestos = array_sum(array_map(function($producto) {
    return $producto['precio'] * $producto['impuesto'];
}, $productos));

echo "</br>Total de impuestos a pagar: $" . number_format($totalImpuestos, 2) . "</br>";

// 1. Modifica los valores en los arrays y observa los resultados
$numeros = [10, 20, 30, 40, 50];
$suma = array_sum($numeros);
echo "La suma de " . implode(", ", $numeros) . " es: $suma</br>";

// 2. Crea tu propio array asociativo y usa array_sum()
$donaciones = [
    "Juan" => 50,
    "Ana" => 75,
    "Luis" => 100
];
echo "</br>Total de donaciones: $" . array_sum($donaciones) . "</br>";

// 3. Modifica sumaPares() para sumar solo impares o mayores a cierto valor
function sumaImpares($array) {
    return array_sum(array_filter($array, function($num) {
        return $num % 2 != 0;
    }));
}
echo "</br>Suma de números impares: " . sumaImpares($numeros) . "</br>";

function sumaMayoresA($array, $limite) {
    return array_sum(array_filter($array, function($num) use ($limite) {
        return $num > $limite;
    }));
}
echo "Suma de números mayores a 25: " . sumaMayoresA($numeros, 25) . "</br>";

// 4. Ejemplo usando array_sum() con array_map()
$precios = [100, 200, 300];
$iva = 0.15;
$preciosConIVA = array_map(function($precio) use ($iva) {
    return $precio * (1 + $iva);
}, $precios);
echo "</br>Precios con IVA: " . implode(", ", $preciosConIVA) . "</br>";
echo "Suma total con IVA: " . array_sum($preciosConIVA) . "</br>";

// Ejemplo usando array_reduce()
$ventas = [120, 80, 150, 200];
$totalVentas = array_reduce($ventas, function($carry, $item) {
    return $carry + $item;
}, 0);
echo "</br>Total de ventas usando array_reduce: $totalVentas</br>";
?>