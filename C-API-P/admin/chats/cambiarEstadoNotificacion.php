<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");

    $id_chat = $_GET['id_chat'];
    $consulta_estado_chat = "SELECT id_chat FROM chat WHERE notificacion = '2' AND id_chat = '$id_chat'";
    $registro_chat = BD::consultaSelect($consulta_estado_chat);
    if(mysqli_num_rows($registro_chat) > 0){
        Chat::UpdateEstadoNotificacion($id_chat, 4);
    }
    
    class Result {}

    $response = new Result();
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
    }
    
    echo json_encode($response); 

?>