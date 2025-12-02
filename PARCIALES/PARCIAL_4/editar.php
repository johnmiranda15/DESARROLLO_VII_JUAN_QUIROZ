<?php
require_once "config_mysqli.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $producto = mysqli_fetch_assoc($result);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);

    $sql = "UPDATE productos SET nombre=?, categoria=?, precio=?, cantidad=? WHERE id=?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssddi", $nombre, $categoria, $precio, $cantidad, $id);
        if(mysqli_stmt_execute($stmt)){
            header("Location: index.php");
            exit;
        } else {
            echo "Error al actualizar: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
    <div><label>Nombre: </label><input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>"></div>
    <div><label>Categoria: </label><input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>"></div>
    <div><label>Precio: </label><input type="text" name="precio" value="<?php echo $producto['precio']; ?>"></div>
    <div><label>Cantidad: </label><input type="text" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required></div>
    <input type="submit" value="Actualizar Producto">
</form>
<a href="index.php">Volver al listado</a>