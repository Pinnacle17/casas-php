<?php
    require("../../../headers.php");
    require("../../../conexion.php");

    $conexion = conexion();
    
    $registros = mysqli_query($conexion, "DELETE FROM calificacion WHERE id_calificacion = $_GET[id_calificacion]") or die($conexion);

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