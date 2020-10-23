<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");

    $conexion = conexion();
    $id_usuario = $_GET['id_usuario'];
    $chats = Chat::ChatsUsuario($id_usuario);
    if($chats != null){
        $numerochats = count($chats);
        for($x = 0; $x < $numerochats; $x++){
            $resultado[$x]['id_chat'] = $chats[$x]['id_chat'];
            if($chats[$x]['estado_chat'] == 1){
                $resultado[$x]['estado_chat'] = "Terminado";
            }else{
                $resultado[$x]['estado_chat'] = "Activo";
            }
            if($chats[$x]['notificacion'] == 0){
                $resultado[$x]['notificacion'] = "No se tiene respuesta";
            }else if($chats[$x]['notificacion'] == 1){
                $resultado[$x]['notificacion'] = "Respondido por el admin";
            }else if($chats[$x]['notificacion'] == 2){
                $resultado[$x]['notificacion'] = "terminado por el usuario";
            }else{
                $resultado[$x]['notificacion'] = "terminado por el administrador";
            }
            //$resultado[$x]['fk_oferta'] = $chats[$x]['fk_oferta'];
            $resultado[$x]['creacion_chat'] = $chats[$x]['creacion_chat'];
        }
    }else{
        $resultado = null;
    }
    
    echo json_encode(null); 

?>