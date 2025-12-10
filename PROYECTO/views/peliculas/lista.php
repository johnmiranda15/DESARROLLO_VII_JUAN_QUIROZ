<?php
// views/peliculas/lista.php
$currentPage = 'peliculas';

ob_start();
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
<section class="content-section">
    <div class="section-heading">
        <h1>Gestión de<br><em>Películas</em></h1>
        <p>Listado de películas registradas en el sistema.</p>
    </div>

    <div class="section-content">
        <a href="<?php echo BASE_URL; ?>/peliculas/create" class="btn btn-primary" style="margin-bottom: 15px;">
            ➕ Agregar Película
        </a>

        <?php if (!empty($peliculas)) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" style="color: black;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Género</th>
                            <th>Año</th>
                            <th>Duración</th>
                            <th>Clasificación</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peliculas as $pelicula) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pelicula['id_pelicula']); ?></td>
                                <td><?php echo htmlspecialchars($pelicula['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($pelicula['tipo']); ?></td>
                                <td><?php echo htmlspecialchars($pelicula['genero']); ?></td>
                                <td><?php echo htmlspecialchars($pelicula['anio']); ?></td>
                                <td><?php echo htmlspecialchars($pelicula['duracion']); ?> min</td>
                                <td><?php echo htmlspecialchars($pelicula['clasificacion']); ?></td>
                                <td><?php echo htmlspecialchars($pelicula['stock']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/peliculas/edit/<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-sm btn-warning">✏️</a>
                                    <a href="<?php echo BASE_URL; ?>/peliculas/delete/<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta película?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>No hay películas registradas aún.</p>
        <?php endif; ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';