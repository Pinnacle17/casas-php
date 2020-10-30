<?php
    require("../../../headers.php");
    require("../../../conexion.php");
//mostrara la informacion general del cuarto
    $conexion = conexion();
    $registros = mysqli_query($conexion, "SELECT *FROM cuarto WHERE fk_casa = $_GET[id_casa]");
    $cuartos = [];
    while ($resultado = mysqli_fetch_array($registros)){
        $cuartos[] = $resultado;
    }
    //no mostrar fecha
    $json = json_encode($cuartos);
    echo $json;

?>