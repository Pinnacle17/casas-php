<?php
    require("../../headers.php");
    require("../../conexion.php");
//mostrara la informacion general del usuario
    $conexion = conexion();
    $registros = mysqli_query($conexion, "SELECT *FROM admin WHERE id_admin = $_GET[id]");
    $usuario = [];
    while ($resultado = mysqli_fetch_array($registros)){
        $usuario[] = $resultado;
    }
    //mostrar usuario
    $json = json_encode($usuario);
    echo $json;

?>