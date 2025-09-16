<?php
require_once 'Libro.php';

class LibroDigital extends Libro {
    private $formato, $tamano;
    
    public function __construct($titulo, $autor, $ano, $formato, $tamano) {
        parent::__construct($titulo, $autor, $ano);
        $this->formato = $formato;
        $this->tamano = $tamano;
    }
    
    public function obtenerInformacion() {
        return parent::obtenerInformacion() . ", Formato: {$this->formato}, Tamaño: {$this->tamano}MB";
    }
}

class Biblioteca {
    private $libros = [];

    public function agregarLibro(Prestable $libro) {
        $this->libros[] = $libro;
    }

    public function listarLibros() {
        foreach ($this->libros as $libro) {
            echo $libro->obtenerInformacion() . "\n";
            echo "Disponible: " . ($libro->estaDisponible() ? "Sí" : "No") . "\n\n";
        }
    }

    public function prestarLibro($titulo) {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo && $libro->estaDisponible()) {
                $libro->prestar();
                return true;
            }
        }
        return false;
    }

    public function devolverLibro($titulo) {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo && !$libro->estaDisponible()) {
                $libro->devolver();
                return true;
            }
        }
        return false;
    }
}

// Ejemplo de uso
$biblioteca = new Biblioteca();

$libro1 = new Libro("El principito", "Antoine de Saint-Exupéry", 1943);
$libro2 = new LibroDigital("Dune", "Frank Herbert", 1965, "EPUB", 3.2);

$biblioteca->agregarLibro($libro1);
$biblioteca->agregarLibro($libro2);

echo "Listado inicial de libros:\n";
$biblioteca->listarLibros();

echo "Prestando 'El principito'...\n";
$biblioteca->prestarLibro("El principito");

echo "Listado después de prestar:\n";
$biblioteca->listarLibros();

echo "Devolviendo 'El principito'...\n";
$biblioteca->devolverLibro("El principito");

echo "Listado final:\n";
$biblioteca->listarLibros();
?>