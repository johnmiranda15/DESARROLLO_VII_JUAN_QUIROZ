<?php
// views/dashboard.php
$currentPage = 'dashboard';

ob_start();
?>
<section class="content-section">
    <div class="section-heading">
        <h1>Panel<br><em>Principal</em></h1>
        <p>Resumen general del sistema de videoteca.</p>
    </div>

    <div class="section-content">
        <!-- Resumen de métricas -->
        <div class="row" style="margin-bottom: 25px;">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h3><?php echo (int) $totalPeliculas; ?></h3>
                        <p>Películas registradas</p>
                        <a href="<?php echo BASE_URL; ?>/peliculas" class="btn btn-xs btn-primary">Ver películas</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h3><?php echo (int) $totalClientes; ?></h3>
                        <p>Clientes registrados</p>
                        <a href="<?php echo BASE_URL; ?>/clientes" class="btn btn-xs btn-primary">Ver clientes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h3><?php echo count($alquileresActivos); ?></h3>
                        <p>Alquileres activos / atrasados</p>
                        <a href="<?php echo BASE_URL; ?>/alquileres" class="btn btn-xs btn-primary">Ver alquileres</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimas películas agregadas -->
        <div class="row">
            <div class="col-md-12">
                <h3>Últimas películas registradas</h3>

                <?php if (!empty($ultimasPeliculas)) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Género</th>
                                    <th>Clasificación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ultimasPeliculas as $pelicula) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($pelicula['id_pelicula']); ?></td>
                                        <td><?php echo htmlspecialchars($pelicula['titulo']); ?></td>
                                        <td><?php echo htmlspecialchars($pelicula['genero'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($pelicula['clasificacion'] ?? ''); ?></td>
                                        <td>
                                            <?php
                                            // Ajusta el nombre de la columna según tu tabla
                                            $estadoPeli = $pelicula['status'] ?? ($pelicula['estado'] ?? '');
                                            if ($estadoPeli) {
                                                $badgeClass = 'badge ';
                                                switch ($estadoPeli) {
                                                    case 'disponible':    $badgeClass .= 'bg-success'; break;
                                                    case 'no_disponible':
                                                    case 'alquilada':     $badgeClass .= 'bg-warning'; break;
                                                    default:              $badgeClass .= 'bg-secondary';
                                                }
                                                echo '<span class="'.$badgeClass.'">'.htmlspecialchars($estadoPeli).'</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo BASE_URL; ?>/peliculas?action=edit&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-sm btn-warning">✏️</a>
                                            <a href="<?php echo BASE_URL; ?>/peliculas?action=delete&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta película?');">🗑️</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <p>No hay películas registradas aún.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';