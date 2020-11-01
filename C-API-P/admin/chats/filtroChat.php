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
            $oferta = Usuario::verOfertaid($chat[$x]['fk_oferta']);
            $cuarto = Cuarto::DatosCuartoid($oferta[0]['fk_cuarto']);
            $resultado[$x]['nombre_cuarto'] = $cuarto[0]['nombre_cuarto'];
            $casa = Casa::DatosCasaid($cuarto[0]['fk_casa']);
            $resultado[$x]['nombre_casa'] = $cuarto[0]['nombre_casa'];
            $semestre = Cuarto::DatosSemestreid($oferta[0]['fk_semestre']);
            $resultado[$x]['nombre_semestre'] = $semestre[0]['nombre'];
        }
    }else{
        $resultado = null;
    }
    echo json_encode($resultado); 

?>