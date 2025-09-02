<?php
// Ejemplo de uso de date()
echo "Fecha actual: " . date("Y-m-d") . "</br>";
echo "Hora actual: " . date("H:i:s") . "</br>";
echo "Fecha y hora actuales: " . date("Y-m-d H:i:s") . "</br>";

// Ejercicio: Usa date() para mostrar la fecha actual en el formato "Día de la semana, día de mes de año"
// Por ejemplo: "Lunes, 15 de agosto de 2023"
$fechaFormateada = date("l, j \de F \de Y");
echo "Fecha formateada: $fechaFormateada</br>";

// Bonus: Crea una función que devuelva la diferencia en días entre dos fechas
function diasEntre($fecha1, $fecha2) {
    $timestamp1 = strtotime($fecha1);
    $timestamp2 = strtotime($fecha2);
    $diferencia = abs($timestamp2 - $timestamp1);
    return floor($diferencia / (60 * 60 * 24));
}

$fechaInicio = "2023-01-01";
$fechaFin = date("Y-m-d"); // Fecha actual
$diasTranscurridos = diasEntre($fechaInicio, $fechaFin);

echo "</br>Días transcurridos desde el $fechaInicio hasta hoy: $diasTranscurridos días</br>";

// Extra: Mostrar zona horaria actual
echo "</br>Zona horaria actual: " . date_default_timezone_get() . "</br>";

// Cambiar zona horaria y mostrar la hora
date_default_timezone_set("America/New_York");
echo "Hora en New York: " . date("H:i:s") . "</br>";

// Diferentes formatos de fecha
echo "Formato corto: " . date("d/m/Y") . "</br>";
echo "Formato con texto: " . date("D, d M Y") . "</br>";
echo "Formato ISO 8601: " . date("c") . "</br>";
echo "Formato RFC 2822: " . date("r") . "</br>";

// Modifica la función diasEntre() para probar otras fechas
$fechaA = "2024-09-01";
$fechaB = "2025-01-01";
$diasAB = diasEntre($fechaA, $fechaB);
echo "</br>Días entre $fechaA y $fechaB: $diasAB días</br>";

// Prueba con fechas invertidas
$diasBA = diasEntre($fechaB, $fechaA);
echo "Días entre $fechaB y $fechaA: $diasBA días</br>";

// Cambia la zona horaria a diferentes regiones
date_default_timezone_set("Europe/Madrid");
echo "Hora en Madrid: " . date("H:i:s") . "</br>";

date_default_timezone_set("Asia/Tokyo");
echo "Hora en Tokio: " . date("H:i:s") . "</br>";

date_default_timezone_set("America/Mexico_City");
echo "Hora en Ciudad de México: " . date("H:i:s") . "</br>";
?>