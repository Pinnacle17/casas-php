<?php
    header('Access-Control-Allow-Origin: *'); 
    require("../../headers.php");
    require("../../conexion.php");
    $conexion = conexion();
//nos permite obtener si la casa esta siendo ocupada o no
    class Result {}
    
    $response = new Result();

    $nombre_casa = mysqli_real_escape_string($conexion, $_GET['nombre_casa']);

    $consulta = "SELECT id_casa FROM casa WHERE nombre_casa = '$nombre_casa'";
    $registros = mysqli_query($conexion, $consulta);
    if(mysqli_num_rows($registros) > 0) {
        $registro=mysqli_fetch_array($registros);
        
        $response->estado = 0;
        $response->mensaje = "El nombre no esta disponible";
        if($registro[0]==$_GET['id_casa'])
            $response->estado = 1;
    }
    else{
        $response->estado = 1;
    }

    $json = json_encode($response);
    echo $json;
?>