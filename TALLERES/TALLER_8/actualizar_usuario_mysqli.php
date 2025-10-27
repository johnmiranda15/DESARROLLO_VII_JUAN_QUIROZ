<?php
require_once "config_mysqli.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "UPDATE usuarios SET nombre=?, email=? WHERE id=?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);
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