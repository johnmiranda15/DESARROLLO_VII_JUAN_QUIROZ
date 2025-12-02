<?php
require_once "config_mysqli.php";

$sql = "SELECT id, nombre, categoria, precio, cantidad, fecha_registro FROM productos";
$result = mysqli_query($conn, $sql);

if($result){
    if(mysqli_num_rows($result) > 0){
        echo "<table border='1'>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nombre</th>";
                echo "<th>Categoria</th>";
                echo "<th>Precio</th>";
                echo "<th>Cantidad</th>";
                echo "<th>Fecha de Registro</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>" . $row['fecha_registro'] . "</td>";
                echo "<td><a href='editar.php?id=" . $row['id'] . "'>Editar</a></td>";
                echo "<td><a href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este producto?');\">Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No se encontraron registros.";
    }
} else{
    echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
}
mysqli_close($conn);
?>
<a href="crear.php">Crear Producto</a>