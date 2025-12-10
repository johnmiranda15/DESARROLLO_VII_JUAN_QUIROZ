<?php
// src/clientes/Cliente.php

class Cliente {
    public $id_cliente;
    public $nombre;
    public $correo;
    public $telefono;
    public $direccion;
    public $fecha_registro;
    public $created_at;
    public $updated_at;

    // Constructor para crear un objeto Cliente desde un array de datos
    public function __construct($data = []) {
        $this->id_cliente  = $data['id_cliente'] ?? null; // Añadido null para evitar error si no viene
        $this->nombre      = $data['nombre'] ?? null;
        $this->correo       = $data['correo'] ?? null; // Usar 'correo'
        $this->telefono    = $data['telefono'] ?? null;
        $this->direccion   = $data['direccion'] ?? null;
        $this->fecha_registro = $data['fecha_registro'] ?? null;
        $this->created_at  = $data['created_at'] ?? null;
        $this->updated_at  = $data['updated_at'] ?? null;
    }

    // Método opcional para mostrar la información resumida del cliente
    public function resumen() {
        return "{$this->nombre} - {$this->correo}"; // Ajustado sin apellido
    }
}