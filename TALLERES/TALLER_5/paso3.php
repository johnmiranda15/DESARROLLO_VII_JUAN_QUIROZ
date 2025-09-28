<?php
// 1. Crear un arreglo de estudiantes con sus calificaciones
$estudiantes = [
    ["nombre" => "Ana", "calificaciones" => [85, 92, 78, 96, 88]],
    ["nombre" => "Juan", "calificaciones" => [75, 84, 91, 79, 86]],
    ["nombre" => "María", "calificaciones" => [92, 95, 89, 97, 93]],
    ["nombre" => "Pedro", "calificaciones" => [70, 72, 78, 75, 77]],
    ["nombre" => "Laura", "calificaciones" => [88, 86, 90, 85, 89]]
];

echo "<h1>Sistema de Calificaciones Estudiantiles</h1>";
echo "<pre>";

// 2. Función para calcular el promedio de calificaciones
function calcularPromedio($calificaciones) {
    return array_sum($calificaciones) / count($calificaciones);
}

// 3. Función para asignar una letra de calificación basada en el promedio
function asignarLetraCalificacion($promedio) {
    if ($promedio >= 90) return 'A';
    if ($promedio >= 80) return 'B';
    if ($promedio >= 70) return 'C';
    if ($promedio >= 60) return 'D';
    return 'F';
}

// 4. Procesar y mostrar información de estudiantes
echo "=== INFORMACIÓN DE ESTUDIANTES ===\n\n";
foreach ($estudiantes as &$estudiante) {
    $promedio = calcularPromedio($estudiante["calificaciones"]);
    $estudiante["promedio"] = $promedio;
    $estudiante["letra_calificacion"] = asignarLetraCalificacion($promedio);
    
    echo "• {$estudiante['nombre']}\n";
    echo "  Calificaciones: " . implode(", ", $estudiante["calificaciones"]) . "\n";
    echo "  Promedio: " . number_format($promedio, 2) . "\n";
    echo "  Calificación: {$estudiante['letra_calificacion']}\n\n";
}

// 5. Encontrar al estudiante con el promedio más alto
$mejorEstudiante = array_reduce($estudiantes, function($mejor, $actual) {
    return (!$mejor || $actual["promedio"] > $mejor["promedio"]) ? $actual : $mejor;
});

echo "=== MEJOR ESTUDIANTE ===\n";
echo "Estudiante con el promedio más alto: {$mejorEstudiante['nombre']}\n";
echo "Promedio: " . number_format($mejorEstudiante['promedio'], 2) . "\n\n";

// 6. Calcular y mostrar el promedio general de la clase
$promedioGeneral = array_sum(array_column($estudiantes, "promedio")) / count($estudiantes);
echo "=== ESTADÍSTICAS GENERALES ===\n";
echo "Promedio general de la clase: " . number_format($promedioGeneral, 2) . "\n\n";

// 7. Contar estudiantes por letra de calificación
$conteoCalificaciones = array_count_values(array_column($estudiantes, "letra_calificacion"));
echo "=== DISTRIBUCIÓN DE CALIFICACIONES ===\n";
foreach ($conteoCalificaciones as $letra => $cantidad) {
    echo "$letra: $cantidad estudiante(s)\n";
}

// TAREA: Funciones para tutoría y honor

// Función para identificar estudiantes que necesitan tutoría (promedio < 75)
function estudiantesNecesitanTutoria($estudiantes) {
    $necesitanTutoria = [];
    
    foreach ($estudiantes as $estudiante) {
        if ($estudiante["promedio"] < 75) {
            $necesitanTutoria[] = $estudiante;
        }
    }
    
    return $necesitanTutoria;
}

// Función para identificar estudiantes de honor (promedio >= 90)
function estudiantesDeHonor($estudiantes) {
    $deHonor = [];
    
    foreach ($estudiantes as $estudiante) {
        if ($estudiante["promedio"] >= 90) {
            $deHonor[] = $estudiante;
        }
    }
    
    return $deHonor;
}

// Mostrar estudiantes que necesitan tutoría
echo "\n=== ESTUDIANTES QUE NECESITAN TUTORÍA ===\n";
$tutoria = estudiantesNecesitanTutoria($estudiantes);

if (empty($tutoria)) {
    echo "¡Excelente! Ningún estudiante necesita tutoría.\n";
} else {
    echo "Los siguientes estudiantes necesitan apoyo adicional (promedio < 75):\n\n";
    foreach ($tutoria as $estudiante) {
        echo "• {$estudiante['nombre']}\n";
        echo "  Promedio: " . number_format($estudiante['promedio'], 2) . "\n";
        echo "  Calificación: {$estudiante['letra_calificacion']}\n";
        echo "  Calificaciones: " . implode(", ", $estudiante['calificaciones']) . "\n\n";
    }
}

// Mostrar estudiantes de honor
echo "=== ESTUDIANTES DE HONOR ===\n";
$honor = estudiantesDeHonor($estudiantes);

if (empty($honor)) {
    echo "Ningún estudiante alcanzó el nivel de honor este período.\n";
} else {
    echo "¡Felicitaciones! Los siguientes estudiantes alcanzaron el cuadro de honor (promedio ≥ 90):\n\n";
    foreach ($honor as $estudiante) {
        echo "  {$estudiante['nombre']}\n";
        echo "   Promedio: " . number_format($estudiante['promedio'], 2) . "\n";
        echo "   Calificación: {$estudiante['letra_calificacion']}\n";
        echo "   Calificaciones: " . implode(", ", $estudiante['calificaciones']) . "\n\n";
    }
}

// Función adicional: Resumen estadístico
function resumenEstadistico($estudiantes) {
    $total = count($estudiantes);
    $tutoria = count(estudiantesNecesitanTutoria($estudiantes));
    $honor = count(estudiantesDeHonor($estudiantes));
    $regulares = $total - $tutoria - $honor;
    
    echo "=== RESUMEN ESTADÍSTICO ===\n";
    echo "Total de estudiantes: $total\n";
    echo "Estudiantes de honor: $honor (" . round(($honor/$total)*100, 1) . "%)\n";
    echo "Estudiantes regulares: $regulares (" . round(($regulares/$total)*100, 1) . "%)\n";
    echo "Estudiantes que necesitan tutoría: $tutoria (" . round(($tutoria/$total)*100, 1) . "%)\n\n";
}

// Mostrar resumen estadístico
resumenEstadistico($estudiantes);

echo "</pre>";
echo "<p><strong>Sistema de calificaciones completado!</strong></p>";
?>