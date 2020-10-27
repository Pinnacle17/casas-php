<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT id_imagen_cuarto, ruta_imagen_cuarto FROM imagen_cuarto WHERE fk_cuarto=$_GET[id_cuarto]");
    
    $imgs = [];
    while ($resultado = mysqli_fetch_array($registros)){
        $imgs[] = $resultado;
    }

    $json = json_encode($imgs);

    echo $json;
?>