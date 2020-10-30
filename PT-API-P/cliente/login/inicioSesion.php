<?php
    require("../../headers.php");
    require("../../conexion.php");
    $conexion = conexion();
    //CACHA TODO TODOS LOS DATOS QUE FUERON ENVIADOS DESDE UNA PETICION HTTP
    $id_facebook = mysqli_real_escape_string($conexion,$_POST['id_facebook']);//id de facebook
    $foto = mysqli_real_escape_string($conexion,$_POST['foto']);//foto de facebook
    $nombre_usuario = mysqli_real_escape_string($conexion,$_POST['nombre_usuario']);//nombre que proporciona facebook

    $consulta_registro = "SELECT *FROM usuario WHERE id_facebook = '$id_facebook'";
    $resultado = mysqli_query($conexion,$consulta_registro) or die (mysqli_error($conexion));
    if(mysqli_num_rows($resultado) <= 0){
        //SENTENCIA SQL
        $nombre_busqueda = strtolower($nombre_usuario);
        $consulta_insert_usuario = "INSERT INTO usuario (id_facebook, foto, nombre_usuario, nombre_busqueda, estado) VALUES('$id_facebook','$foto','$nombre_usuario', '$nombre_busqueda', '0')";
        //EJECUTA LA SENTENCIA SQL
        mysqli_query($conexion,$consulta_insert_usuario) or die (mysqli_error($conexion));
    }

    $resultado_usuario = mysqli_query($conexion,$consulta_registro) or die (mysqli_error($conexion));

    if(mysqli_num_rows($resultado_usuario) > 0){
        while ($resultado = mysqli_fetch_array($resultado_usuario)){
            $usuario['id_usuario'] = $resultado['id_usuario'];
            $usuario['estado'] = $resultado['estado'];
        }
    }
    //si estado es igual a 0 se mostrara el formulario para termina el registro
    //si estado es igual a 1 se iniciara sesion de manera normal
    //si usuario es igual a 2 es porque esta en proceso de pago
    //si usuario es igual a 3, significa que esta bloqueado del sistema y no podra iniciar sesion
    class Result {}
    
    $response = new Result();
    
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
        $response->id_usuario = $usuario['id_usuario'];
        $response->estado = $usuario['estado'];
    }
  
    echo json_encode($response);
?>