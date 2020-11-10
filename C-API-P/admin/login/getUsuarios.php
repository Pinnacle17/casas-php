<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT id_usuario, nombre_usuario, nombre_busqueda, estado FROM usuario");
    while ($resultado = mysqli_fetch_array($registros)){
        $usuarios[$x]['id_usuario'] = $resultado['id_usuario'];
        $usuarios[$x]['nombre_usuario'] = $resultado['nombre_usuario'];
        $usuarios[$x]['nombre_busqueda'] = $resultado['nombre_busqueda'];
        if($resultado['estado'] == 0){
            $usuarios[$x]['estado'] = "Falta Registro";
        }else if($resultado['estado'] == 1){
            $usuarios[$x]['estado'] = "Activo";
        }else if($resultado['estado'] == 2){
            $usuarios[$x]['estado'] = "Bloqueado";
        }else{
            $usuarios[$x]['estado'] = "Proceso de Pago";    
        }

        $x++;
    }

    $json = json_encode($usuarios);

    echo $json;

?>