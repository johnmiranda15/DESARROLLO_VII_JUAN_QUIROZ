<?php
require_once "config_pdo.php";
require_once "functions_log.php";

try {
    $pdo->beginTransaction();

    $email = 'nuevo@example.com';
    $nombre = 'Nuevo Usuario';

    // Verificar si el usuario ya existe
    $sql = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $usuario_existente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario_existente) {
        // Si ya existe, usar su ID
        $usuario_id = $usuario_existente['id'];
        echo "El usuario ya existía, se usará su ID ($usuario_id).<br>";
    } else {
        // Si no existe, insertarlo
        $sql = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nombre' => $nombre, ':email' => $email]);

        if ($stmt->errorCode() !== '00000') {
            throw new Exception("Error al insertar usuario: " . $stmt->errorInfo()[2]);
        }

        $usuario_id = $pdo->lastInsertId();
        echo "Nuevo usuario insertado con ID: $usuario_id.<br>";
    }

    // Insertar una publicación para ese usuario
    $sql = "INSERT INTO publicaciones (usuario_id, titulo, contenido) 
            VALUES (:usuario_id, :titulo, :contenido)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':titulo' => 'Nueva Publicación',
        ':contenido' => 'Contenido de la nueva publicación'
    ]);

    if ($stmt->errorCode() !== '00000') {
        throw new Exception("Error al insertar publicación: " . $stmt->errorInfo()[2]);
    }

    $pdo->commit();
    echo "Transacción completada con éxito.";

} catch (Exception $e) {
    $pdo->rollBack();
    registrar_error("PDO: " . $e->getMessage());
    echo "Error en la transacción: " . $e->getMessage();
}
?>