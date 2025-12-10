<?php
// views/clientes/formulario.php
$currentPage = 'clientes';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Nuevo<br><em>Cliente</em></h1>
        <p>Completa el formulario para agregar un nuevo cliente.</p>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-md-8">
                <form action="<?php echo BASE_URL; ?>/clientes?action=create" method="post">

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fecha_registro">Fecha de Registro:</label>
                        <input type="date" id="fecha_registro" name="fecha_registro" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="<?php echo BASE_URL; ?>/clientes" class="btn btn-default">Volver</a>

                </form>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';