<?php
// views/clientes/lista.php
$currentPage = 'clientes';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Gestión de<br><em>Clientes</em></h1>
        <p>Listado de clientes registrados en el sistema.</p>
    </div>

    <div class="section-content">
        <a href="<?php echo BASE_URL; ?>/clientes?action=create" class="btn btn-primary" style="margin-bottom: 15px;">
            ➕ Agregar Cliente
        </a>

        <?php if (!empty($clientes)) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cliente['id_cliente']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['fecha_registro']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/clientes?action=edit&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-warning">✏️</a>
                                    <a href="<?php echo BASE_URL; ?>/clientes?action=delete&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>No hay clientes registrados aún.</p>
        <?php endif; ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';