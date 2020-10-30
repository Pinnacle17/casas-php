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
        $resultado['id_chat'] = $chat['id_chat'];
        $resultado['fk_oferta'] = $chat['fk_oferta'];
        $oferta = Usuario::verOfertaid($chat['fk_oferta']);
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