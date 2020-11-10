<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $id = mysqli_real_escape_string($conexion,$_GET['id_usuario']);
    
    $registros = mysqli_query($conexion, "SELECT *FROM usuario WHERE id_usuario = '$id'");
    
    $usuario = []; 
    while ($resultado = mysqli_fetch_array($registros)){
        $usuario['nombre'] = $resultado['nombre_usuario'];
        $usuario['foto'] = $resultado['foto'];
        $usuario['correo'] = $resultado['correo'];
        $usuario['celular_ext'] = $resultado['celular_ext'];
        $usuario['celular'] = $resultado['celular'];
        $usuario['fecha_nacimiento'] = $resultado['fecha_nacimiento'];
        $usuario['nacionalidad'] = $resultado['nacionalidad'];
    }

    $json = json_encode($usuario);

    echo $json;

?>