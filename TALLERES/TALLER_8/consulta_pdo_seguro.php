<?php
require_once "config_pdo.php";
require_once "functions_log.php";

try {
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    if ($stmt->errorCode() !== '00000') {
        throw new Exception("Error en la consulta de usuarios: " . $stmt->errorInfo()[2]);
    }

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$usuarios) {
        echo "No se encontraron usuarios.";
    } else {
        foreach ($usuarios as $u) {
            echo htmlspecialchars($u['nombre']) . " — " . htmlspecialchars($u['email']) . "<br>";
        }
    }

} catch (Exception $e) {
    registrar_error("PDO Consulta: " . $e->getMessage());
    echo "Ocurrió un error al consultar los usuarios.";
}
?>