<?php ob_start(); ?>
<div class="pelicula-form">
    <h2>Agregar Nueva Película</h2>

    <form action="index.php?action=create" method="post">
        <label>Título:</label>
        <input type="text" name="titulo" required>

        <label>Tipo:</label>
        <input type="text" name="tipo" required>

        <label>Género:</label>
        <input type="text" name="genero" required>

        <label>Año:</label>
        <input type="number" name="anio" min="1900" max="2099" required>

        <label>Duración (minutos):</label>
        <input type="number" name="duracion" required>

        <label>Clasificación:</label>
        <input type="text" name="clasificacion">

        <label>Sinopsis:</label>
        <textarea name="sinopsis" rows="4"></textarea>

        <label>Stock:</label>
        <input type="number" name="stock" min="0" required>

        <button type="submit" class="btn">Guardar</button>
        <a href="index.php" class="btn">Volver</a>
    </form>
</div>

<?php
$content = ob_get_clean();
require BASE_PATH . 'views/layout.php';
?>
