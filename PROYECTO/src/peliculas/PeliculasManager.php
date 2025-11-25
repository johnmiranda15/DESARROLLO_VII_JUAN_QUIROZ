<?php
class PeliculasManager
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllMovies()
    {
        $stmt = $this->db->query("SELECT * FROM peliculas ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una película por ID
    public function getMovieById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM peliculas WHERE id_pelicula = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMovie($pelicula)
    {
        // Aceptar array o objeto; convertir array a objeto para usar ->prop
        if (is_array($pelicula)) {
            $pelicula = (object) $pelicula;
        }

        // Validación mínima y valores por defecto
        $tiposValidos = ['pelicula', 'serie'];
        $tipo = (isset($pelicula->tipo) && in_array($pelicula->tipo, $tiposValidos, true))
            ? $pelicula->tipo
            : 'pelicula';

        $titulo = $pelicula->titulo ?? '';
        $genero = $pelicula->genero ?? '';
        $anio = $pelicula->anio ?? null;
        $duracion = $pelicula->duracion ?? null;
        $clasificacion = $pelicula->clasificacion ?? '';
        $sinopsis = $pelicula->sinopsis ?? '';
        $stock = $pelicula->stock ?? 0;

        $stmt = $this->db->prepare("
            INSERT INTO peliculas 
            (titulo, tipo, genero, anio, duracion, clasificacion, sinopsis, stock)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $payload = [
            $titulo,
            $tipo,
            $genero,
            $anio,
            $duracion,
            $clasificacion,
            $sinopsis,
            $stock
        ];

        try {
            $stmt->execute($payload);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Actualizar una película existente
    public function updateMovie($id, $data)
    {
        $sql = "UPDATE peliculas
                SET titulo = :titulo, tipo = :tipo, genero = :genero, anio = :anio,
                    duracion = :duracion, clasificacion = :clasificacion,
                    sinopsis = :sinopsis, stock = :stock
                WHERE id_pelicula = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titulo' => $data['titulo'] ?? '',
            ':tipo' => $data['tipo'] ?? '',
            ':genero' => $data['genero'] ?? '',
            ':anio' => $data['anio'] ?? null,
            ':duracion' => $data['duracion'] ?? null,
            ':clasificacion' => $data['clasificacion'] ?? '',
            ':sinopsis' => $data['sinopsis'] ?? '',
            ':stock' => $data['stock'] ?? 0,
            ':id' => $id
        ]);
    }

    // Eliminar una película
    public function deleteMovie($id)
    {
        $stmt = $this->db->prepare("DELETE FROM peliculas WHERE id_pelicula = ?");
        return $stmt->execute([$id]);
    }
}