<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $id_fb = mysqli_real_escape_string($conexion,$_GET['id_fb']);
    
    $registros = mysqli_query($conexion, "SELECT * FROM usuario WHERE estado = 1 AND id_facebook = '$id_fb'");
    
    $usuario = []; 
    while ($resultado = mysqli_fetch_array($registros)){
        $usuario['nombre'] = $resultado['nombre_usuario'];
        $usuario['foto'] = $resultado['foto'];
        $usuario['correo'] = $resultado['correo'];
        $usuario['celular_ext'] = $resultado['celular_ext'];
        $usuario['celular'] = $resultado['celular'];
        $usuario['fecha_nacimiento'] = $resultado['fecha_nacimiento'];
    }

    $json = json_encode($usuario);

    echo $json;

?>