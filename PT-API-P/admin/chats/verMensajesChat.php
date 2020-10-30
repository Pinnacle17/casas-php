<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $id_chat = $_GET['id_chat'];
    $mensajes = Chat::chatMensajes($id_chat);
    
    echo json_encode($mensajes); 

?>