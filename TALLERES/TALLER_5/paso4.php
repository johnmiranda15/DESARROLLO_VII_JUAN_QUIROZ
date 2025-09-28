<?php
// Paso 4: Ordenamiento y Filtrado Avanzado de Arreglos

// 1. Definir el arreglo de libros
$biblioteca = [
    [
        "titulo" => "Cien años de soledad",
        "autor" => "Gabriel García Márquez",
        "año" => 1967,
        "genero" => "Realismo mágico",
        "prestado" => true
    ],
    [
        "titulo" => "1984",
        "autor" => "George Orwell",
        "año" => 1949,
        "genero" => "Ciencia ficción",
        "prestado" => false
    ],
    [
        "titulo" => "El principito",
        "autor" => "Antoine de Saint-Exupéry",
        "año" => 1943,
        "genero" => "Literatura infantil",
        "prestado" => true
    ],
    [
        "titulo" => "Don Quijote de la Mancha",
        "autor" => "Miguel de Cervantes",
        "año" => 1605,
        "genero" => "Novela",
        "prestado" => false
    ],
    [
        "titulo" => "Orgullo y prejuicio",
        "autor" => "Jane Austen",
        "año" => 1813,
        "genero" => "Novela romántica",
        "prestado" => true
    ]
];

echo "<h1>Sistema de Biblioteca</h1>";
echo "<pre>";

// 2. Función para imprimir la biblioteca
function imprimirBiblioteca($libros) {
    foreach ($libros as $libro) {
        echo "• {$libro['titulo']}\n";
        echo "  Autor: {$libro['autor']}\n";
        echo "  Año: {$libro['año']}\n";
        echo "  Género: {$libro['genero']}\n";
        echo "  Estado: " . ($libro['prestado'] ? "Prestado" : "Disponible") . "\n\n";
    }
}

echo "=== BIBLIOTECA ORIGINAL ===\n";
imprimirBiblioteca($biblioteca);

// 3. Ordenar libros por año de publicación (del más antiguo al más reciente)
$bibliotecaOrdenadaAño = $biblioteca;
usort($bibliotecaOrdenadaAño, function($a, $b) {
    return $a['año'] - $b['año'];
});

echo "=== LIBROS ORDENADOS POR AÑO ===\n";
imprimirBiblioteca($bibliotecaOrdenadaAño);

// 4. Ordenar libros alfabéticamente por título
$bibliotecaOrdenadaTitulo = $biblioteca;
usort($bibliotecaOrdenadaTitulo, function($a, $b) {
    return strcmp($a['titulo'], $b['titulo']);
});

echo "=== LIBROS ORDENADOS POR TÍTULO ===\n";
imprimirBiblioteca($bibliotecaOrdenadaTitulo);

// 5. Filtrar libros disponibles (no prestados)
$librosDisponibles = array_filter($biblioteca, function($libro) {
    return !$libro['prestado'];
});

echo "=== LIBROS DISPONIBLES ===\n";
imprimirBiblioteca($librosDisponibles);

// 6. Filtrar libros por género
function filtrarPorGenero($libros, $genero) {
    return array_filter($libros, function($libro) use ($genero) {
        return strcasecmp($libro['genero'], $genero) === 0;
    });
}

$librosCienciaFiccion = filtrarPorGenero($biblioteca, "Ciencia ficción");
echo "=== LIBROS DE CIENCIA FICCIÓN ===\n";
imprimirBiblioteca($librosCienciaFiccion);

// 7. Obtener lista de autores únicos
$autores = array_unique(array_column($biblioteca, 'autor'));
sort($autores);

echo "=== LISTA DE AUTORES ===\n";
foreach ($autores as $autor) {
    echo "- $autor\n";
}
echo "\n";

// 8. Calcular el año promedio de publicación
$añoPromedio = array_sum(array_column($biblioteca, 'año')) / count($biblioteca);
echo "=== ESTADÍSTICAS ===\n";
echo "Año promedio de publicación: " . round($añoPromedio, 2) . "\n";

// 9. Encontrar el libro más antiguo y el más reciente
$libroMasAntiguo = array_reduce($biblioteca, function($carry, $libro) {
    return (!$carry || $libro['año'] < $carry['año']) ? $libro : $carry;
});

$libroMasReciente = array_reduce($biblioteca, function($carry, $libro) {
    return (!$carry || $libro['año'] > $carry['año']) ? $libro : $carry;
});

echo "Libro más antiguo: {$libroMasAntiguo['titulo']} ({$libroMasAntiguo['año']})\n";
echo "Libro más reciente: {$libroMasReciente['titulo']} ({$libroMasReciente['año']})\n\n";

// 10. TAREA: Función de búsqueda por título o autor
function buscarLibros($biblioteca, $termino) {
    $terminoLower = strtolower($termino);
    
    return array_filter($biblioteca, function($libro) use ($terminoLower) {
        $tituloLower = strtolower($libro['titulo']);
        $autorLower = strtolower($libro['autor']);
        
        // Buscar en título o autor (búsqueda parcial)
        return strpos($tituloLower, $terminoLower) !== false || 
               strpos($autorLower, $terminoLower) !== false;
    });
}

