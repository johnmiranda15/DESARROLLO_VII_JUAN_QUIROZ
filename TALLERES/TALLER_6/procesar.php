<?php
session_start();
require_once 'validaciones.php';
require_once 'sanitizacion.php';

function convertirACamelCase($string) {
    return str_replace('_', '', ucwords($string, '_'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];
    
    $_SESSION['datos_formulario'] = $_POST;

    $campos = ['nombre', 'email', 'fecha_nacimiento', 'sitio_web', 'genero', 'intereses', 'comentarios'];
    
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $campoFunc = convertirACamelCase($campo);
            $funcionSanitizar = "sanitizar" . ucfirst($campoFunc);
            $funcionValidar = "validar" . ucfirst($campoFunc);

            if (function_exists($funcionSanitizar)) {
                $valorSanitizado = call_user_func($funcionSanitizar, $valor);
            } else {
                $valorSanitizado = $valor;
            }

            $datos[$campo] = $valorSanitizado;

            if (function_exists($funcionValidar)) {
                if (!call_user_func($funcionValidar, $valorSanitizado)) {
                    $errores[] = "El campo $campo no es valido.";
                }
            }
        }
    }

    if (!empty($datos['fecha_nacimiento']) && function_exists('calcularEdad')) {
        $datos['edad'] = calcularEdad($datos['fecha_nacimiento']);
    }

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es valida.";
        } else {
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            
            $extension = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
            $nombreUnico = uniqid('perfil_', true) . '.' . $extension;
            $rutaDestino = 'uploads/' . $nombreUnico;
            
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }

    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header('Location: formulario.php');
        exit;
    }
    
    unset($_SESSION['datos_formulario']);
    unset($_SESSION['errores']);

    // GUARDAR EN JSON - ESTE CÓDIGO FALTABA
    $archivoJSON = 'registros.json';
    $registros = [];
    
    if (file_exists($archivoJSON)) {
        $contenido = file_get_contents($archivoJSON);
        $registros = json_decode($contenido, true) ?? [];
    }
    
    $datos['fecha_registro'] = date('Y-m-d H:i:s');
    $registros[] = $datos;
    
    file_put_contents($archivoJSON, json_encode($registros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<h2>Datos Recibidos:</h2>";
    echo "<table border='1'>";
    foreach ($datos as $campo => $valor) {
        echo "<tr>";
        echo "<th>" . ucfirst(str_replace('_', ' ', $campo)) . "</th>";
        echo "<td>";
        if ($campo === 'intereses') {
            echo implode(", ", $valor);
        } elseif ($campo === 'foto_perfil') {
            echo "<img src='$valor' width='100'>";
        } else {
            echo htmlspecialchars($valor);
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><a href='formulario.php'>Volver al formulario</a> | ";
    echo "<a href='resumen.php'>Ver todos los registros</a>";
    
} else {
    echo "Acceso no permitido.";
}
?>