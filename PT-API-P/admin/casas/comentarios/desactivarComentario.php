<?php 
    require("../../../headers.php");
    require("../../../conexion.php");
    $conexion = conexion();
    $id_calificacion = $_GET['id_calificacion'];
    $consulta = "UPDATE calificacion SET estado = '0' WHERE id_calificacion = '$id_calificacion'";
    mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
?>