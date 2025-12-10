<?php
// views/alquileres/formulario.php
$currentPage = 'alquileres';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Nuevo<br><em>Alquiler</em></h1>
        <p>Completa el formulario para registrar un nuevo alquiler.</p>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-md-8">
                <form action="<?php echo BASE_URL; ?>/alquileres?action=create" method="post">

                    <div class="form-group">
                        <label for="id_cliente">Cliente:</label>
                        <select id="id_cliente" name="id_cliente" class="form-control" required>
                            <option value="">-- Selecciona un cliente --</option>
                            <?php foreach ($clientes as $cliente) : ?>
                                <option value="<?php echo $cliente['id_cliente']; ?>">
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
                                <option value="<?php echo $pelicula['id_pelicula']; ?>">
                                    <?php echo htmlspecialchars($pelicula['titulo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_alquiler">Fecha de Alquiler:</label>
                        <input type="date" id="fecha_alquiler" name="fecha_alquiler" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_devolucion">Fecha de Devolución (opcional):</label>
                        <input type="date" id="fecha_devolucion" name="fecha_devolucion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="alquilado" selected>Alquilado</option>
                            <option value="devuelto">Devuelto</option>
                            <option value="atrasado">Atrasado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="<?php echo BASE_URL; ?>/alquileres" class="btn btn-default">Volver</a>

                </form>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';