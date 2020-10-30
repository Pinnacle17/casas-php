<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseUsuario.php");
    $conexion = conexion();

    $correo = mysqli_real_escape_string($conexion,$_POST['correo']);
    $contra = mysqli_real_escape_string($conexion,$_POST['contra']);

    class Result {}
    $response = new Result();

    $usuario = Usuario::Iniciodesesionadmin($correo, $contra);

    if($usuario['estado'] == 1){
        $response->id_usuario = $usuario['id_usuario'];
    }
    else{if($usuario['estado'] == -2){
            $response->mensaje = "El usuario que ingreso no se encuentra activo.";
            $response->estado = 0;
        }else if($usuario['estado'] == -1){     
            $response->mensaje = "El correo que trata de ingresar no está registrado.";
            $response->estado = 0;
        }
        else{
            $response->mensaje = "La contraseña que trata de ingresar no es correcta.";
            $response->estado = 0;
        }
    }
    echo json_encode($response);
?>