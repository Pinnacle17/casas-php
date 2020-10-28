<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT * FROM publicacion ORDER BY creacion_pub DESC");

    $eventos_recientes = [];

    while ($resultado = mysqli_fetch_array($registros)){
        $eventos_recientes[] = $resultado;
    }

    $json = json_encode($eventos_recientes);

    echo $json;

?>