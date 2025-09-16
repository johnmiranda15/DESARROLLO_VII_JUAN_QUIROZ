<?php
// Prestable.php - Interfaz
interface Prestable {
    public function prestar();
    public function devolver();
    public function estaDisponible();
    public function obtenerInformacion();
}

// Libro.php - Clase base
class Libro implements Prestable {
    private $titulo;
    private $autor;
    private $ano;
    private $disponible;
    
    public function __construct($titulo, $autor, $ano) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->disponible = true; // Por defecto está disponible
    }
    
    // Getter para el título (este método faltaba)
    public function getTitulo() {
        return $this->titulo;
    }
    
    // Métodos de la interfaz Prestable
    public function prestar() {
        if ($this->disponible) {
            $this->disponible = false;
            return true;
        }
        return false;
    }
    
    public function devolver() {
        if (!$this->disponible) {
            $this->disponible = true;
            return true;
        }
        return false;
    }
    
    public function estaDisponible() {
        return $this->disponible;
    }
    
    public function obtenerInformacion() {
        return "Título: {$this->titulo}, Autor: {$this->autor}, Año: {$this->ano}";
    }
}

// LibroDigital.php - Clase que hereda de Libro
class LibroDigital extends Libro {
    private $formato;
    private $tamano;
    
    public function __construct($titulo, $autor, $ano, $formato, $tamano) {
        parent::__construct($titulo, $autor, $ano);
        $this->formato = $formato;
        $this->tamano = $tamano;
    }
    
    // Sobrescribir el método para incluir información digital
    public function obtenerInformacion() {
        return parent::obtenerInformacion() . ", Formato: {$this->formato}, Tamaño: {$this->tamano}MB";
    }
}

// Biblioteca.php - Clase principal
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
                echo "Libro '$titulo' prestado exitosamente.\n";
                return true;
            }
        }
        echo "No se pudo prestar el libro '$titulo'.\n";
        return false;
    }
    
    public function devolverLibro($titulo) {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo && !$libro->estaDisponible()) {
                $libro->devolver();
                echo "Libro '$titulo' devuelto exitosamente.\n";
                return true;
            }
        }
        echo "No se pudo devolver el libro '$titulo'.\n";
        return false;
    }
}

// Ejemplo de uso completo
echo "=== SISTEMA DE BIBLIOTECA ===\n\n";

$biblioteca = new Biblioteca();

// Crear libros
$libro1 = new Libro("El principito", "Antoine de Saint-Exupéry", 1943);
$libro2 = new LibroDigital("Dune", "Frank Herbert", 1965, "EPUB", 3.2);
$libro3 = new Libro("Rayuela", "Julio Cortázar", 1963);
$libro4 = new LibroDigital("1984", "George Orwell", 1949, "PDF", 2.5);

// Agregar libros a la biblioteca
$biblioteca->agregarLibro($libro1);
$biblioteca->agregarLibro($libro2);
$biblioteca->agregarLibro($libro3);
$biblioteca->agregarLibro($libro4);

echo "Listado inicial de libros:\n";
$biblioteca->listarLibros();

echo "Prestando 'El principito'...\n";
$biblioteca->prestarLibro("El principito");
echo "\n";

echo "Prestando 'Rayuela'...\n";
$biblioteca->prestarLibro("Rayuela");
echo "\n";

echo "Listado después de prestar:\n";
$biblioteca->listarLibros();

echo "Devolviendo 'El principito'...\n";
$biblioteca->devolverLibro("El principito");
echo "\n";

echo "Listado final:\n";
$biblioteca->listarLibros();

echo "Intentando prestar un libro que no existe:\n";
$biblioteca->prestarLibro("Libro Inexistente");

?>