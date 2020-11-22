<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $consulta_select_chat = "SELECT fk_usuario FROM chat WHERE notificacion = '0'";
    $resultado = BD::consultaSelect($consulta_select_chat);
    if(mysqli_num_rows($resultado) > 0){
        $chats = 1;
    }else{
        $chats = 0;
    }
    echo json_encode($chats);
?>