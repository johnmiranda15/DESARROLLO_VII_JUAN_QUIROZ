<?php
$archivoJSON = 'registros.json';
$registros = [];

if (file_exists($archivoJSON)) {
    $contenido = file_get_contents($archivoJSON);
    $registros = json_decode($contenido, true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registros JSON</title>
</head>
<body>
    <h1>Registros Guardados</h1>
    
    <?php if (!empty($registros)): ?>
        <p>Total de registros: <?php echo count($registros); ?></p>
        <pre><?php echo json_encode($registros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?></pre>
    <?php else: ?>
        <p>No hay registros disponibles</p>
    <?php endif; ?>
    
    <br>
    <a href="formulario.php">Volver al formulario</a>
</body>
</html>