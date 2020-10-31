<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $conexion = conexion();
    //CACHA TODO TODOS LOS DATOS QUE FUERON ENVIADOS DESDE UNA PETICION HTTP
    $id_usuario = mysqli_real_escape_string($conexion,$_GET['id']);//id de facebook

    $consulta_chat = "SELECT *FROM chat WHERE fk_usuario = '$id_usuario' AND estado_chat = '3'";
    $resultado = BD::consultaSelect($consulta_registro);
    while ($while = mysqli_fetch_array($resultado)){
        $chat = $while['id_chat'];
    }
    $consulta_mensanje = "SELECT *FROM mensaje WHERE fk_chat = '$chat' ORDER BY id_mensaje DESC LIMIT 1";
    $resultado2 = BD::consultaSelect($consulta_mensaje);
    while ($while2 = mysqli_fetch_array($resultado)){
        $mensaje = $while2['mensaje'];
    }
    class Result {}
    
    $response = new Result();
    
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
        $response->mensaje = $mensaje;
    }
  
    echo json_encode($response);
?>