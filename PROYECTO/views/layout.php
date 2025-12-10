<?php
// views/layout.php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Videoteca - Panel</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/fontAwesome.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/templatemo-style.css">

    <style>
        body {
            background-color: white;
            color: black;
            font-family: 'Open Sans', Arial, sans-serif;
        }

        .main-wrapper {
            margin-left: 260px; /* coincide con el sidebar del template */
            padding: 40px;
            min-height: 100vh;
        }

        .section-heading h1,
        h2 {
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR IZQUIERDO -->
    <div class="sidebar-navigation hidde-sm hidden-xs">
        <div class="logo">
            <a href="<?php echo BASE_URL; ?>/">VIDEO<em>TECA</em></a>
        </div>
        <nav>
            <ul>
                <li>
                    <a href="<?php echo BASE_URL; ?>/" class="<?php echo (isset($currentPage) && $currentPage === 'dashboard') ? 'selected' : ''; ?>">
                        <span class="rect"></span>
                        <span class="circle"></span>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>/peliculas" class="<?php echo (isset($currentPage) && $currentPage === 'peliculas') ? 'selected' : ''; ?>">
                        <span class="rect"></span>
                        <span class="circle"></span>
                        Películas
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>/clientes" class="<?php echo (isset($currentPage) && $currentPage === 'clientes') ? 'selected' : ''; ?>">
                        <span class="rect"></span>
                        <span class="circle"></span>
                        Clientes
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>/alquileres" class="<?php echo (isset($currentPage) && $currentPage === 'alquileres') ? 'selected' : ''; ?>">
                        <span class="rect"></span>
                        <span class="circle"></span>
                        Alquileres
                    </a>
                </li>
            </ul>
        </nav>
        <ul class="social-icons">
            <li><a href="#"><i class="fa fa-film"></i></a></li>
            <li><a href="#"><i class="fa fa-user"></i></a></li>
            <li><a href="#"><i class="fa fa-star"></i></a></li>
        </ul>
    </div>

    <!-- CONTENIDO -->
    <div class="main-wrapper">
        <?php echo $content ?? ''; ?>
    </div>

</body>
</html>