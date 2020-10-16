<?php
    require("../headers.php");
    require("../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT id_imagen_casa, ruta_imagen_casa FROM imagen_casa WHERE fk_casa=$_GET[id_casa]");
    
    $imgs = [];
    while ($resultado = mysqli_fetch_array($registros)){
        $imgs[] = $resultado;
    }

    $json = json_encode($imgs);

    echo $json;
?>