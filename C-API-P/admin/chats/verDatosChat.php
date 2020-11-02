<?php

    //ver los datos generales del chat
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCasa.php");
    require("../../modelo/ClaseCuarto.php");
    $id_chat = $_GET['id_chat'];
    $chat = Chat::ChatId($id_chat);
    if($chat != null){
        if($chat[0]['estado_chat'] == 1){
            $resultado['estado_chat'] = "Activo";
        }else if($chat[0]['estado_chat'] == 2){
            $resultado['estado_chat'] = "Terminado por el usuario";
        }else if($chat[0]['estado_chat'] == 3){
            $resultado['estado_chat'] = "Terminado por el administrador";
        }
        $usuario = Usuario::DatosUsuarioid($chat[0]['fk_usuario']);
        $resultado['nombre_usuario'] = $usuario[0]['nombre_usuario'];
        $oferta = Usuario::verOfertaid($chat[0]['fk_oferta']);
        $resultado['precio'] = $oferta[0]['precio'];
        $cuarto = Cuarto::DatosCuartoid($oferta[0]['fk_cuarto']);
        $resultado['nombre_cuarto'] = $cuarto['nombre_cuarto'];
        $casa = Casa::DatosCasaid($cuarto['fk_casa']);
        $resultado['nombre_casa'] = $cuarto['nombre_casa'];
        $semestre = Cuarto::DatosSemestreid($oferta[0]['fk_semestre']);
        $resultado['nombre_semestre'] = $semestre[0]['nombre'];
    }else{
        $resultado = null;
    }
    
    echo json_encode($resultado); 

?>