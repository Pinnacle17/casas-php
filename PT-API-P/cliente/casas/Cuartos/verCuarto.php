<?php
    require("../../../headers.php");
    require("../../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM cuarto WHERE id_cuarto=$_GET[id_cuarto]");

    $cuarto = [];

    while ($resultado = mysqli_fetch_array($registros)){
        $cuarto[] = $resultado;
    }

    $json = json_encode($cuarto);

    echo $json;

?>