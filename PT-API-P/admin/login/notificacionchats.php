<?php
require("../../headers.php");
require("../../conexion.php");
require("../../BD.php");
require("../../modelo/ClaseChat.php");
require("../../modelo/ClaseUsuario.php");
$conexion = conexion();

class Result {}
$response = new Result();
    $usuario = Chat::Chat_estado(2);
    if($usuario == null){
       //es null y no mostrara nada 
    }else{
        $cantidad_chats = count($usuario);
        for($x = 0; $x<$cantidad_chats; $x++){
            $nombre = Usuario::DatosUsuarioid($usuario['fk_usuario']);
            $usuario[$x]['nombre_usuario'] = $nombre['nombre_usuario'];
        }
    }
    $json = json_encode($usuario);

    echo $json;
?>