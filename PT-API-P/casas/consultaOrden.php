<?php
    require("../headers.php");
    require("../conexion.php");
    $conexion = conexion();

    class Result {}
    
    $response = new Result();

    $orden = mysqli_real_escape_string($conexion, $_GET['orden']);

    $consulta = "SELECT nombre_casa, orden_anuncio FROM casa WHERE orden_anuncio = '$orden'";
    $registros = mysqli_query($conexion, $consulta);
    if(mysqli_num_rows($registros) > 0) {
        while ($registro=mysqli_fetch_array($registros)) {
            $nombre=$registro["nombre_casa"];//existe y envia el nombre del evento que ocupa la casilla
        }
        $response->estado = 0;
        $response->mensaje = "El lugar está ocupado por el evento: ".$nombre;
    }
    else{
        $response->estado = 1;
    }

    $json = json_encode($response);
    echo $json;
?>