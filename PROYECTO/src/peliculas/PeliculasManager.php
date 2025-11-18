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

    /* // Crear una nueva película
    public function createMovie($data)
    {
        $sql = "INSERT INTO peliculas (titulo, tipo, genero, anio, duracion, clasificacion, sinopsis, stock)
                VALUES (:titulo, :tipo, :genero, :anio, :duracion, :clasificacion, :sinopsis, :stock)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titulo' => $data['titulo'] ?? '',
            ':tipo' => $data['tipo'] ?? '',
            ':genero' => $data['genero'] ?? '',
            ':anio' => $data['anio'] ?? null,
            ':duracion' => $data['duracion'] ?? null,
            ':clasificacion' => $data['clasificacion'] ?? '',
            ':sinopsis' => $data['sinopsis'] ?? '',
            ':stock' => $data['stock'] ?? 0
        ]);
    }
 */
    public function createMovie($pelicula)
    {
        // Validación mínima
        $tiposValidos = ['pelicula', 'serie'];
        if (!in_array($pelicula->tipo, $tiposValidos, true)) {
            $pelicula->tipo = 'pelicula';
        }

        $stmt = $this->db->prepare("
        INSERT INTO peliculas 
        (titulo, tipo, genero, anio, duracion, clasificacion, sinopsis, stock)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

        $payload = [
            $pelicula->titulo,
            $pelicula->tipo,
            $pelicula->genero,
            $pelicula->anio,
            $pelicula->duracion,
            $pelicula->clasificacion,
            $pelicula->sinopsis,
            $pelicula->stock
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