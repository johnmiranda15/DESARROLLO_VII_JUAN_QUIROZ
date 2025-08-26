<?php
// 1. Declarar variable
$calificacion = 85; // Cambia este valor entre 0 y 100

// 2. Determinar la letra con if-elseif-else
if ($calificacion >= 90 && $calificacion <= 100) {
    $letra = "A";
} elseif ($calificacion >= 80) {
    $letra = "B";
} elseif ($calificacion >= 70) {
    $letra = "C";
} elseif ($calificacion >= 60) {
    $letra = "D";
} else {
    $letra = "F";
}

// 3. Imprimir la letra
echo "Tu calificación es $letra. ";

// 4. Operador ternario (Aprobado/Reprobado)
echo ($letra == "F") ? "Reprobado<br>" : "Aprobado<br>";

// 5. Switch con mensaje adicional
switch ($letra) {
    case "A":
        echo "Excelente trabajo";
        break;
    case "B":
        echo "Buen trabajo";
        break;
    case "C":
        echo "Trabajo aceptable";
        break;
    case "D":
        echo "Necesitas mejorar";
        break;
    case "F":
        echo "Debes esforzarte más";
        break;
    default:
        echo "Letra no válida";
}
?>