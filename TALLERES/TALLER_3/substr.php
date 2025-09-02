<?php
// Ejemplo básico de substr()
$texto = "Hola Mundo";
$extracto1 = substr($texto, 0, 4);  // Extrae desde la posición 0, 4 caracteres
$extracto2 = substr($texto, 5);     // Extrae desde la posición 5 hasta el final

echo "Texto original: $texto</br>";
echo "Extracto 1: $extracto1</br>";
echo "Extracto 2: $extracto2</br>";

// Ejemplo con índices negativos
$palabra = "Programación";
$ultimasPalabras = substr($palabra, -4);  // Extrae los últimos 4 caracteres
echo "</br>Palabra original: $palabra</br>";
echo "Últimas letras: $ultimasPalabras</br>";

// Ejercicio: Extrae el nombre y apellido de una cadena
$nombreCompleto = "Juan Pérez Rodríguez";
$nombre = substr($nombreCompleto, 0, strpos($nombreCompleto, " "));
$apellido = substr($nombreCompleto, strrpos($nombreCompleto, " ") + 1);
echo "</br>Nombre completo: $nombreCompleto</br>";
echo "Nombre: $nombre</br>";
echo "Apellido: $apellido</br>";

// Bonus: Ocultar parte de un número de tarjeta de crédito
function ocultarTarjeta($numeroTarjeta, $digitosVisibles = 4) {
    $longitud = strlen($numeroTarjeta);
    $oculto = str_repeat("*", max(0, $longitud - $digitosVisibles));
    return $oculto . substr($numeroTarjeta, -$digitosVisibles);
}

$tarjeta = "1234567890123456";
echo "</br>Número de tarjeta original: $tarjeta</br>";
echo "Número de tarjeta oculto: " . ocultarTarjeta($tarjeta) . "</br>";

// Extra: Extraer dominio de una dirección de correo electrónico
function extraerDominio($email) {
    return substr($email, strpos($email, "@") + 1);
}

$correo = "usuario@example.com";
echo "</br>Correo electrónico: $correo</br>";
echo "Dominio: " . extraerDominio($correo) . "</br>";

// Desafío: Crear una función que extraiga el texto entre dos delimitadores
function extraerEntre($texto, $inicio, $fin) {
    $inicioPos = strpos($texto, $inicio);
    if ($inicioPos === false) return "";
    
    $inicioPos += strlen($inicio);
    $finPos = strpos($texto, $fin, $inicioPos);
    if ($finPos === false) return "";
    
    return substr($texto, $inicioPos, $finPos - $inicioPos);
}

$textoHTML = "<h1>Título Principal</h1>";
echo "</br>Texto HTML: $textoHTML</br>";
echo "Contenido extraído: " . extraerEntre($textoHTML, "<h1>", "</h1>") . "</br>";

// 1. Experimenta con diferentes cadenas y posiciones en substr()
$cadena1 = "Aprendiendo PHP";
echo "</br>Primeros 5 caracteres: " . substr($cadena1, 0, 5) . "</br>"; // "Apren"
echo "Desde el carácter 6: " . substr($cadena1, 6) . "</br>"; // "iendo PHP"
echo "Últimos 3 caracteres: " . substr($cadena1, -3) . "</br>"; // "PHP"

// 2. Modifica la función ocultarTarjeta() para mostrar un número diferente de dígitos
$tarjeta2 = "9876543210987654";
echo "</br>Número de tarjeta (6 visibles): " . ocultarTarjeta($tarjeta2, 6) . "</br>";
echo "Número de tarjeta (2 visibles): " . ocultarTarjeta($tarjeta2, 2) . "</br>";

// 3. Prueba la función extraerDominio() con diferentes direcciones de correo electrónico
$correos = [
    "ana@gmail.com",
    "pedro.lopez@universidad.edu",
    "soporte@empresa.org"
];
foreach ($correos as $c) {
    echo "</br>Correo: $c - Dominio: " . extraerDominio($c);
}

// 4. Usa la función extraerEntre() con diferentes delimitadores y textos
$texto1 = "[importante]Mensaje privado[/importante]";
echo "</br>Entre [importante] y [/importante]: " . extraerEntre($texto1, "[importante]", "[/importante]") . "</br>";

$texto2 = "Inicio <dato>12345</dato> Fin";
echo "Entre <dato> y </dato>: " . extraerEntre($texto2, "<dato>", "</dato>") . "</br>";

$texto3 = "Sin delimitadores aquí";
echo "Entre <a> y </a>: '" . extraerEntre($texto3, "<a>", "</a>") . "'</br>";
?>