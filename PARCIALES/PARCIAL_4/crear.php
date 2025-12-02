<?php
require_once "config_mysqli.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);
    
    $sql = "INSERT INTO productos (nombre, categoria, precio, cantidad) VALUES (?, ?, ?, ?)";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssdd", $nombre, $categoria, $precio, $cantidad);
        
        if(mysqli_stmt_execute($stmt)){
            echo "Producto creado con éxito.";
            header("Location: index.php");
        } else{
            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
        }
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div><label>Nombre: </label><input type="text" name="nombre" required></div>
    <div><label>Categoria: </label><input type="categoria" name="categoria" required></div>
    <div><label>Precio: </label><input type="text" name="precio" required></div>
    <div><label>Cantidad: </label><input type="text" name="cantidad" required></div>
    <input type="submit" value="Crear Producto">
</form>
<a href="index.php">Volver al listado</a>