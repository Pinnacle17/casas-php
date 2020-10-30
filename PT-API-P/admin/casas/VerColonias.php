<?php
    require("../../headers.php");
    require("../../conexion.php");
    //nos permite ver la colonias de la bd
    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM colonia");
    while ($resultado = mysqli_fetch_array($registros)){
        $colonias[] = $resultado;
    }

    $json = json_encode($colonias);

    echo $json;

?>