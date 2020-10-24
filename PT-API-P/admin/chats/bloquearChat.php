<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");

    $conexion = conexion();
    $id_chat = $_GET['id_chat'];
    $id_usuario = $_GET['id_usuario'];
    $mensaje = mysqli_real_escape_string($conexion, $_GET['mensaje']);
    Chat::InsertarMensaje($id_chat, $mensaje, 1);
    Chat::UpdateEstadoChat($id_chat, 4);
    Chat::UpdateNotificacion($id_chat, 3);
    Usuario::EstadoUsuario($id_usuario, 2);
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