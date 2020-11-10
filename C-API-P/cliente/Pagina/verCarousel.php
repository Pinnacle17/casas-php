<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM casa WHERE estado_casa = '1' ORDER BY orden_anuncio ASC");

    $carousel = [];

    while ($resultado = mysqli_fetch_array($registros)){
        $carousel[] = $resultado;
    }

    $json = json_encode($carousel);

    echo $json;

?>