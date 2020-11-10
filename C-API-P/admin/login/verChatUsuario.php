<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $conexion = conexion();
    $id = mysqli_real_escape_string($conexion,$_GET['id_usuario']);
    $usuario = Chat::ChatsUsuario($id);
    echo json_encode($usuario);
?>