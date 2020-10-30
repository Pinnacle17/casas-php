<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM casa WHERE id_casa=$_GET[id_casa]");

    $casa = [];

    while ($resultado = mysqli_fetch_array($registros)){
        $casa[] = $resultado;
    }

    $json = json_encode($casa);

    echo $json;

?>