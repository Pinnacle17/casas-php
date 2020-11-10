<?php
    require("../../headers.php");
    require("../../conexion.php"); 
    $conexion = conexion();
    $id_publicacion = mysqli_real_escape_string($conexion, $_GET['id_publicacion']);
    $consulta_select_imgs = "SELECT *FROM imagen_pub WHERE fk_publicacion = '$id_publicacion'";
    $resultado = mysqli_query($conexion, $consulta_select_imgs) or die(mysqli_error($conexion));
    $numimagenes = mysqli_num_rows($resultado);
    $total = $numimagenes - 1;
    if($total < 1){
        $mensaje = "No se pueden eliminar la imagen, debe de haber minimo 1";
    }else{
        $mensaje = true;   
    }
    class Result {}

    $response = new Result();
    $response->resultado = $mensaje;
  
    echo json_encode($response);
?>