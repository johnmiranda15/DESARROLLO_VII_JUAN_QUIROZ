<?php
// Ejemplo de uso de json_encode() con un array simple
$frutas = ["zandia", "pitaya", "pera"];
$jsonFrutas = json_encode($frutas);
echo "Array de frutas en JSON:</br>$jsonFrutas</br>";

// Ejemplo con un array asociativo
$persona = [
    "nombre" => "Juan",
    "edad" => 29,
    "ciudad" => "Panamá"
];
$jsonPersona = json_encode($persona, JSON_UNESCAPED_UNICODE);
echo "</br>Array asociativo de persona en JSON (sin escape unicode):</br>$jsonPersona</br>";

// Ejercicio: Crea un array con información sobre tu película favorita
// (título, director, año, actores principales) y conviértelo a JSON
$peliculaFavorita = [
    "titulo" => "Transformers",
    "director" => "Michael Bay",
    "año" => 2007,
    "actores" => ["Shia LaBeouf", "Megan Fox", "Josh Duhamel"]
];
$jsonPelicula = json_encode($peliculaFavorita, JSON_UNESCAPED_UNICODE);
echo "</br>Información de tu película favorita en JSON (sin escape unicode):</br>$jsonPelicula</br>";

// Bonus: Usa json_encode() con un objeto de clase personalizada
class Libro {
    public $titulo;
    public $autor;
    public $año;
    
    public function __construct($titulo, $autor, $año) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->año = $año;
    }
}

$miLibro = new Libro("Movidick", "Herman Melville", 1851);
$jsonLibro = json_encode($miLibro, JSON_UNESCAPED_UNICODE);
echo "</br>Objeto Libro en JSON:</br>$jsonLibro</br>";

// Extra: Uso de opciones en json_encode()
$datosConCaracteresEspeciales = [
    "nombre" => "María José",
    "descripción" => "Le gusta el café y el té"
];
$jsonConOpciones = json_encode($datosConCaracteresEspeciales, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
echo "</br>JSON con opciones (caracteres Unicode y formato bonito):</br>$jsonConOpciones</br>";
?>