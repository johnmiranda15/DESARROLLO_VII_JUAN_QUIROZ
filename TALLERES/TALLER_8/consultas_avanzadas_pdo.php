<?php
require_once "config_pdo.php";

try {
    $sql = "SELECT u.id, u.nombre, COUNT(p.id) AS num_publicaciones
            FROM usuarios u
            LEFT JOIN publicaciones p ON u.id = p.usuario_id
            GROUP BY u.id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Usuarios y número de publicaciones:</h3>";
    if ($usuarios) {
        foreach ($usuarios as $row) {
            echo "Usuario: " . htmlspecialchars($row['nombre']) .
                 " — Publicaciones: " . (int)$row['num_publicaciones'] . "<br>";
        }
    } else {
        echo "No se encontraron usuarios.<br>";
    }

    $sql = "SELECT p.titulo, u.nombre AS autor, p.fecha_publicacion
            FROM publicaciones p
            INNER JOIN usuarios u ON p.usuario_id = u.id
            ORDER BY p.fecha_publicacion DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $publicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Publicaciones con nombre del autor:</h3>";
    if ($publicaciones) {
        foreach ($publicaciones as $row) {
            echo "Título: " . htmlspecialchars($row['titulo']) .
                 " — Autor: " . htmlspecialchars($row['autor']) .
                 " — Fecha: " . $row['fecha_publicacion'] . "<br>";
        }
    } else {
        echo "No hay publicaciones registradas.<br>";
    }

    $sql = "SELECT u.nombre, COUNT(p.id) AS num_publicaciones
            FROM usuarios u
            LEFT JOIN publicaciones p ON u.id = p.usuario_id
            GROUP BY u.id
            ORDER BY num_publicaciones DESC
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $usuario_top = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h3>Usuario con más publicaciones:</h3>";
    if ($usuario_top && $usuario_top['num_publicaciones'] > 0) {
        echo "Nombre: " . htmlspecialchars($usuario_top['nombre']) .
             " — Publicaciones: " . (int)$usuario_top['num_publicaciones'];
    } else {
        echo "No hay usuarios con publicaciones registradas.";
    }

} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
} finally {
    $pdo = null;
}
?>