// Ejemplos de búsqueda
echo "=== FUNCIÓN DE BÚSQUEDA ===\n";

$resultadosBusqueda1 = buscarLibros($biblioteca, "quijote");
echo "Resultados de búsqueda para 'quijote':\n";
imprimirBiblioteca($resultadosBusqueda1);

$resultadosBusqueda2 = buscarLibros($biblioteca, "garcía");
echo "Resultados de búsqueda para 'garcía':\n";
imprimirBiblioteca($resultadosBusqueda2);

$resultadosBusqueda3 = buscarLibros($biblioteca, "orwell");
echo "Resultados de búsqueda para 'orwell':\n";
imprimirBiblioteca($resultadosBusqueda3);

// 11. TAREA: Función para generar reporte completo de la biblioteca
function generarReporteBiblioteca($biblioteca) {
    $reporte = [];
    
    // Número total de libros
    $reporte['total_libros'] = count($biblioteca);
    
    // Número de libros prestados y disponibles
    $librosPrestados = array_filter($biblioteca, function($libro) {
        return $libro['prestado'];
    });
    $reporte['libros_prestados'] = count($librosPrestados);
    $reporte['libros_disponibles'] = $reporte['total_libros'] - $reporte['libros_prestados'];
    
    // Número de libros por género
    $generos = array_column($biblioteca, 'genero');
    $reporte['libros_por_genero'] = array_count_values($generos);
    
    // Autor con más libros
    $autores = array_column($biblioteca, 'autor');
    $conteoAutores = array_count_values($autores);
    arsort($conteoAutores); // Ordenar de mayor a menor
    $autorConMasLibros = array_keys($conteoAutores)[0];
    $cantidadLibrosAutor = $conteoAutores[$autorConMasLibros];
    $reporte['autor_con_mas_libros'] = [
        'nombre' => $autorConMasLibros,
        'cantidad' => $cantidadLibrosAutor
    ];
    
    // Estadísticas adicionales
    $años = array_column($biblioteca, 'año');
    $reporte['año_mas_antiguo'] = min($años);
    $reporte['año_mas_reciente'] = max($años);
    $reporte['año_promedio'] = round(array_sum($años) / count($años), 2);
    
    return $reporte;
}

// Mostrar reporte completo
echo "=== REPORTE COMPLETO DE LA BIBLIOTECA ===\n";
$reporte = generarReporteBiblioteca($biblioteca);

echo "RESUMEN GENERAL:\n";
echo "- Total de libros: {$reporte['total_libros']}\n";
echo "- Libros prestados: {$reporte['libros_prestados']}\n";
echo "- Libros disponibles: {$reporte['libros_disponibles']}\n\n";

echo "DISTRIBUCIÓN POR GÉNERO:\n";
foreach ($reporte['libros_por_genero'] as $genero => $cantidad) {
    echo "- $genero: $cantidad libro(s)\n";
}
echo "\n";

echo "AUTOR DESTACADO:\n";
echo "- {$reporte['autor_con_mas_libros']['nombre']}: {$reporte['autor_con_mas_libros']['cantidad']} libro(s)\n\n";

echo "INFORMACIÓN TEMPORAL:\n";
echo "- Año más antiguo: {$reporte['año_mas_antiguo']}\n";
echo "- Año más reciente: {$reporte['año_mas_reciente']}\n";
echo "- Año promedio: {$reporte['año_promedio']}\n\n";

// Función adicional: Búsqueda avanzada con múltiples criterios
function busquedaAvanzada($biblioteca, $criterios = []) {
    return array_filter($biblioteca, function($libro) use ($criterios) {
        $coincide = true;
        
        if (isset($criterios['genero']) && strcasecmp($libro['genero'], $criterios['genero']) !== 0) {
            $coincide = false;
        }
        
        if (isset($criterios['prestado']) && $libro['prestado'] !== $criterios['prestado']) {
            $coincide = false;
        }
        
        if (isset($criterios['año_min']) && $libro['año'] < $criterios['año_min']) {
            $coincide = false;
        }
        
        if (isset($criterios['año_max']) && $libro['año'] > $criterios['año_max']) {
            $coincide = false;
        }
        
        return $coincide;
    });
}

// Ejemplo de búsqueda avanzada
echo "=== BÚSQUEDA AVANZADA ===\n";
$librosNovelaDisponibles = busquedaAvanzada($biblioteca, [
    'prestado' => false,
    'año_min' => 1800
]);

echo "Novelas disponibles desde 1800:\n";
imprimirBiblioteca($librosNovelaDisponibles);

echo "</pre>";
echo "<p><strong>Sistema de biblioteca completado con todas las funcionalidades!</strong></p>";
?>