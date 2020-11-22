<?php
    require("../../../headers.php");
    require("../../../BD.php");
    require("../../../conexion.php");
    require("../../../modelo/ClaseCasa.php");
    $conexion = conexion();
    
    $id_usuario = $_GET['id_usuario'];
    $id_casa = $_GET['id_casa'];

    $comentario = mysqli_real_escape_string($conexion, $_GET['comentario']);
    $cal_instalaciones = mysqli_real_escape_string($conexion, $_GET['instalacion']);
    $cal_limpieza = mysqli_real_escape_string($conexion, $_GET['limpieza']);
    $cal_ambiente = mysqli_real_escape_string($conexion, $_GET['ambiente']);
    if(($cal_instalaciones <= 6) || ($cal_limpieza <= 6) || ($cal_ambiente <= 6)){
        $estado = 2;
    }else{
        $estado = 1;
    }
    $insertar_comentario = "INSERT INTO calificacion(limpieza, ambiente, instalaciones, comentario, estado, fk_usuario, fk_casa) VALUES ('$cal_limpieza', '$cal_ambiente', '$cal_instalaciones', '$comentario', '$estado', '$id_usuario', '$id_casa')";
    BD::consultaSelect($insertar_comentario);
    if($estado == 1){
        Casa::UpdateCalificacionCasa($id_casa);
    }
    
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