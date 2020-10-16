<?php
    require("../../headers.php");
    require("../../conexion.php");
    //nos permite ver la colonias de la bd
    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM semestre");
    while ($resultado = mysqli_fetch_array($registros)){
        $semestres[] = $resultado;
    }

    $json = json_encode($colonias);
    echo $json;

?>