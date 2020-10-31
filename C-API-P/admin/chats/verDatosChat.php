<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCasa.php");
    require("../../modelo/ClaseCuarto.php");
    $id_chat = $_GET['id_chat'];
    $chat = Chat::ChatId($id_chat);
    if($chat != null){
        if($chat['estado_chat'] == 1){
            $resultado['estado_chat'] = "Activo";
        }else if($chat['estado_chat'] == 2){
            $resultado['estado_chat'] = "Terminado por el usuario";
        }else if($chat['estado_chat'] == 3){
            $resultado['estado_chat'] = "Terminado por el administrador";
        }
        $resultado['fk_oferta'] = $chat['fk_oferta'];
        $oferta = Usuario::verOfertaid($chat['fk_oferta']);
        $resultado['precio'] = $oferta['precio'];
        $cuarto = Cuarto::DatosCuartoid($oferta['fk_cuarto']);
        $resultado['nombre_cuarto'] = $cuarto['nombre_cuarto'];
        $casa = Casa::DatosCasaid($cuarto['fk_casa']);
        $resultado['nombre_casa'] = $cuarto['nombre_casa'];
        $semestre = Cuarto::DatosSemestreid($oferta['fk_semestre']);
        $resultado['nombre_semestre'] = $semestre['nombre'];
    }else{
        $resultado = null;
    }
    
    echo json_encode($resultado); 

?>