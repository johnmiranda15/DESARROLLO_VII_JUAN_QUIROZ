<?php
// views/clientes/editar.php
$currentPage = 'clientes';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Editar<br><em>Cliente</em></h1>
        <p>Modifica los datos del cliente seleccionado.</p>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-md-8">
                <form action="<?php echo BASE_URL; ?>/clientes?action=edit&id=<?php echo $cliente['id_cliente']; ?>" method="post">

                    <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control"
                            value="<?php echo htmlspecialchars($cliente['nombre']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="form-control"
                            value="<?php echo htmlspecialchars($cliente['correo']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            class="form-control"
                            value="<?php echo htmlspecialchars($cliente['telefono']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="form-control"
                            value="<?php echo htmlspecialchars($cliente['direccion']); ?>">
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="<?php echo BASE_URL; ?>/clientes" class="btn btn-default">Volver</a>

                </form>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';