<?php
// Ejemplo básico de in_array()
$frutas = ["manzana", "banana", "naranja", "uva"];
$buscar = "naranja"; // Cambia el valor para experimentar

if (in_array($buscar, $frutas)) {
    echo "$buscar está en la lista de frutas.</br>";
} else {
    echo "$buscar no está en la lista de frutas.</br>";
}

// Ejemplo con comparación estricta
$numeros = [1, "2", 3, "4", 5];
$buscarNumero = 2; // Cambia el valor para experimentar

echo "</br>Buscando '$buscarNumero' en el array de números:</br>";
echo "Comparación normal: " . (in_array($buscarNumero, $numeros) ? "Encontrado" : "No encontrado") . "</br>";
echo "Comparación estricta: " . (in_array($buscarNumero, $numeros, true) ? "Encontrado" : "No encontrado") . "</br>";

// Modifica el array de colores primarios y prueba diferentes colores
$coloresPrimarios = ["rojo", "azul", "amarillo", "verde"];
$colorUsuario = "Azul"; // Cambia el color para probar

echo "</br>¿$colorUsuario es un color primario? " .
     (in_array(strtolower($colorUsuario), $coloresPrimarios) ? "Sí" : "No") . "</br>";

// Añade más elementos a $diasBuscar y observa los resultados
$diasSemana = ["lunes", "martes", "miércoles", "jueves", "viernes", "sábado", "domingo"];
$diasBuscar = ["lunes", "sábado", "festivo", "domingo", "martes"]; // Añade más días

function elementosEnArray($elementos, $array) {
    $resultados = [];
    foreach ($elementos as $elemento) {
        $resultados[$elemento] = in_array($elemento, $array);
    }
    return $resultados;
}

$resultadosDias = elementosEnArray($diasBuscar, $diasSemana);
echo "</br>Resultados de búsqueda de días:</br>";
foreach ($resultadosDias as $dia => $encontrado) {
    echo "$dia: " . ($encontrado ? "Encontrado" : "No encontrado") . "</br>";
}

// Prueba la función in_array_case_insensitive() con diferentes strings y arrays
function in_array_case_insensitive($needle, $haystack) {
    return in_array(strtolower($needle), array_map('strtolower', $haystack));
}

$lenguajes = ["PHP", "Java", "Python", "JavaScript"];
$buscarLenguaje = "PYTHON"; // Cambia el valor para experimentar

echo "</br></br>Buscando '$buscarLenguaje' en lenguajes de programación:</br>";
echo in_array_case_insensitive($buscarLenguaje, $lenguajes) ? "Encontrado" : "No encontrado";
?>