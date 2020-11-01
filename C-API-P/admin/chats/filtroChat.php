<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCasa.php");
    require("../../modelo/ClaseCuarto.php");
    $estado = $_GET['estado'];
    $chat = Chat::Chats_estado($estado);
    if($chat != null){
        $num_chat = count($chat);
        for($x = 0; $x < $num_chat; $x++){
            $resultado[$x]['id_chat'] = $chat[$x]['id_chat'];
            $resultado[$x]['fk_oferta'] = $chat[$x]['fk_oferta'];
            $usuario = Usuario::DatosUsuarioid($chat[$x]['fk_usuario']);
            $resultado[$x]['nombre_usuario'] = $usuario[0]['nombre_usuario'];
        }
    }else{
        $resultado = null;
    }
    echo json_encode($resultado); 

?>