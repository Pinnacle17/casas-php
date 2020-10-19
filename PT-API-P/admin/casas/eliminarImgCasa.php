<?php
    require("../../headers.php");
    require("../../conexion.php"); 
    $conexion = conexion();
    $id_imagen_casa = mysqli_real_escape_string($conexion, $_POST['id_imagen_casa']);
    $consulta_img = "SELECT ruta_imagen_casa FROM imagen_casa WHERE id_imagen_casa = $id_imagen_casa";
    $registro = mysqli_query($conexion, $consulta_img) or die (mysqli_error($conexion));
    while ($resultado = mysqli_fetch_array($registro)){
        $ruta_imagen_casa = $resultado["ruta_imagen_casa"];
    }

    unlink("../../../admin/assets/img/casas/".$ruta_imagen_casa);

    $eliminar_img = "DELETE FROM imagen_casa WHERE  id_imagen_casa = $id_imagen_casa";
    $registro = mysqli_query($conexion, $eliminar_img) or die (mysqli_error($conexion));
    
    
    
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