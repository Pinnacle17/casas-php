<?php
    require("../../../headers.php");
    require("../../../conexion.php"); 
    $conexion = conexion();
    //modifica la info de la casa, hay que revisar el orden para poder insertar bien el orden    
    $id_cuarto = mysqli_real_escape_string($conexion, $_POST['id_cuarto']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre_cuarto']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion_cuarto']);

    $consulta = "UPDATE cuarto SET nombre_cuarto = '$nombre', descripcion_cuarto = '$descripcion' WHERE id_cuarto = '$id_cuarto'";
    $registro = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));   

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