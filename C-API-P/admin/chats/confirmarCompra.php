<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");

    $id_chat = $_POST['id_chat'];
    $id_oferta = $_POST['fk_oferta'];
    $id_usuario = $_POST['id_usuario'];
    
    $consulta_oferta_chat = "SELECT id_chat FROM chat WHERE fk_oferta = '$id_oferta'";
    $registro_oferta = BD::consultaSelect($consulta_oferta_chat);
    if(mysqli_num_rows($registro_oferta) > 1){
        while($chat = mysqli_fetch_array($registro_oferta)){
            $mensaje = "La oferta por la que se pregunto ya fue tomada, lamentamos las moletias.";       
            Chat::InsertarMensaje($chat['id_chat'], $mensaje, 1);
            Chat::UpdateEstadoChat($chat['id_chat'], 3);
            Chat::UpdateNotificacion($chat['id_chat'], 3);
        }
    }

    $fecha = date("Y-m-d H:i:s"); 
    $consulta_insert_compra = "INSERT INTO compra(pago, fecha_compra, fk_oferta, fk_usuario) VALUES ('0', $fecha, $id_oferta, $id_usuario)";
    BD::consultaSelect($consulta_insert_compra);
    Chat::UpdateEstadoChat($id_chat, 4);
    Chat::UpdateNotificacion($id_chat, 4);
    Usuario::EstadoUsuario($id_usuario, 3);
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