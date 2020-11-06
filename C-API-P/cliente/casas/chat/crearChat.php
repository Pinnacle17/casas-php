<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");

    $conexion = conexion();
    $id_usuario = $_GET['id_usuario'];
    $mensaje = mysqli_real_escape_string($conexion, $_GET['mensaje']);
    $fecha = date("Y-m-d H:i:s"); 
    $consulta_crear_chat = "INSERT INTO chat(estado_chat, notificacion, creacion_chat,fk_usuario) VALUES ('1', '0', '$fecha','$id_usuario')";
    mysqli_query($conexion, $consulta_crear_chat);
    $consulta_ver_chat = "SELECT id_chat FROM chat WHERE estado_chat = '1' AND fk_usuario = '$id_usuario'";
    $registro_chat = mysqli_query($conexion, $consulta_ver_chat);
    while ($resultadochat = mysqli_fetch_array($registro_chat)){
        $id_chat = $resultadochat['id_chat'];
    }
    Chat::InsertarMensaje($id_chat, $mensaje, 0);
    class Result {}

    $response = new Result();
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
        $response->id_chat = $id_chat;//redirige a el chat
    }
    
    echo json_encode($response); 

?>