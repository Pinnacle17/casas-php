<?php
    require("../headers.php");
    require("../conexion.php");
    //nos permite ver la colonias de la bd
    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM colonia");
    $x = 0;
    while ($resultado = mysqli_fetch_array($registros)){
        $colonias[$x]['id_colonia'] = $resultado[$x]['id_colonia'];
        $colonias[$x]['nombre_colonia'] = $resultado[$x]['nombre_colonia'];
        $x++;
    }

    $json = json_encode($colonias);

    echo $json;

?>