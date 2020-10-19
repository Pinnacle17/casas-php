<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM casa WHERE estado_casa = '1'");

    $casas = [];

    while ($resultado = mysqli_fetch_array($registros)){
        $casas[] = $resultado;
    }

    $json = json_encode($casas);

    echo $json;

?>