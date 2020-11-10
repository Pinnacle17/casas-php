<?php
    require("../../headers.php");
    require("../../conexion.php"); 
    $conexion = conexion();
    $id_casa = mysqli_real_escape_string($conexion, $_POST['id_casa']);
    
    if(!empty($_FILES['imgs'])){
        $numimg = count($_FILES['imgs']["name"]);
        $consulta_select_imgs = "SELECT *FROM imagen_casa WHERE fk_casa = '$id_casa'";
        $resultado = mysqli_query($conexion, $consulta_select_imgs) or die(mysqli_error($conexion));
        $numimagenes = mysqli_num_rows($resultado);
        $total = $numimagenes + $numimg - 30;
        if($total > 0){
            $mensaje = "Se excede por ".$total." imagenes generales";
        }else{
            $mensaje = true;  
        }
    }else{
        $mensaje = true;   
    }
    class Result {}

    $response = new Result();
    $response->resultado = $mensaje;
  
    echo json_encode($response);
?>