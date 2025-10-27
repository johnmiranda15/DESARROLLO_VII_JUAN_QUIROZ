<?php
require_once "config_mysqli.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $sql = "DELETE FROM usuarios WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
header("Location: index.php");
exit;
?>
