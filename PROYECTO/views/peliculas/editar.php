<?php ob_start(); ?>
<div class="pelicula-form">
    <h2>Editar Película</h2>

    <form action="index.php?action=update" method="post">
        
        <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula']; ?>">

        <label>Título</label>
        <input type="text" name="titulo" value="<?php echo $pelicula['titulo']; ?>" required>

        <label>Tipo</label>
        <select name="tipo" required>
            <option value="película" <?php echo ($pelicula['tipo'] == 'película') ? 'selected' : ''; ?>>Película</option>
            <option value="serie" <?php echo ($pelicula['tipo'] == 'serie') ? 'selected' : ''; ?>>Serie</option>
        </select>

        <label>Género</label>
        <input type="text" name="genero" value="<?php echo $pelicula['genero']; ?>" required>

        <label>Año</label>
        <input type="number" name="anio" value="<?php echo $pelicula['anio']; ?>" required>

        <label>Duración (minutos)</label>
        <input type="number" name="duracion" value="<?php echo $pelicula['duracion']; ?>" required>

        <label>Clasificación</label>
        <input type="text" name="clasificacion" value="<?php echo $pelicula['clasificacion']; ?>" required>

        <label>Sinopsis</label>
        <textarea name="sinopsis" required><?php echo $pelicula['sinopsis']; ?></textarea>

        <label>Stock</label>
        <input type="number" name="stock" value="<?php echo $pelicula['stock']; ?>" required>

        <button type="submit" class="btn">Actualizar</button>
    </form>

    <a href="index.php?action=list" class="btn">Volver</a>
</div>

<?php 
$content = ob_get_clean();
require BASE_PATH . 'views/layout.php'; 
?>
