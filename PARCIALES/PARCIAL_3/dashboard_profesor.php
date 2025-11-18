<?php
session_start();

include 'usuarios.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['rol'] != 'profesor') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Profesor</title>
</head>
<body>
    <h1>Dashboard del Profesor</h1>
    <p>Bienvenido, Profesor</p>
    <p><a href="cerrar_sesion.php">Cerrar Sesion</a></p>
    
    <hr>
    
    <h2>Calificaciones de Estudiantes</h2>
    <table border="1">
        <tr>
            <th>Estudiante</th>
            <th>Desarrollo de Software VII</th>
            <th>Sistemas Operativos</th>
            <th>Redes de Computadoras</th>
            <th>Promedio</th>
        </tr>
        <?php 
        foreach ($usuarios as $key => $user) {
            if ($user['rol'] == 'estudiante') {
                $notas = $calificaciones[$key];
                
                $suma = $notas['Desarrollo de Software VII'] + $notas['Sistemas Operativos'] + $notas['Redes de Computadoras'];
                $promedio = $suma / 3;
                
                echo '<tr>';
                echo '<td>' . htmlspecialchars($user['nombre']) . '</td>';
                echo '<td>' . $notas['Desarrollo de Software VII'] . '</td>';
                echo '<td>' . $notas['Sistemas Operativos'] . '</td>';
                echo '<td>' . $notas['Redes de Computadoras'] . '</td>';
                echo '<td>' . round($promedio, 2) . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</body>
</html>