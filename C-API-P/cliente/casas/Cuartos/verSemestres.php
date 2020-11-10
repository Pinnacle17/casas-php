<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    //nos permite ver la colonias de la bd
    $conexion = conexion();
    $fecha = date("Y-m-d");
    $registros = mysqli_query($conexion, "SELECT *FROM semestre WHERE inicio_semestre <= '$fecha'");
    while ($resultado = mysqli_fetch_array($registros)){
        $semestres[] = $resultado;
    }

    $json = json_encode($semestres);
    echo $json;

?>