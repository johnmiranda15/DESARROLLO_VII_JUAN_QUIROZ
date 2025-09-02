<?php
// Ejemplo básico de strtoupper()
$textoMixto = "HoLa MuNdO";
$textoMayusculas = strtoupper($textoMixto);
echo "Texto original: $textoMixto</br>";
echo "Texto en mayúsculas: $textoMayusculas</br>";

// Ejemplo con una frase
$frase = "php es un lenguaje de programación";
$fraseMayusculas = strtoupper($frase);
echo "</br>Frase original: $frase</br>";
echo "Frase en mayúsculas: $fraseMayusculas</br>";

// Ejercicio: Convierte el nombre de tu ciudad y país a mayúsculas
$ciudad = "Panamá";
$pais = "Panamá";
$ciudadMayusculas = strtoupper($ciudad);
$paisMayusculas = strtoupper($pais);
echo "</br>Tu ciudad en mayúsculas: $ciudadMayusculas</br>";
echo "Tu país en mayúsculas: $paisMayusculas</br>";

// Bonus: Crear un encabezado para un documento
function crearEncabezado($texto) {
    return str_pad(strtoupper($texto), strlen($texto) + 4, "*", STR_PAD_BOTH);
}

$tituloDocumento = "Informe importante";
echo "</br>" . crearEncabezado($tituloDocumento) . "</br>";
echo crearEncabezado("Resumen") . "</br>";
echo crearEncabezado("Notas finales") . "</br>";

// Extra: Convertir un array de strings a mayúsculas
$frutas = ["manzana", "banana", "cereza", "dátil"];
$frutasMayusculas = array_map('strtoupper', $frutas);
echo "</br>Frutas originales:</br>";
print_r($frutas);
echo "Frutas en mayúsculas:</br>";
print_r($frutasMayusculas);

// Desafío: Crea una función que convierta a mayúsculas solo la primera letra de cada palabra
function primerLetraMayuscula($frase) {
    // Convierte todo a minúsculas primero
    $frase = strtolower($frase);
    // Usa preg_replace_callback para mayúsculas después de espacio, guión o apóstrofe
    return preg_replace_callback(
        '/(?:^|[\s\'-])\p{Ll}/u',
        function ($coincidencia) {
            return mb_strtoupper($coincidencia[0], 'UTF-8');
        },
        $frase
    );
}

// Pruebas:
$frase1 = "juan-pablo o'connor";
$frase2 = "el gran-murciélago d'angelo";
echo "</br>Frase original: $frase1</br>";
echo "Frase modificada: " . primerLetraMayuscula($frase1) . "</br>";
echo "</br>Frase original: $frase2</br>";
echo "Frase modificada: " . primerLetraMayuscula($frase2) . "</br>";
?>