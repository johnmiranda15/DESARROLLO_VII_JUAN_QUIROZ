<?php
// src/clientes/index.php

// Mostrar errores (útil en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración global
require_once __DIR__ . '/../../config.php';

// Clases necesarias
require_once __DIR__ . '/../../src/Database.php';
require_once __DIR__ . '/ClientesManager.php';
require_once __DIR__ . '/Cliente.php';

// Instanciar manager
$clientesManager = new ClientesManager();

// Acción por defecto
$action = $_GET['action'] ?? 'list';

// Controlador de rutas
switch ($action) {

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientesManager->crearCliente($_POST);
            header('Location: ' . BASE_URL . '/clientes');
            exit;
        }
        require VIEWS_PATH . 'clientes/formulario.php';
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '/clientes');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientesManager->actualizarCliente($id, $_POST);
            header('Location: ' . BASE_URL . '/clientes');
            exit;
        }

        $cliente = $clientesManager->obtenerCliente($id);
        require VIEWS_PATH . 'clientes/editar.php';
        break;

    case 'delete':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $clientesManager->eliminarCliente($id);
        }
        header('Location: ' . BASE_URL . '/clientes');
        exit;

    case 'list':
    default:
        $clientes = $clientesManager->obtenerTodosLosClientes();
        require VIEWS_PATH . 'clientes/lista.php';
        break;
}