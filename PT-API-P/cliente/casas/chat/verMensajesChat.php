<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");

    $conexion = conexion();
    $id_chat = $_GET['id_chat'];
    $mensajes = Chat::chatMensajes($id_chat);
    
    echo json_encode($mensajes); 

?>