<?php
class Pelicula {
    public $id_pelicula;
    public $titulo;
    public $tipo;
    public $genero;
    public $anio;
    public $duracion;
    public $clasificacion;
    public $sinopsis;
    public $stock;
    public $created_at;
    public $updated_at;

    // Constructor para crear un objeto Pelicula desde un array de datos
    public function __construct($data = []) {
        $this->id_pelicula   = $data['id_pelicula']   ?? null;
        $this->titulo        = $data['titulo']        ?? null;
        $this->tipo          = $data['tipo']          ?? null;
        $this->genero        = $data['genero']        ?? null;
        $this->anio          = $data['anio']          ?? null;
        $this->duracion      = $data['duracion']      ?? null;
        $this->clasificacion = $data['clasificacion'] ?? null;
        $this->sinopsis      = $data['sinopsis']      ?? null;
        $this->stock         = $data['stock']         ?? null;
        $this->created_at    = $data['created_at']    ?? null;
        $this->updated_at    = $data['updated_at']    ?? null;
    }

    // Método opcional para mostrar la información resumida de la película
    public function resumen() {
        return "{$this->titulo} ({$this->anio}) - {$this->genero}";
    }
}
