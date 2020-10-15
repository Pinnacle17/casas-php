<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM evento WHERE id_casa=$_GET[id_casa]");
    //nos permite ver todos los datos de la casa
    while ($resultado = mysqli_fetch_array($registros)){
        $evento[] = $resultado;
    }

    $json = json_encode($evento);

    echo $json;

?>