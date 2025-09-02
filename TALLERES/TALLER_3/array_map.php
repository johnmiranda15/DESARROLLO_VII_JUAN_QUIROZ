<?php
// EJEMPLOS DE array_map() EN PHP

// Función auxiliar para imprimir arrays en navegador
function mostrarArray($titulo, $array) {
    echo "<b>$titulo</b><br>";
    echo "<pre>";
    print_r($array);
    echo "</pre><br>";
}

// PARTE 1: EJEMPLOS BÁSICOS

$numeros = [1, 2, 3, 4, 5];

function cuadrado($n) { return $n * $n; }
$cuadrados = array_map('cuadrado', $numeros);

mostrarArray("Ejemplo 1: Cuadrados", $cuadrados);

$duplicados = array_map(fn($n) => $n * 2, $numeros);
mostrarArray("Ejemplo 2: Duplicados", $duplicados);

$frutas = ["manzana", "banana", "cereza"];
$frutasMayus = array_map('strtoupper', $frutas);
mostrarArray("Ejemplo 3: Frutas en mayúsculas", $frutasMayus);

// PARTE 2: INTERMEDIO

$productos = [
    ["nombre" => "Laptop", "precio" => 800],
    ["nombre" => "Teléfono", "precio" => 500],
];

$productosConDescuento = array_map(function($producto) {
    $producto['precio_descuento'] = $producto['precio'] * 0.9;
    return $producto;
}, $productos);

mostrarArray("Ejemplo 5: Productos con descuento", $productosConDescuento);

$nombres = ["Ana", "Carlos", "Beatriz"];
$apellidos = ["García", "Rodríguez", "López"];

$nombresCompletos = array_map(fn($n, $a) => "$n $a", $nombres, $apellidos);
mostrarArray("Ejemplo 6: Nombres completos", $nombresCompletos);

// PARTE 3: AVANZADO

function aplicarOperaciones($array, $operaciones) {
    return array_map(fn($valor, $op) => $op($valor), $array, $operaciones);
}

$valores = [1, 2, 3, 4, 5];
$operaciones = [
    fn($n) => $n * 2,
    fn($n) => $n * $n,
    fn($n) => $n + 10,
    fn($n) => $n / 2,
    fn($n) => $n % 3
];

$resultados = aplicarOperaciones($valores, $operaciones);
mostrarArray("Ejemplo 7: Operaciones personalizadas", $resultados);

$cubos = array_map(fn($n) => $n ** 3, $numeros);
mostrarArray("Ejemplo 8: Cubos", $cubos);

?>