<?php
// src/clientes/ClientesManager.php

class ClientesManager
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Obtener todos los clientes
    public function obtenerTodosLosClientes()
    {
        $stmt = $this->db->prepare("SELECT * FROM cliente ORDER BY id_cliente DESC"); // Tabla 'cliente'
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener cliente por ID
    public function obtenerCliente($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cliente WHERE id_cliente = ?"); // Tabla 'cliente'
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo cliente
    public function crearCliente($data)
    {
        if (is_array($data)) {
            $data = (object) $data;
        }

        $nombre = $data->nombre ?? '';
        $correo = $data->correo ?? '';
        $telefono = $data->telefono ?? null;
        $direccion = $data->direccion ?? null;
        $fecha_registro = $data->fecha_registro ?? date('Y-m-d');

        $stmt = $this->db->prepare("
            INSERT INTO cliente
            (nombre, correo, telefono, direccion, fecha_registro)
            VALUES (?, ?, ?, ?, ?)
        ");

        $payload = [
            $nombre,
            $correo,
            $telefono,
            $direccion,
            $fecha_registro
        ];

        try {
            $stmt->execute($payload);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error al crear cliente: " . $e->getMessage());
            // Para depuración temporal, puedes usar: die("Error al crear cliente: " . $e->getMessage());
            return false;
        }
    }

    // Actualizar cliente existente
    public function actualizarCliente($id, $data)
    {
        if (is_array($data)) {
            $data = (object) $data;
        }

        $nombre = $data->nombre ?? '';
        $correo = $data->correo ?? '';
        $telefono = $data->telefono ?? null;
        $direccion = $data->direccion ?? null;

        $stmt = $this->db->prepare("
            UPDATE cliente
            SET nombre = ?, correo = ?, telefono = ?, direccion = ?
            WHERE id_cliente = ?
        ");

        $payload = [
            $nombre,
            $correo,
            $telefono,
            $direccion,
            $id
        ];

        try {
            $stmt->execute($payload);
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar cliente: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar cliente
    public function eliminarCliente($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM cliente WHERE id_cliente = ?"); // Tabla 'cliente'
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al eliminar cliente: " . $e->getMessage());
            return false;
        }
    }
}