<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM publicacion WHERE id_publicacion=$_GET[id_publicacion]");

    while ($resultado = mysqli_fetch_array($registros)){
        $publicacion[] = $resultado;
    }

    $json = json_encode($publicacion);

    echo $json;
?>