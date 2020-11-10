<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    $id_usuario = $_GET['id_usuario'];
    $chat =  Chat::ChatsUsuario($id_usuario);
    Chat::UpdateEstadoChat($chat['id_chat'], 1);
    Usuario::EstadoUsuario($id_usuario, 1);
    echo json_encode(true);
?>