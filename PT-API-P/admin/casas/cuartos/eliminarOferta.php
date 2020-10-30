<?php 
    require("../../../headers.php");
    require("../../../conexion.php");
    $conexion = conexion();
    $id_oferta = $_GET['id_oferta'];
    $consulta = "DELETE FROM oferta WHERE id_oferta = '$id_oferta'";
    mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
?>