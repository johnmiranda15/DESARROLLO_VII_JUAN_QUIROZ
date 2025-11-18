<?php 
ob_start(); 
?>

<div class="peliculas-list">
    <h2>Listado de Películas</h2>

    <a href="index.php?action=create" class="btn">➕ Agregar Película</a>

    <?php if (!empty($peliculas)) : ?>
        <table border="1" cellpadding="8" cellspacing="0">
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
                            <a href="index.php?action=edit&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn">✏️ Editar</a>
                            <a href="index.php?action=delete&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta película?');">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No hay películas registradas aún.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require BASE_PATH . 'views/layout.php';
?>
