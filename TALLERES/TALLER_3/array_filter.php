<?php
// Ejemplo básico de array_filter()
$numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$pares = array_filter($numeros, function($n) {
    return $n % 2 == 0;
});

echo "Números originales: " . implode(", ", $numeros) . "</br>";
echo "Números pares: " . implode(", ", $pares) . "</br>";

// Ejemplo con una función nombrada
function esPrimo($n) {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

$primos = array_filter($numeros, 'esPrimo');
echo "Números primos: " . implode(", ", $primos) . "</br>";

// Ejercicio: Filtra un array de strings para obtener solo las palabras que comienzan con una vocal
$palabras = ["auto", "casa", "elefante", "iglú", "oso", "uva", "zapato", "Árbol", "Estrella", "isla"];
$empiezaConVocal = array_filter($palabras, function($palabra) {
    return in_array(mb_strtolower($palabra[0]), ['a', 'e', 'i', 'o', 'u', 'á']);
});

echo "</br>Palabras originales: " . implode(", ", $palabras) . "</br>";
echo "Palabras que empiezan con vocal: " . implode(", ", $empiezaConVocal) . "</br>";

// Bonus: Filtrar un array asociativo
$personas = [
    ["nombre" => "Ana", "edad" => 25],
    ["nombre" => "Carlos", "edad" => 30],
    ["nombre" => "Beatriz", "edad" => 20],
    ["nombre" => "David", "edad" => 35]
];

$mayoresDe25 = array_filter($personas, function($persona) {
    return $persona['edad'] > 25;
});

echo "</br>Personas mayores de 25 años:</br>";
foreach ($mayoresDe25 as $persona) {
    echo "- {$persona['nombre']} ({$persona['edad']} años)</br>";
}

// Extra: Uso de array_filter() con ARRAY_FILTER_USE_BOTH
$frutas = ["manzana" => 3, "banana" => 5, "naranja" => 2];
$frutasConMasDe3 = array_filter($frutas, function($cantidad, $nombre) {
    return $cantidad > 3 && strlen($nombre) > 5;
}, ARRAY_FILTER_USE_BOTH);

echo "</br>Frutas con más de 3 unidades y nombre largo:</br>";
print_r($frutasConMasDe3);

// Desafío: Crear una función de filtrado personalizada
function filtrarPor($array, $campo, $valor, $operador = '==') {
    return array_filter($array, function($item) use ($campo, $valor, $operador) {
        if (!isset($item[$campo])) return false;
        switch ($operador) {
            case '==': return $item[$campo] == $valor;
            case '!=': return $item[$campo] != $valor;
            case '>':  return $item[$campo] > $valor;
            case '<':  return $item[$campo] < $valor;
            case '>=': return $item[$campo] >= $valor;
            case '<=': return $item[$campo] <= $valor;
            default: return false;
        }
    });
}

$estudiantes = [
    ["nombre" => "Elena", "curso" => "PHP", "nota" => 85],
    ["nombre" => "Miguel", "curso" => "JavaScript", "nota" => 90],
    ["nombre" => "Sofía", "curso" => "PHP", "nota" => 78],
    ["nombre" => "Lucas", "curso" => "Python", "nota" => 92]
];

$estudiantesPHP = filtrarPor($estudiantes, "curso", "PHP");
echo "</br>Estudiantes de PHP:</br>";
foreach ($estudiantesPHP as $estudiante) {
    echo "- {$estudiante['nombre']} (Nota: {$estudiante['nota']})</br>";
}

// Ejemplo adicional: Números impares
$impares = array_filter($numeros, function($n) {
    return $n % 2 != 0;
});
echo "Números impares: " . implode(", ", $impares) . "</br>";

// Prueba filtrarPor() con diferentes operadores
$estudiantesNotaAlta = filtrarPor($estudiantes, "nota", 85, '>=');
echo "</br>Estudiantes con nota mayor o igual a 85:</br>";
foreach ($estudiantesNotaAlta as $estudiante) {
    echo "- {$estudiante['nombre']} (Nota: {$estudiante['nota']})</br>";
}

// Crea tu propio array y función de filtrado
$edades = [15, 22, 18, 30, 17, 25];
$mayoresDeEdad = array_filter($edades, function($edad) {
    return $edad >= 18;
});
echo "</br>Mayores de edad: " . implode(", ", $mayoresDeEdad) . "</br>";
?>