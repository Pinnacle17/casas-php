<?php
require("../../headers.php");
require("../../conexion.php");
require("../../BD.php");
require("../../modelo/ClaseCasa.php");
require("../../modelo/ClaseUsuario.php");
$conexion = conexion();

class Result {}
$response = new Result();
    $datos = ['fk_usuario'];
    $usuario = Casa::Chat_estado(2, $datos);
    if($usuario == null){
       //es null y no mostrara nada 
    }else{
        $cantidad_chats = count($usuario);
        for($x = 0; $x<$cantidad_chats; $x++){
            $datos = ['nombre_usuario'];
            $nombre = Usuario::DatosUsuarioid($usuario['fk_usuario'], $datos);
            $usuario[$x]['nombre_usuario'] = $nombre['nombre_usuario'];
        }
    }
    $json = json_encode($usuario);

    echo $json;
?>