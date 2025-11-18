<?php
session_start();

include 'usuarios.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['rol'] != 'estudiante') {
    header('Location: login.php');
    exit;
}

$usuario_actual = $_SESSION['usuario'];
$nombre_estudiante = $_SESSION['nombre'];
$mis_calificaciones = $calificaciones[$usuario_actual];

$suma = $mis_calificaciones['Desarrollo de Software VII'] + $mis_calificaciones['Sistemas Operativos'] + $mis_calificaciones['Redes de Computadoras'];
$promedio = $suma / 3;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Estudiante</title>
</head>
<body>
    <h1>Dashboard del Estudiante</h1>
    <p>Bienvenido, <?php echo htmlspecialchars($nombre_estudiante); ?></p>
    <p><a href="cerrar_sesion.php">Cerrar Sesion</a></p>
    
    <hr>
    
    <h2>Mis Calificaciones</h2>
    <table border="1">
        <tr>
            <th>Materia</th>
            <th>Calificacion</th>
        </tr>
        <?php 
        foreach ($mis_calificaciones as $materia => $nota) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($materia) . '</td>';
            echo '<td>' . $nota . '</td>';
            echo '</tr>';
        }
        ?>
        <tr>
            <td><strong>Promedio</strong></td>
            <td><strong><?php echo round($promedio, 2); ?></strong></td>
        </tr>
    </table>
</body>
</html>