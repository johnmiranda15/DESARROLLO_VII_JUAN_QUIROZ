<?php
// views/alquileres/lista.php
$currentPage = 'alquileres';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Gestión de<br><em>Alquileres</em></h1>
        <p>Listado de alquileres registrados en el sistema.</p>
    </div>

    <div class="section-content">
        <a href="<?php echo BASE_URL; ?>/alquileres?action=create" class="btn btn-primary" style="margin-bottom: 15px;">
            ➕ Nuevo Alquiler
        </a>

        <?php if (!empty($alquileres)) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Película</th>
                            <th>Fecha Alquiler</th>
                            <th>Fecha Devolución</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alquileres as $alquiler) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alquiler['id_alquiler']); ?></td>
                                <td><?php echo htmlspecialchars($alquiler['cliente_nombre']); ?></td>
                                <td><?php echo htmlspecialchars($alquiler['pelicula_titulo']); ?></td>
                                <td><?php echo htmlspecialchars($alquiler['fecha_alquiler']); ?></td>
                                <td><?php echo $alquiler['fecha_devolucion'] ? htmlspecialchars($alquiler['fecha_devolucion']) : '<em>Pendiente</em>'; ?></td>
                                <td>
                                    <?php
                                    $badgeClass = 'badge ';
                                    switch($alquiler['estado']) {
                                        case 'alquilado': $badgeClass .= 'bg-primary'; break;
                                        case 'devuelto': $badgeClass .= 'bg-success'; break;
                                        case 'atrasado': $badgeClass .= 'bg-danger'; break;
                                        case 'cancelado': $badgeClass .= 'bg-secondary'; break;
                                        default: $badgeClass .= 'bg-info';
                                    }
                                    ?>
                                    <span class="<?php echo $badgeClass; ?>"><?php echo htmlspecialchars($alquiler['estado']); ?></span>
                                </td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/alquileres?action=edit&id=<?php echo $alquiler['id_alquiler']; ?>" class="btn btn-sm btn-warning">✏️</a>
                                    <a href="<?php echo BASE_URL; ?>/alquileres?action=delete&id=<?php echo $alquiler['id_alquiler']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este alquiler?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>No hay alquileres registrados aún.</p>
        <?php endif; ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';