<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $conexion = conexion();
    //CACHA TODO TODOS LOS DATOS QUE FUERON ENVIADOS DESDE UNA PETICION HTTP
    $id_usuario = mysqli_real_escape_string($conexion,$_GET['id']);//id de facebook

    $consulta_registro = "SELECT *FROM chat WHERE fk_usuario = '$id_usuario' AND (notificacion = '1' OR notificacion = '3')";
    $resultado = BD::consultaSelect($consulta_registro);
    if(mysqli_num_rows($resultado) >= 1){
        while ($while = mysqli_fetch_array($resultado)){
            $chat = $while['id_chat'];
            $notificacion = $while['notificacion'];
        }
        if($notificacion == 3){
            Chat::UpdateNotificacion($chat, 4);
        }
    }else{
        $chat = -1;
    }

    class Result {}
    
    $response = new Result();
    
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
        $response->chat = $chat;
        
    }
  
    echo json_encode($response);
?>