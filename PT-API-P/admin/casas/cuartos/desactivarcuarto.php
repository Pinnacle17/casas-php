<?php 
    require("../../../headers.php");
    require("../../../conexion.php");
    $conexion = conexion();
    $id_cuarto = $_GET['id_cuarto'];
    $consulta = "UPDATE cuarto SET estado_cuarto = '0' WHERE id_cuarto = '$id_cuarto'";
    mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
?>