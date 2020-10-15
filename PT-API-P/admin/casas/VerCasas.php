<?php
    require("../../headers.php");
    require("../../conexion.php");
//nos muestra todas las casas de la bd
    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT * FROM casa ORDER BY orden_anuncio ASC");

    $carousel = [];
    $x = 0;
    while ($resultado = mysqli_fetch_array($registros)){
        $carousel[$x]['id_casa'] = $resultado[$x]['id_casa'];
        $carousel[$x]['nombre_casa'] = $resultado[$x]['nombre_casa'];
        $carousel[$x]['estado_casa'] = $resultado[$x]['estado_casa'];
        $carousel[$x]['orden_anuncio'] = $resultado[$x]['orden_anuncio'];
        if($carousel[$x]['estado_casa'] == 1){
            $carousel[$x]['estado_casa'] = "Activa";
        }else if($carousel[$x]['estado_casa'] == 0){
            $carousel[$x]['estado_casa'] = "Inactiva";
        }
        $x++;
    }
    //si es activa, nos muestra el boton de desactivar casa, si es Inactiva, nos muestra el boton de activar casa
    $json = json_encode($carousel);

    echo $json;

?>