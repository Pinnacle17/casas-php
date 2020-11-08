<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    $id_oferta = $_GET['id_oferta'];
    $id_usuario = $_GET['id_usuario'];
    $fecha = date("Y-m-d H:i:s"); 
    $consulta_insert_compra = "INSERT INTO compra(pago, fecha_compra, fk_oferta, fk_usuario) VALUES ('0', '$fecha','$id_oferta', '$id_usuario')";
    BD::consultaSelect($consulta_insert_compra);
    Chat::UpdateNotificacion($id_chat, 4);
    Usuario::modificarEstadoOferta($id_oferta, 0);
    Usuario::EstadoUsuario($id_usuario, 3);

?>