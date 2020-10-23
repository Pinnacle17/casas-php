<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");

    $conexion = conexion();
    $id_chat = $_GET['id_chat'];
    $mensaje = mysqli_real_escape_string($conexion, $_GET['mensaje']);
    Chat::InsertarMensaje($id_chat, $mensaje, 0);
    Chat::UpdateEstadoChat($id_chat, 2);
    class Result {}

    $response = new Result();
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
    }
    
    echo json_encode($response); 

?>