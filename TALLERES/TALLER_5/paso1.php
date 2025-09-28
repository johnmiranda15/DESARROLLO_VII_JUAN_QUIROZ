<?php
// 1. Crear un arreglo de 10 nombres de ciudades
$ciudades = ["Nueva York", "Tokio", "Londres", "París", "Sídney", "Río de Janeiro", "Moscú", "Berlín", "Ciudad del Cabo", "Toronto"];

// 2. Imprimir el arreglo original
echo "Ciudades originales:\n";
print_r($ciudades);

// 3. Agregar 2 ciudades más al final del arreglo
array_push($ciudades, "Dubái", "Singapur");

// 4. Eliminar la tercera ciudad del arreglo
array_splice($ciudades, 2, 1);

// 5. Insertar una nueva ciudad en la quinta posición
array_splice($ciudades, 4, 0, "Mumbai");

// 6. Imprimir el arreglo modificado
echo "\nCiudades modificadas:\n";
print_r($ciudades);

// 7. Crear una función que imprima las ciudades en orden alfabético
function imprimirCiudadesOrdenadas($arr) {
    $ordenado = $arr;
    sort($ordenado);
    echo "Ciudades en orden alfabético:\n";
    foreach ($ordenado as $ciudad) {
        echo "- $ciudad\n";
    }
}

// 8. Llamar a la función
imprimirCiudadesOrdenadas($ciudades);

// TAREA: Función que cuenta ciudades que comienzan con una letra específica
function contarCiudadesPorInicial($ciudades, $letra) {
    $contador = 0;
    $letra = strtoupper($letra); // Convertir a mayúscula
    
    foreach ($ciudades as $ciudad) {
        $primeraLetra = strtoupper($ciudad[0]); // Primera letra en mayúscula
        if ($primeraLetra == $letra) {
            $contador++;
        }
    }
    
    return $contador;
}

// Ejemplos de uso
echo "\n=== PRUEBAS DE LA FUNCIÓN ===\n";
echo "Ciudades que comienzan con 'S': " . contarCiudadesPorInicial($ciudades, 'S') . "\n";
echo "Ciudades que comienzan con 'T': " . contarCiudadesPorInicial($ciudades, 'T') . "\n";
echo "Ciudades que comienzan con 'M': " . contarCiudadesPorInicial($ciudades, 'M') . "\n";
echo "Ciudades que comienzan con 'C': " . contarCiudadesPorInicial($ciudades, 'C') . "\n";
echo "Ciudades que comienzan con 'Z': " . contarCiudadesPorInicial($ciudades, 'Z') . "\n";

// Mostrar qué ciudades empiezan con cada letra
function mostrarCiudadesPorInicial($ciudades, $letra) {
    $letra = strtoupper($letra);
    $encontradas = [];
    
    foreach ($ciudades as $ciudad) {
        if (strtoupper($ciudad[0]) == $letra) {
            $encontradas[] = $ciudad;
        }
    }
    
    if (!empty($encontradas)) {
        echo "Ciudades que comienzan con '$letra': " . implode(", ", $encontradas) . "\n";
    } else {
        echo "No hay ciudades que comiencen con '$letra'\n";
    }
}

echo "\n=== DETALLE POR LETRA ===\n";
mostrarCiudadesPorInicial($ciudades, 'S');
mostrarCiudadesPorInicial($ciudades, 'T');
mostrarCiudadesPorInicial($ciudades, 'M');
?>