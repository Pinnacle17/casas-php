<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $id_semestre = $_GET['id_semestre'];
    $consulta = "SELECT FROM oferta WHERE fk_semestre = '$id_semestre'";
    $resultado = BD::consultaSelect($consulta);
    if(mysqli_num_rows($resultado) > 0){
        $respuesta = false;
    }else{
        $consulta2 = "DELETE FROM semestre WHERE id_semestre = '$id_semestre'";
        $resultado2 = BD::consultaSelect($consulta2);
        $respuesta = true;
    }
    echo json_encode($respuesta); 
?>