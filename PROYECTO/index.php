<?php
// ✅ Mostrar errores (útil en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ✅ Definir ruta base
define('BASE_PATH', __DIR__ . '/');

// ✅ Configuración
require_once BASE_PATH . 'config.php';

// ✅ Clases necesarias
require_once BASE_PATH . 'src/Database.php';
require_once BASE_PATH . 'src/peliculas/PeliculasManager.php';
require_once BASE_PATH . 'src/peliculas/Peliculas.php';

// ✅ Instanciamos el manager
$peliculasManager = new PeliculasManager();

// ✅ Acción por defecto
$action = $_GET['action'] ?? 'list';

// ✅ Controlador de rutas (acciones)
switch ($action) {

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titulo'        => $_POST['titulo']        ?? '',
                'tipo'          => $_POST['tipo']          ?? '',
                'genero'        => $_POST['genero']        ?? '',
                'anio'          => $_POST['anio']          ?? '',
                'duracion'      => $_POST['duracion']      ?? '',
                'clasificacion' => $_POST['clasificacion'] ?? '',
                'sinopsis'      => $_POST['sinopsis']      ?? '',
                'stock'         => $_POST['stock']         ?? '',
            ];

            $peliculasManager->createMovie($data);
            header('Location: index.php');
            exit;
        }
        require BASE_PATH . 'views/peliculas/formulario.php';
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Actualizar película
            $peliculasManager->updateMovie($id, $_POST);
            header('Location: index.php');
            exit;
        }

        // Obtener la película para editar
        $pelicula = $peliculasManager->getMovieById($id);
        require BASE_PATH . 'views/peliculas/editar.php';
        break;

    case 'delete':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $peliculasManager->deleteMovie($id);
        }
        header('Location: index.php');
        break;

    default:
        // Listar todas las películas
        $peliculas = $peliculasManager->getAllMovies();
        require BASE_PATH . 'views/peliculas/lista.php';
        break;
}