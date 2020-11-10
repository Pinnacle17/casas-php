<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM publicacion ORDER BY creacion_pub DESC");

    $publicaciones_recientes = [];

    while ($resultado = mysqli_fetch_array($registros)){
        $publicaciones_recientes[] = $resultado;
    }

    $json = json_encode($publicaciones_recientes);

    echo $json;

?>