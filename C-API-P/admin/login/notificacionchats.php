<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $conexion = conexion();
    $usuario = Chat::Chat_estado(0);
    if($usuario == null){
        $chats = 0;//no hay chats activos
    }else{
        $chats = 1;//hay chats activos 
    }

    echo json_encode($chats);
?>