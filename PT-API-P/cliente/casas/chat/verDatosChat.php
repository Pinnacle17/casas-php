<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");
    require("../../../modelo/ClaseUsuario.php");
    require("../../../modelo/ClaseCasa.php");
    require("../../../modelo/ClaseCuarto.php");

    $conexion = conexion();
    $id_chat = $_GET['id_chat'];
    $chat = Chat::ChatId($id_chat);
    if($chats != null){
        $resultado['estado_chat'] = $chat['estado_chat'];//si es igual a 2, bloquea las funciones del chat
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