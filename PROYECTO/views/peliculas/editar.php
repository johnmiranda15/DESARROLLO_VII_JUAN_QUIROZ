<?php
// views/peliculas/edit.php
$currentPage = 'peliculas';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Editar<br><em>Película</em></h1>
        <p>Modifica los datos de la película seleccionada.</p>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-md-8">
                <form action="<?php echo BASE_URL; ?>/peliculas/edit/<?php echo $pelicula['id_pelicula']; ?>" method="post">
                    <input type="hidden" name="id_pelicula" value="<?php echo htmlspecialchars($pelicula['id_pelicula']); ?>">

                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            class="form-control"
                            value="<?php echo htmlspecialchars($pelicula['titulo']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select id="tipo" name="tipo" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="Película" <?php echo ($pelicula['tipo'] == 'Película') ? 'selected' : ''; ?>>Película</option>
                            <option value="Serie" <?php echo ($pelicula['tipo'] == 'Serie') ? 'selected' : ''; ?>>Serie</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="genero">Género</label>
                        <input
                            type="text"
                            id="genero"
                            name="genero"
                            class="form-control"
                            value="<?php echo htmlspecialchars($pelicula['genero']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="anio">Año</label>
                        <input
                            type="number"
                            id="anio"
                            name="anio"
                            class="form-control"
                            min="1900"
                            max="2099"
                            value="<?php echo htmlspecialchars($pelicula['anio']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="duracion">Duración (minutos)</label>
                        <input
                            type="number"
                            id="duracion"
                            name="duracion"
                            class="form-control"
                            value="<?php echo htmlspecialchars($pelicula['duracion']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="clasificacion">Clasificación</label>
                        <select id="clasificacion" name="clasificacion" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="G" <?php echo ($pelicula['clasificacion'] == 'G') ? 'selected' : ''; ?>>G - Público general</option>
                            <option value="PG" <?php echo ($pelicula['clasificacion'] == 'PG') ? 'selected' : ''; ?>>PG</option>
                            <option value="PG-13" <?php echo ($pelicula['clasificacion'] == 'PG-13') ? 'selected' : ''; ?>>PG-13</option>
                            <option value="R" <?php echo ($pelicula['clasificacion'] == 'R') ? 'selected' : ''; ?>>R</option>
                            <option value="NC-17" <?php echo ($pelicula['clasificacion'] == 'NC-17') ? 'selected' : ''; ?>>NC-17</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sinopsis">Sinopsis</label>
                        <textarea
                            id="sinopsis"
                            name="sinopsis"
                            rows="4"
                            class="form-control"
                            required><?php echo htmlspecialchars($pelicula['sinopsis']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            class="form-control"
                            min="0"
                            value="<?php echo htmlspecialchars($pelicula['stock']); ?>"
                            required>
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="<?php echo BASE_URL; ?>/peliculas" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';