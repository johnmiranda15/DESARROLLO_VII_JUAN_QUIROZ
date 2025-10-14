<?php
include 'estadisticas.php';

$datos = [45, 23, 56, 78, 12, 34, 56, 89, 23, 45, 67, 34, 23, 56, 78, 90, 12, 34, 56, 23, 10, 53];

$media = calcular_media($datos);
$mediana = calcular_mediana($datos);
$moda = encontrar_moda($datos);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Analisis de Datos</title>
</head>
<body>
    <h1>Analisis Estadístico de Datos</h1>
    
    <h2>Datos Originales:</h2>
    <p><?php echo implode(", ", $datos); ?></p>
    
    <h2>Resultados:</h2>
    <table border="1">
        <tr>
            <th>Estadistica</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Media (Promedio)</td>
            <td><?php echo round($media, 2); ?></td>
        </tr>
        <tr>
            <td>Mediana</td>
            <td><?php echo $mediana; ?></td>
        </tr>
        <tr>
            <td>Moda</td>
            <td><?php echo implode(", ", $moda); ?></td>
        </tr>
        <tr>
            <td>Total de datos</td>
            <td><?php echo count($datos); ?></td>
        </tr>
    </table>
</body>
</html>