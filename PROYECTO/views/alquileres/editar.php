<?php
// views/alquileres/editar.php
$currentPage = 'alquileres';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Editar<br><em>Alquiler</em></h1>
        <p>Modifica los datos del alquiler seleccionado.</p>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-md-8">
                <form action="<?php echo BASE_URL; ?>/alquileres?action=edit&id=<?php echo $alquiler['id_alquiler']; ?>" method="post">

                    <input type="hidden" name="id_alquiler" value="<?php echo htmlspecialchars($alquiler['id_alquiler']); ?>">

                    <div class="form-group">
                        <label for="id_cliente">Cliente:</label>
                        <select id="id_cliente" name="id_cliente" class="form-control" required>
                            <option value="">-- Selecciona un cliente --</option>
                            <?php foreach ($clientes as $cliente) : ?>
                                <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo ($cliente['id_cliente'] == $alquiler['id_cliente']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cliente['nombre']) . ' (' . htmlspecialchars($cliente['correo']) . ')'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_pelicula">Película:</label>
                        <select id="id_pelicula" name="id_pelicula" class="form-control" required>
                            <option value="">-- Selecciona una película --</option>
                            <?php foreach ($peliculas as $pelicula) : ?>
                                <option value="<?php echo $pelicula['id_pelicula']; ?>" <?php echo ($pelicula['id_pelicula'] == $alquiler['id_pelicula']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($pelicula['titulo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_alquiler">Fecha de Alquiler:</label>
                        <input
                            type="date"
                            id="fecha_alquiler"
                            name="fecha_alquiler"
                            class="form-control"
                            value="<?php echo htmlspecialchars($alquiler['fecha_alquiler']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_devolucion">Fecha de Devolución:</label>
                        <input
                            type="date"
                            id="fecha_devolucion"
                            name="fecha_devolucion"
                            class="form-control"
                            value="<?php echo htmlspecialchars($alquiler['fecha_devolucion']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="alquilado" <?php echo ($alquiler['estado'] == 'alquilado') ? 'selected' : ''; ?>>Alquilado</option>
                            <option value="devuelto" <?php echo ($alquiler['estado'] == 'devuelto') ? 'selected' : ''; ?>>Devuelto</option>
                            <option value="atrasado" <?php echo ($alquiler['estado'] == 'atrasado') ? 'selected' : ''; ?>>Atrasado</option>
                            <option value="cancelado" <?php echo ($alquiler['estado'] == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="<?php echo BASE_URL; ?>/alquileres" class="btn btn-default">Volver</a>

                </form>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';