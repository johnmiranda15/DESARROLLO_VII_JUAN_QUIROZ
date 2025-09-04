<?php
// 1. Modifica textos y subcadenas buscadas
$texto = "¡Bienvenido a la programación en PHP!";
$posicion = strpos($texto, "programación");
echo "La palabra 'programación' comienza en la posición: $posicion</br>";

$busqueda = strpos($texto, "Java");
if ($busqueda === false) {
    echo "La palabra 'Java' no se encontró en el texto.</br>";
}

// 2. Función para verificar si una frase contiene una palabra prohibida (case-insensitive)
function contienePalabraProhibida($frase, $palabra) {
    return stripos($frase, $palabra) !== false;
}
$frasePrueba = "Este sitio es solo para mayores de edad.";
echo "</br>¿La frase contiene 'mayores'? " . (contienePalabraProhibida($frasePrueba, "mayores") ? "Sí" : "No") . "</br>";

// 3. Función para censurar solo palabras completas (case-insensitive)
function censurarPalabrasCompletas($texto, $palabrasCensuradas) {
    foreach ($palabrasCensuradas as $palabra) {
        $texto = preg_replace('/\b' . preg_quote($palabra, '/') . '\b/i', str_repeat("*", strlen($palabra)), $texto);
    }
    return $texto;
}
$textoOriginal = "Palabras como texto y palabras sueltas deben ser censuradas.";
$palabrasCensuradas = ["texto", "palabras", "censuradas"];
$textoCensurado = censurarPalabrasCompletas($textoOriginal, $palabrasCensuradas);
echo "</br>Texto original: $textoOriginal</br>";
echo "Texto censurado (solo palabras completas, case-insensitive): $textoCensurado</br>";

// 4. Ejemplo usando strpos() con otras funciones: extraer dominio de una URL
function extraerDominioUrl($url) {
    $inicio = strpos($url, "://");
    if ($inicio === false) return false;
    $inicio += 3;
    $fin = strpos($url, "/", $inicio);
    if ($fin === false) {
        return substr($url, $inicio);
    }
    return substr($url, $inicio, $fin - $inicio);
}
$url = "https://www.ejemplo.com/pagina";
echo "</br>Dominio extraído de '$url': " . extraerDominioUrl($url) . "</br>";
?>