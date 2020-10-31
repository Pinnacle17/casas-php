<?php 
    require("../../headers.php");
    require("../../conexion.php");
    $conexion = conexion();
    $id_casa = $_GET['id_casa'];
    $consulta = "UPDATE casa SET estado_casa = '1' WHERE id_casa = '$id_casa'";
    mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
?>