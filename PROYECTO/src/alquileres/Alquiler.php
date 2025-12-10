<?php
// src/alquileres/Alquiler.php

class Alquiler {
    public $id_alquiler;
    public $id_cliente;
    public $id_pelicula;
    public $fecha_alquiler;
    public $fecha_devolucion;
    public $estado;
    public $created_at;
    public $updated_at;

    // Constructor para crear un objeto Alquiler desde un array de datos
    public function __construct($data = []) {
        $this->id_alquiler      = $data['id_alquiler'] ?? null;
        $this->id_cliente       = $data['id_cliente'] ?? null;
        $this->id_pelicula      = $data['id_pelicula'] ?? null;
        $this->fecha_alquiler   = $data['fecha_alquiler'] ?? null;
        $this->fecha_devolucion = $data['fecha_devolucion'] ?? null;
        $this->estado           = $data['estado'] ?? 'alquilado';
        $this->created_at       = $data['created_at'] ?? null;
        $this->updated_at       = $data['updated_at'] ?? null;
    }

    // Método opcional para mostrar la información resumida del alquiler
    public function resumen() {
        return "Alquiler #{$this->id_alquiler} - Estado: {$this->estado}";
    }
}