<?php
// Ejemplo básico de rand()
echo "Número aleatorio: " . rand() . "</br>";

// Generar número aleatorio en un rango específico
$min = 1;
$max = 10;
echo "Número aleatorio entre $min y $max: " . rand($min, $max) . "</br>";

// Modifica los rangos y observa los resultados
echo "Número aleatorio entre 1 y 10: " . rand(1, 10) . "</br>";
echo "Número aleatorio entre 100 y 200: " . rand(100, 200) . "</br>";

// Ejercicio: Simular el lanzamiento de un dado
function lanzarDado() {
    return rand(1, 6);
}

echo "</br>Lanzamiento de dado: " . lanzarDado() . "</br>";

// Simular múltiples lanzamientos
$lanzamientos = 10;
echo "Resultados de $lanzamientos lanzamientos:</br>";
for ($i = 0; $i < $lanzamientos; $i++) {
    echo lanzarDado() . " ";
}
echo "</br>";

// Experimenta con la función generarContraseña()
function generarContraseña($longitud = 8, $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
    $contraseña = '';
    $max = strlen($caracteres) - 1;
    for ($i = 0; $i < $longitud; $i++) {
        $contraseña .= $caracteres[rand(0, $max)];
    }
    return $contraseña;
}
echo "Contraseña de 8 caracteres: " . generarContraseña(8) . "</br>";
echo "Contraseña de 12 caracteres (solo números): " . generarContraseña(12, '0123456789') . "</br>";
echo "Contraseña de 6 caracteres (letras minúsculas): " . generarContraseña(6, 'abcdefghijklmnopqrstuvwxyz') . "</br>";

// Extra: Seleccionar elemento aleatorio de un array
$frutas = ['manzana', 'banana', 'naranja', 'uva', 'pera'];
$frutaAleatoria = $frutas[rand(0, count($frutas) - 1)];
echo "</br>Fruta seleccionada aleatoriamente: $frutaAleatoria</br>";

// Desafío: Implementar un generador de lotería
function generarNumerosLoteria($cantidadNumeros, $minimo, $maximo) {
    $numeros = [];
    while (count($numeros) < $cantidadNumeros) {
        $numero = rand($minimo, $maximo);
        if (!in_array($numero, $numeros)) {
            $numeros[] = $numero;
        }
    }
    sort($numeros);
    return $numeros;
}

$numerosLoteria = generarNumerosLoteria(6, 1, 49);
echo "</br>Números de lotería generados: " . implode(", ", $numerosLoteria) . "</br>";

// Ejemplo adicional: Simular probabilidades
function simularProbabilidad($probabilidad) {
    return rand(1, 100) <= $probabilidad;
}

$intentos = 1000;
$exitos = 0;
$probabilidad = 30; // 30% de probabilidad

for ($i = 0; $i < $intentos; $i++) {
    if (simularProbabilidad($probabilidad)) {
        $exitos++;
    }
}

echo "</br>Simulación de probabilidad ($probabilidad%):</br>";
echo "Éxitos: $exitos de $intentos intentos (" . ($exitos / $intentos * 100) . "%)</br>";

// Juego simple: adivina el número
$numeroSecreto = rand(1, 5);
$intentoUsuario = 3; // Cambia este valor para probar

if ($intentoUsuario == $numeroSecreto) {
    echo "¡Felicidades! Adivinaste el número ($numeroSecreto).</br>";
} else {
    echo "Intenta de nuevo. El número era $numeroSecreto.</br>";
}
?>