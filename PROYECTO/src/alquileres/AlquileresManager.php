<?php
// src/alquileres/AlquileresManager.php

class AlquileresManager
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Obtener todos los alquileres con información de cliente y película
    public function obtenerTodosLosAlquileres()
    {
        $stmt = $this->db->prepare("
            SELECT 
                a.*,
                c.nombre AS cliente_nombre,
                c.correo AS cliente_correo,
                p.titulo AS pelicula_titulo
            FROM alquiler a
            INNER JOIN cliente c ON a.id_cliente = c.id_cliente
            INNER JOIN peliculas p ON a.id_pelicula = p.id_pelicula
            ORDER BY a.id_alquiler DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener alquiler por ID
    public function getAlquiler($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM alquiler WHERE id_alquiler = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo alquiler
    public function crearAlquiler($data)
    {
        if (is_array($data)) {
            $data = (object) $data;
        }

        $id_cliente      = $data->id_cliente ?? null;
        $id_pelicula     = $data->id_pelicula ?? null;
        $fecha_alquiler  = $data->fecha_alquiler ?? date('Y-m-d');
        $fecha_devolucion = $data->fecha_devolucion ?? null;
        $estado          = $data->estado ?? 'alquilado';

        $stmt = $this->db->prepare("
            INSERT INTO alquiler 
            (id_cliente, id_pelicula, fecha_alquiler, fecha_devolucion, estado)
            VALUES (?, ?, ?, ?, ?)
        ");

        $payload = [
            $id_cliente,
            $id_pelicula,
            $fecha_alquiler,
            $fecha_devolucion,
            $estado
        ];

        try {
            $stmt->execute($payload);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error al crear alquiler: " . $e->getMessage());
            return false;
        }
    }

    // Actualizar alquiler existente
    public function actualizarAlquiler($id, $data)
    {
        if (is_array($data)) {
            $data = (object) $data;
        }

        $id_cliente       = $data->id_cliente ?? null;
        $id_pelicula      = $data->id_pelicula ?? null;
        $fecha_alquiler   = $data->fecha_alquiler ?? null;
        $fecha_devolucion = $data->fecha_devolucion ?? null;
        $estado           = $data->estado ?? 'alquilado';

        $stmt = $this->db->prepare("
            UPDATE alquiler 
            SET id_cliente = ?, id_pelicula = ?, fecha_alquiler = ?, fecha_devolucion = ?, estado = ?
            WHERE id_alquiler = ?
        ");

        $payload = [
            $id_cliente,
            $id_pelicula,
            $fecha_alquiler,
            $fecha_devolucion,
            $estado,
            $id
        ];

        try {
            $stmt->execute($payload);
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar alquiler: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar alquiler
    public function eliminarAlquiler($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM alquiler WHERE id_alquiler = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al eliminar alquiler: " . $e->getMessage());
            return false;
        }
    }

    // Obtener todos los clientes (para el select del formulario)
    public function obtenerClientes()
    {
        $stmt = $this->db->prepare("SELECT id_cliente, nombre, correo FROM cliente ORDER BY nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todas las películas (para el select del formulario)
    public function obtenerPeliculas()
    {
        $stmt = $this->db->prepare("SELECT id_pelicula, titulo FROM peliculas ORDER BY titulo ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}