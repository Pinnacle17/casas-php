<?php
    require("../../../headers.php");
    require("../../../conexion.php");

    $conexion = conexion();
    $id_usuario = $_GET['id_usuario'];
    $id_chat = $_GET['id_chat'];
    $consulta_select_chat = "SELECT *FROM chat WHERE id_chat='$id_chat' AND fk_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexion, $consulta_select_chat);
    if(mysqli_num_rows($resultado) > 0){
        $respuesta = true;
    }else{
        $respuesta = false;
    }
    
    echo json_encode($respuesta); 

?>