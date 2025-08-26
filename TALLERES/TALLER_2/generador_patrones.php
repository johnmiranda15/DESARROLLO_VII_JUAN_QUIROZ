<?php
// Archivo: TALLER_2/generador_patrones.php

// 1. Patrón de triángulo rectángulo con for
echo "<h3>1. Triángulo rectángulo con asteriscos</h3>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}

// 2. Secuencia de números impares con while
echo "<h3>2. Números impares del 1 al 20</h3>";
$numero = 1;
while ($numero <= 20) {
    if ($numero % 2 != 0) { // condición para impar
        echo $numero . " ";
    }
    $numero++;
}

// 3. Contador regresivo con do-while (saltando el 5)
echo "<h3>3. Contador regresivo desde 10 hasta 1 (sin el 5)</h3>";
$contador = 10;
do {
    if ($contador == 5) {
        $contador--;
        continue; // saltamos el 5
    }
    echo $contador . " ";
    $contador--;
} while ($contador >= 1);
?>
