<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/claseUsuario.php");
    require("../../../modelo/clase.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM calificacion WHERE fk_casa =$_GET[id_casa] AND fk_usuario = $_GET[id_usuario]");

    if(mysqli_num_rows($registros) > 0){
        while ($resultado = mysqli_fetch_array($registros)){
            $comentario[] = $resultado;
        }
        $usuario = Usuario::DatosUsuarioid($comentario[0]['fk_usuario']);
        $comentario['fk_usuario'] = $usuario[0]['nombre_usuario'];
        $comentario['foto'] = $usuario[0]['foto'];
        echo json_encode($comentario);//no puede comentar y muestra el comentario
    }else{
        echo json_encode(null);//puede pasar al siguiente filtro
    }

?>