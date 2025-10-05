<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';

// Función helper para convertir snake_case a camelCase
function convertirACamelCase($string)
{
    return str_replace('_', '', ucwords($string, '_'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];

    // Procesar y validar cada campo
    $campos = ['nombre', 'email', 'edad', 'sitio_web', 'genero', 'intereses', 'comentarios'];
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];

            // Convertir campo a camelCase para el nombre de función
            $campoFunc = convertirACamelCase($campo);

            $funcionSanitizar = "sanitizar" . ucfirst($campoFunc);
            $funcionValidar = "validar" . ucfirst($campoFunc);

            // Verificar que las funciones existan antes de llamarlas
            if (function_exists($funcionSanitizar)) {
                $valorSanitizado = call_user_func($funcionSanitizar, $valor);
            } else {
                $valorSanitizado = $valor; // Valor sin sanitizar si no existe la función
            }

            $datos[$campo] = $valorSanitizado;

            if (function_exists($funcionValidar)) {
                if (!call_user_func($funcionValidar, $valorSanitizado)) {
                    $errores[] = "El campo $campo no es valido.";
                }
            }
        }
    }

    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida.";
        } else {
            $rutaDestino = 'uploads/' . basename($_FILES['foto_perfil']['name']);
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }

    // Mostrar resultados o errores
    if (empty($errores)) {
        echo "<h2>Datos Recibidos:</h2>";
        foreach ($datos as $campo => $valor) {
            if ($campo === 'intereses') {
                echo "$campo: " . implode(", ", $valor) . "<br>";
            } elseif ($campo === 'foto_perfil') {
                echo "$campo: <img src='$valor' width='100'><br>";
            } else {
                echo "$campo: $valor<br>";
            }
        }
    } else {
        echo "<h2>Errores:</h2>";
        foreach ($errores as $error) {
            echo "$error<br>";
        }
    }
} else {
    echo "Acceso no permitido.";
}
?>