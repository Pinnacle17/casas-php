<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT id_usuario, nombre_usuario, nombre_busqueda, estado FROM usuario");

    if(mysqli_num_rows($registros) > 0){
        $x = 0;
        while ($resultado = mysqli_fetch_array($registros)){
            $usuarios[$x]['id_usuario'] = $resultado['id_usuario'];
            $usuarios[$x]['nombre_usuario'] = $resultado['nombre_usuario'];
            $usuarios[$x]['nombre_busqueda'] = $resultado['nombre_busqueda'];
            $usuarios[$x]['estado'] = $resultado['estado'];
            $x++;
        }
    }else{
        $usuarios = null;
    }

    echo json_encode($usuarios);

?>