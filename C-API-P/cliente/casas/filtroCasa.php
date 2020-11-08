<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();

    $registros = mysqli_query($conexion, "SELECT *FROM casa WHERE ambiente=$_POST[tipo]");

    $casa = [];
    if(mysqli_num_rows($registros) > 0){
        while ($resultado = mysqli_fetch_array($registros)){
            $casa[] = $resultado;
        }
    }else{
        $casa = null;
    }
    
    $json = json_encode($casa);

    echo $json;

?>