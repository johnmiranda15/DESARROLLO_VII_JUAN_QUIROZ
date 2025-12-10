<?php
// src/alquileres/index.php

// Mostrar errores (útil en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración global
require_once __DIR__ . '/../../config.php';

// Clases necesarias
require_once __DIR__ . '/../../src/Database.php';
require_once __DIR__ . '/AlquileresManager.php';
require_once __DIR__ . '/Alquiler.php';

// Instanciar manager
$alquileresManager = new AlquileresManager();

// Acción por defecto
$action = $_GET['action'] ?? 'list';

// Controlador de rutas
switch ($action) {

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alquileresManager->crearAlquiler($_POST);
            header('Location: ' . BASE_URL . '/alquileres');
            exit;
        }
        // Cargar clientes y películas para el formulario
        $clientes = $alquileresManager->obtenerClientes();
        $peliculas = $alquileresManager->obtenerPeliculas();
        require VIEWS_PATH . 'alquileres/formulario.php';
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '/alquileres');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alquileresManager->actualizarAlquiler($id, $_POST);
            header('Location: ' . BASE_URL . '/alquileres');
            exit;
        }

        $alquiler = $alquileresManager->getAlquiler($id);
        $clientes = $alquileresManager->obtenerClientes();
        $peliculas = $alquileresManager->obtenerPeliculas();
        require VIEWS_PATH . 'alquileres/editar.php';
        break;

    case 'delete':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $alquileresManager->eliminarAlquiler($id);
        }
        header('Location: ' . BASE_URL . '/alquileres');
        exit;

    case 'list':
    default:
        $alquileres = $alquileresManager->obtenerTodosLosAlquileres();
        require VIEWS_PATH . 'alquileres/lista.php';
        break;
}