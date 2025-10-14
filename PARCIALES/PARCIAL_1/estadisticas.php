<?php
// Funciones estadísticas

//Recibe un array de números y devuelve la media aritmética
function calcular_media($datos)
{
    return array_sum($datos) / count($datos);
}

//Recibe un array de números y devuelve la mediana
function calcular_mediana($datos)
{
    #Ordena los números de menor a mayor
    sort($datos);
    $n = count($datos);
    $middle = floor($n / 2);
    if ($n % 2 == 0) {
        return ($datos[$middle - 1] + $datos[$middle]) / 2;
    } else {
        return $datos[$middle];
    }
}

//Recibe un array de números y devuelve la moda (el valor más frecuente)
function encontrar_moda($datos)
{
    $valores = array_count_values($datos);
    $max = max($valores);
    $moda = array_keys($valores, $max);
    return $moda;
}
?>