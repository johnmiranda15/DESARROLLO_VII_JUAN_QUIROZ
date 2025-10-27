<?php
require_once "config_mysqli.php";
require_once "functions_log.php";

mysqli_begin_transaction($conn);

try {
    // Insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception("Error preparando la consulta de usuario: " . mysqli_error($conn));
    }

    $nombre = "Nuevo Usuario";
    $email = "nuevo@example.com";
    mysqli_stmt_bind_param($stmt, "ss", $nombre, $email);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error ejecutando la inserción de usuario: " . mysqli_error($conn));
    }

    $usuario_id = mysqli_insert_id($conn);

    // Insertar una publicación para ese usuario
    $sql = "INSERT INTO publicaciones (usuario_id, titulo, contenido) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception("Error preparando la consulta de publicación: " . mysqli_error($conn));
    }

    $titulo = "Nueva Publicación";
    $contenido = "Contenido de la nueva publicación";
    mysqli_stmt_bind_param($stmt, "iss", $usuario_id, $titulo, $contenido);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error ejecutando la inserción de publicación: " . mysqli_error($conn));
    }

    mysqli_commit($conn);
    echo "Transacción completada con éxito.";

} catch (Exception $e) {
    mysqli_rollback($conn);
    registrar_error("MySQLi: " . $e->getMessage());
    echo "Error en la transacción: " . $e->getMessage();
}

mysqli_close($conn);
?>