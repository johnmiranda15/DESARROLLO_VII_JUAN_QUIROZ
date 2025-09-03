<?php
// Ejemplo 1: Código postal
$texto = "El código postal es 12345";
$patron = "/\d{5}/";
if (preg_match($patron, $texto, $coincidencias)) {
    echo "Código postal encontrado: {$coincidencias[0]}<br>";
} else {
    echo "No se encontró un código postal válido.<br>";
}

// Ejemplo 2: Validación de email
function validarEmail($email) {
    $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($patron, $email);
}

$email1 = "usuario@example.com";
$email2 = "usuario@.com";
echo "¿'{$email1}' es un email válido? " . (validarEmail($email1) ? "Sí" : "No") . "<br>";
echo "¿'{$email2}' es un email válido? " . (validarEmail($email2) ? "Sí" : "No") . "<br>";

// Ejemplo 3: Extraer usuario de Twitter
function extraerUsuarioTwitter($tweet) {
    $patron = "/@([a-zA-Z0-9_]+)/";
    if (preg_match($patron, $tweet, $coincidencias)) {
        return $coincidencias[1];
    }
    return null;
}

$tweet = "Sígueme en @usuario_ejemplo para más contenido!";
$usuario = extraerUsuarioTwitter($tweet);
echo "<br>Usuario de Twitter extraído: " . ($usuario ? "@$usuario" : "No se encontró usuario") . "<br>";

// Ejemplo 4: Extraer información estructurada
$info = "Nombre: Juan, Edad: 29, Ciudad: Panama";
$patron = "/Nombre: ([^,]+), Edad: (\d+), Ciudad: ([^,]+)/";
if (preg_match($patron, $info, $coincidencias)) {
    echo "<br>Información extraída:<br>";
    echo "Nombre: {$coincidencias[1]}<br>";
    echo "Edad: {$coincidencias[2]}<br>";
    echo "Ciudad: {$coincidencias[3]}<br>";
}

// Ejemplo 5: Validación de teléfono
function validarTelefono($telefono) {
    $patron = "/^(\+\d{1,3}[- ]?)?\d{9,10}$/";
    return preg_match($patron, $telefono);
}

$telefono1 = "+34 123456789";
$telefono2 = "123-456-7890";
echo "<br>¿'{$telefono1}' es un teléfono válido? " . (validarTelefono($telefono1) ? "Sí" : "No") . "<br>";
echo "¿'{$telefono2}' es un teléfono válido? " . (validarTelefono($telefono2) ? "Sí" : "No") . "<br>";

// Ejemplo 6: Extraer etiquetas HTML (solo nombres)
function extraerEtiquetasHTML($html) {
    $patron = "/<(\w+)\s*[^>]*>/";
    preg_match_all($patron, $html, $coincidencias);
    return $coincidencias[1];
}

$html = "Este es un <a href='#'>enlace</a> en un <p>párrafo</p>.";
$etiquetas = extraerEtiquetasHTML($html);
echo "<br>Etiquetas HTML encontradas: " . implode(", ", $etiquetas) . "<br>";

// NUEVO Ejemplo 7: Validar cédula Panamá
function validarCedula($cedula) {
    $patron = "/^\d{1,4}-\d{1,4}-\d{1,6}$/";
    return preg_match($patron, $cedula);
}

$cedula = "4-779-2285";
echo "<br>¿'$cedula' es una cédula válida? " . (validarCedula($cedula) ? "Sí" : "No") . "<br>";

// NUEVO Ejemplo 8: Validar código postal Panamá
function validarCodigoPostal($codigo) {
    $patron = "/^\d{4,6}$/";
    return preg_match($patron, $codigo);
}

$codigo = "0801";
echo "¿'$codigo' es un código postal válido? " . (validarCodigoPostal($codigo) ? "Sí" : "No") . "<br>";

// NUEVO Ejemplo 9: Extraer fechas en texto
function extraerFechas($texto) {
    $patron = "/\b\d{2}\/\d{2}\/\d{4}\b/";
    preg_match_all($patron, $texto, $coincidencias);
    return $coincidencias[0];
}

$textoFechas = "Las reuniones serán el 01/09/2025 y el 15/09/2025.";
$fechas = extraerFechas($textoFechas);
echo "<br>Fechas encontradas: " . implode(", ", $fechas) . "<br>";

// NUEVO Ejemplo 10: Extraer etiquetas HTML con atributos
function extraerEtiquetasConAtributos($html) {
    $patron = "/<(\w+)([^>]*)>/";
    preg_match_all($patron, $html, $coincidencias, PREG_SET_ORDER);
    $resultado = [];
    foreach ($coincidencias as $etiqueta) {
        $resultado[] = "Etiqueta: {$etiqueta[1]} | Atributos: " . trim($etiqueta[2]);
    }
    return $resultado;
}

$htmlAvanzado = "<a href='#' class='btn'>Enlace</a><p id='parrafo'>Texto</p>";
$etiquetasAtributos = extraerEtiquetasConAtributos($htmlAvanzado);
echo "<br>Etiquetas con atributos:<br>";
foreach ($etiquetasAtributos as $e) {
    echo $e . "<br>";
}
?>