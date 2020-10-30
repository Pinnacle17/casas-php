<?php
    require("../../../headers.php");
    require("../../../conexion.php");

    $conexion = conexion();
    $id_usuario = $_GET['id_usuario'];
    $consulta_ver_chat = "SELECT id_chat FROM chat WHERE estado_chat = '1' AND fk_usuario = '$id_usuario'";
    $registro_chat = mysqli_query($conexion, $consulta_ver_chat);
    if(mysqli_num_rows($registro_chat) > 0){
        while ($resultadochat = mysqli_fetch_array($registro_chat)){
            $id_chat = $resultadochat['id_chat'];
        }
        echo json_encode($id_chat);//redirige a el chat seleccionado
    }else{
        echo json_encode(null);//debes de crear un nuevo chat
    }
    
?>