<?php
session_start();
$datosAnteriores = $_SESSION['datos_formulario'] ?? [];
$erroresAnteriores = $_SESSION['errores'] ?? [];
unset($_SESSION['datos_formulario']);
unset($_SESSION['errores']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario de Registro Avanzado</title>
</head>

<body>
  <h2>Formulario de Registro Avanzado</h2>

  <?php if (!empty($erroresAnteriores)): ?>
    <h3>Errores:</h3>
    <ul>
      <?php foreach ($erroresAnteriores as $error): ?>
        <li><?php echo htmlspecialchars($error); ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form action="procesar.php" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"
      value="<?php echo htmlspecialchars($datosAnteriores['nombre'] ?? ''); ?>" required /><br /><br />

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($datosAnteriores['email'] ?? ''); ?>"
      required /><br /><br />

    <label>Fecha de Nacimiento:</label><br />
    <input type="date" name="fecha_nacimiento"
      value="<?php echo htmlspecialchars($datosAnteriores['fecha_nacimiento'] ?? ''); ?>" required /><br /><br />

    <label for="sitio_web">Sitio Web:</label>
    <input type="url" id="sitio_web" name="sitio_web"
      value="<?php echo htmlspecialchars($datosAnteriores['sitio_web'] ?? ''); ?>" /><br /><br />

    <label for="genero">Género:</label>
    <select id="genero" name="genero">
      <option value="masculino" <?php echo ($datosAnteriores['genero'] ?? '') == 'masculino' ? 'selected' : ''; ?>>
        Masculino</option>
      <option value="femenino" <?php echo ($datosAnteriores['genero'] ?? '') == 'femenino' ? 'selected' : ''; ?>>Femenino
      </option>
      <option value="otro" <?php echo ($datosAnteriores['genero'] ?? '') == 'otro' ? 'selected' : ''; ?>>Otro</option>
    </select><br /><br />

    <label>Intereses:</label><br />
    <?php $interesesSeleccionados = $datosAnteriores['intereses'] ?? []; ?>
    <input type="checkbox" id="deportes" name="intereses[]" value="deportes" <?php echo in_array('deportes', $interesesSeleccionados) ? 'checked' : ''; ?> />
    <label for="deportes">Deportes</label><br />
    <input type="checkbox" id="musica" name="intereses[]" value="musica" <?php echo in_array('musica', $interesesSeleccionados) ? 'checked' : ''; ?> />
    <label for="musica">Música</label><br />
    <input type="checkbox" id="lectura" name="intereses[]" value="lectura" <?php echo in_array('lectura', $interesesSeleccionados) ? 'checked' : ''; ?> />
    <label for="lectura">Lectura</label><br /><br />

    <label for="comentarios">Comentarios:</label><br />
    <textarea id="comentarios" name="comentarios" rows="4"
      cols="50"><?php echo htmlspecialchars($datosAnteriores['comentarios'] ?? ''); ?></textarea><br /><br />

    <label for="foto_perfil">Foto de Perfil:</label>
    <input type="file" id="foto_perfil" name="foto_perfil" /><br /><br />

    <input type="submit" value="Enviar" />
    <input type="reset" value="Limpiar" />
  </form>
  <br><br>
  <a href="resumen.php">Ver registros guardados</a>
</body>

</html>