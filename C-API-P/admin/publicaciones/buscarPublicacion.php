<?php
    require("../../headers.php");
    require("../../conexion.php");
    $conexion = conexion();

    $busqueda = mysqli_real_escape_string($conexion, $_GET['nombre_pub']);

    $consulta = "SELECT * FROM publicacion WHERE titulo_pub_busqueda LIKE '%$busqueda%'";
    $registros = mysqli_query($conexion, $consulta);

    if(mysqli_num_rows($registros) > 0){
        $publicaciones = [];
        while ($registro=mysqli_fetch_array($registros)) {
            $publicaciones[]=$registro;
        }
    }else{
        $publicaciones = null;
    }
    
        $json = json_encode($publicaciones);
        echo $json;
?>