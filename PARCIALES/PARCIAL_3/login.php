<?php
session_start();

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] == 'profesor') {
        header('Location: dashboard_profesor.php');
        exit;
    } else {
        header('Location: dashboard_estudiante.php');
        exit;
    }
}

$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Calificaciones</title>
</head>
<body>
    <h1>Sistema de calificaciones UTP segundo semestre 2025</h1>
    <h2>Inicio de Sesion</h2>
    
    <?php if ($error != ''): ?>
        <p style="color: red;"><strong><?php echo htmlspecialchars($error); ?></strong></p>
    <?php endif; ?>
    
    <form action="autenticar.php" method="POST">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required minlength="3"><br><br>
        
        <label>Contraseña:</label><br>
        <input type="password" name="password" required minlength="5"><br><br>
        
        <button type="submit">Iniciar Sesion</button>
    </form>
    
    <hr>
</body>
</html>