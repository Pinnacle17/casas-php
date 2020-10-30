<?php
    require("../../../headers.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");

    $id_chat = $_GET['id_chat'];
    $id_oferta = $_GET['fk_oferta'];
    $id_usuario = $_GET['id_usuario'];
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