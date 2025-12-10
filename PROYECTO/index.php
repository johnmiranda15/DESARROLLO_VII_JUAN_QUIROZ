<?php
// PROYECTO/index.php

// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/src/Database.php';

// Managers
require_once __DIR__ . '/src/peliculas/PeliculasManager.php';
require_once __DIR__ . '/src/clientes/ClientesManager.php';
require_once __DIR__ . '/src/alquileres/AlquileresManager.php';

// Instancias
$peliculasManager   = new PeliculasManager();
$clientesManager    = new ClientesManager();
$alquileresManager  = new AlquileresManager();

// Datos para el dashboard
$totalPeliculas  = count($peliculasManager->getAllMovies());
$totalClientes   = count($clientesManager->obtenerTodosLosClientes());
$alquileres      = $alquileresManager->obtenerTodosLosAlquileres();

// Filtramos solo alquileres activos / atrasados
$alquileresActivos = array_filter($alquileres, function($a) {
    return in_array($a['estado'], ['alquilado', 'atrasado']);
});

// Tomamos solo unos pocos para mostrar (ej. últimos 5)
$ultimasPeliculas = $peliculasManager->getAllMovies();
$ultimasPeliculas = array_slice($ultimasPeliculas, 0, 5);

// Cargar la vista del dashboard (que usará layout.php)
require __DIR__ . '/views/dashboard.php';