<?php
// Define las siguientes variables:
$nombre_completo = "Juan Pérez";
$edad = 25;
$correo = "juan.perez@example.com";
$telefono = "123-456-7890";

//define una constante ocupacion
define("OCUPACION", "Estudiante");

// Con echo
echo "<p>Este párrafo fue generado con <b>echo</b>.</p>";

// Con print
print "<p>Este párrafo fue generado con <b>print</b>.</p>";

// Con printf (permite formato)
$nombre = "Carlos";
$edad   = 30;
printf("<p>Hola, me llamo <b>%s</b> y tengo <b>%d</b> años.</p>", $nombre, $edad);

var_dump($nombre_completo);
var_dump($edad);
var_dump($correo);
var_dump($telefono);
var_dump(OCUPACION);

?>