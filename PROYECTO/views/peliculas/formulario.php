<?php
// views/peliculas/formulario.php
$currentPage = 'peliculas';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Nueva<br><em>Película</em></h1>
        <p>Completa el formulario para agregar una nueva película al catálogo.</p>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-md-8">
                <form action="<?php echo BASE_URL; ?>/peliculas?action=create" method="post">

                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="tipo" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="Película">Película</option>
                            <option value="Serie">Serie</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <input type="text" id="genero" name="genero" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="anio">Año:</label>
                        <input type="number" id="anio" name="anio" class="form-control" min="1900" max="2099" required>
                    </div>

                    <div class="form-group">
                        <label for="duracion">Duración (minutos):</label>
                        <input type="number" id="duracion" name="duracion" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="clasificacion">Clasificación:</label>
                        <select id="clasificacion" name="clasificacion" class="form-control">
                            <option value="">Seleccione...</option>
                            <option value="G">G - Público general</option>
                            <option value="PG">PG - Se sugiere compañía de adultos</option>
                            <option value="PG-13">PG-13 - Mayores de 13 años</option>
                            <option value="R">R - Restringida</option>
                            <option value="NC-17">NC-17 - Solo adultos</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sinopsis">Sinopsis:</label>
                        <textarea id="sinopsis" name="sinopsis" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="stock" class="form-control" min="0" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="<?php echo BASE_URL; ?>/peliculas" class="btn btn-default">Volver</a>

                </form>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';