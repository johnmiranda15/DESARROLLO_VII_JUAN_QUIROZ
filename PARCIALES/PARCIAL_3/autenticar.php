<?php
session_start();

include 'usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    
    if (strlen($usuario) < 3) {
        $_SESSION['error'] = 'Usuario debe tener al menos 3 caracteres';
        header('Location: login.php');
        exit;
    }
    
    if (preg_match('/^[a-zA-Z0-9]+$/', $usuario) == false) {
        $_SESSION['error'] = 'Usuario solo puede contener letras y numeros';
        header('Location: login.php');
        exit;
    }
    
    if (strlen($password) < 5) {
        $_SESSION['error'] = 'Contraseña debe tener al menos 5 caracteres';
        header('Location: login.php');
        exit;
    }
    
    $encontrado = false;
    
    if (isset($usuarios[$usuario])) {
        if ($usuarios[$usuario]['password'] === $password) {
            $encontrado = true;
        }
    }
    
    if ($encontrado == true) {
        
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $usuarios[$usuario]['rol'];
        
        if ($usuarios[$usuario]['rol'] == 'profesor') {
            header('Location: dashboard_profesor.php');
            exit;
        } else {
            $_SESSION['nombre'] = $usuarios[$usuario]['nombre'];
            header('Location: dashboard_estudiante.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos';
        header('Location: login.php');
        exit;
    }
}

header('Location: login.php');
exit;
?>