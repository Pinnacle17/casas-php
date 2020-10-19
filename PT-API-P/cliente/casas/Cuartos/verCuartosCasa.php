<?php
    require("../../../headers.php");
    require("../../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM cuarto WHERE fk_casa=$_GET[id_casa] AND estado_cuarto = '1'");

    $cuartos = [];

    while ($resultado = mysqli_fetch_array($registros)){
        $cuartos[] = $resultado;
    }

    $json = json_encode($cuartos);

    echo $json;

?>