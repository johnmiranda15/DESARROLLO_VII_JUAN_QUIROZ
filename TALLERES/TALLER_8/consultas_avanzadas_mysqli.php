<?php
require_once "config_mysqli.php";

$sql = "SELECT u.id, u.nombre, COUNT(p.id) AS num_publicaciones
        FROM usuarios u
        LEFT JOIN publicaciones p ON u.id = p.usuario_id
        GROUP BY u.id";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo "<h3>Usuarios y número de publicaciones:</h3>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Usuario: " . htmlspecialchars($row['nombre']) .
                 ", Publicaciones: " . $row['num_publicaciones'] . "<br>";
        }
    } else {
        echo "No se encontraron usuarios o publicaciones.<br>";
    }

    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conn);
}

$sql = "SELECT p.titulo, u.nombre AS autor, p.fecha_publicacion
        FROM publicaciones p
        INNER JOIN usuarios u ON p.usuario_id = u.id
        ORDER BY p.fecha_publicacion DESC";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo "<h3>Publicaciones con nombre del autor:</h3>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Título: " . htmlspecialchars($row['titulo']) .
                 ", Autor: " . htmlspecialchars($row['autor']) .
                 ", Fecha: " . $row['fecha_publicacion'] . "<br>";
        }
    } else {
        echo "No hay publicaciones registradas.<br>";
    }

    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conn);
}

$sql = "SELECT u.nombre, COUNT(p.id) AS num_publicaciones
        FROM usuarios u
        LEFT JOIN publicaciones p ON u.id = p.usuario_id
        GROUP BY u.id
        ORDER BY num_publicaciones DESC
        LIMIT 1";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo "<h3>Usuario con más publicaciones:</h3>";

    if ($row = mysqli_fetch_assoc($result)) {
        echo "Nombre: " . htmlspecialchars($row['nombre']) .
             ", Número de publicaciones: " . $row['num_publicaciones'];
    } else {
        echo "No se encontraron usuarios o publicaciones.";
    }

    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>