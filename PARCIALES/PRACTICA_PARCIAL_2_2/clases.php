<?php

// 1. Interfaz Prestable
interface Prestable {
    public function obtenerDetallesPrestamo(): string;
}

abstract class RecursoBiblioteca implements Prestable {
    public $id;
    public $titulo;
    public $autor;
    public $anioPublicacion;
    public $estado;
    public $fechaAdquisicion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

// Implementar las clases Libro, Revista y DVD aquí
// 3. Clases hijas
class Libro extends RecursoBiblioteca {
    public $isbn;
    public $editorial;
    public $numPaginas;

    public function __construct($id, $titulo, $autor, $anio, $isbn = '', $editorial = '', $numPaginas = 0) {
        parent::__construct($id, $titulo, $autor, $anio);
        $this->isbn = $isbn;
        $this->editorial = $editorial;
        $this->numPaginas = $numPaginas;
    }

    public function obtenerDetallesPrestamo(): string {
        $estado = $this->estaDisponible() ? "Disponible" : "Prestado";
        return "LIBRO - {$this->titulo} | ISBN: {$this->isbn} | Páginas: {$this->numPaginas} | Estado: {$estado} | Plazo: 15 días";
    }

    public function obtenerInformacion() {
        $info = parent::obtenerInformacion();
        $info['isbn'] = $this->isbn;
        $info['editorial'] = $this->editorial;
        $info['numPaginas'] = $this->numPaginas;
        return $info;
    }
}

class GestorBiblioteca {
    private $recursos = [];

    public function cargarRecursos() {
        $json = file_get_contents('biblioteca.json');
        $data = json_decode($json, true);
        
        foreach ($data as $recursoData) {
            $recurso = new RecursoBiblioteca($recursoData);
            $this->recursos[] = $recurso;
        }
        
        return $this->recursos;
    }

    // Implementar los demás métodos aquí
}