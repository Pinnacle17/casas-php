<?php
    require("../headers.php");
    require("../conexion.php");
    $conexion = conexion();

    $id = mysqli_real_escape_string($conexion,$_POST['id_usuario']);
    $celular =  mysqli_real_escape_string($conexion,$_POST['celular']);
    $celularext =  mysqli_real_escape_string($conexion,$_POST['celular_ext']);
    $nacimiento =  mysqli_real_escape_string($conexion,$_POST['fecha_nacimiento']);

    $consulta = "UPDATE usuario SET celular = '$celular', celular_ext = '$celularext', fecha_nacimiento = '$nacimiento', tipo_usuario = '1' WHERE id_facebook = '$id'";
    //EJECUTA LA SENTENCIA SQL
    mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));;

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