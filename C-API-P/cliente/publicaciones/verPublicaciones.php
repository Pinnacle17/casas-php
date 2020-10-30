<?php

    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT * FROM publicacion ORDER BY creacion_pub DESC");
    
    $publicaciones = [];
    while ($resultado = mysqli_fetch_array($registros)){
        $publicaciones[] = $resultado;
    }

    $json = json_encode($publicaciones);

    echo $json;
?>