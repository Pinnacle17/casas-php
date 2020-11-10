<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $id_compra = mysqli_real_escape_string($conexion,$_GET['id_compra']);
    $id_usuario = mysqli_real_escape_string($conexion,$_GET['id_usuario']);

    $registros = mysqli_query($conexion, "SELECT *FROM compra WHERE fk_usuario = '$id_usuario' AND id_compra = '$id_compra'");
    
    if(mysqli_num_rows($registros) > 0){
        $respuesta = true;
    }else{
        $respuesta = false;
    }

    echo json_encode($respuesta);

?>