<?php
    require("../../../headers.php");
    require("../../../conexion.php");
//mostrara la informacion general del cuarto
    $conexion = conexion();
    $registros = mysqli_query($conexion, "SELECT *FROM cuarto WHERE id_cuarto = $_GET[id_cuarto]");
    $cuarto = [];
    while ($resultado = mysqli_fetch_array($registros)){
        $cuarto[] = $resultado;
    }
    //no mostrar fecha
    $json = json_encode($boleto);
    echo $json;

?>