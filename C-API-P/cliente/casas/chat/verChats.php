<?php
    require("../../../headers.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");
    $id_usuario = $_GET['id_usuario'];
    $chats = Chat::ChatsUsuario($id_usuario);
    if($chats != null){
        $numerochats = count($chats);
        for($x = 0; $x < $numerochats; $x++){
            $resultado[$x]['id_chat'] = $chats[$x]['id_chat'];
            if($chats[$x]['estado_chat'] == 1){
                $resultado[$x]['estado_chat'] = "Activo";
            }else if($chats[$x]['estado_chat'] == 2){
                $resultado[$x]['estado_chat'] = "Terminado por el usuario";
            }else if($chats[$x]['estado_chat'] == 3){
                $resultado[$x]['estado_chat'] = "Terminado por el administrador";
            }
            
            //$resultado[$x]['fk_oferta'] = $chats[$x]['fk_oferta'];
            $resultado[$x]['creacion_chat'] = $chats[$x]['creacion_chat'];
        }
    }else{
        $resultado = null;
    }
    
    echo json_encode($resultado); 

?>