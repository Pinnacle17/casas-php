<?php
    require("../headers.php");
    require("../conexion.php");
    $conexion = conexion();
    
    $busqueda = mysqli_real_escape_string($conexion, $_GET['nombre_evento']);

    $consulta = "SELECT * FROM evento WHERE nombre_evento_busqueda LIKE '%$busqueda%'";
    $registros = mysqli_query($conexion, $consulta);
    
    if(mysqli_num_rows($registros) == 0){
        echo null; 
    }else{
        $carousel = [];
        $x = 0;
        while ($resultado = mysqli_fetch_array($registros)){
            $carousel[$x]['id_casa'] = $resultado[$x]['id_casa'];
            $carousel[$x]['nombre_casa'] = $resultado[$x]['nombre_casa'];
            $carousel[$x]['estado_casa'] = $resultado[$x]['estado_casa'];
            $carousel[$x]['orden_anuncio'] = $resultado[$x]['orden_anuncio'];
            if($carousel[$x]['estado_casa'] == 1){
                $carousel[$x]['estado_casa'] = "Activa";
            }else if($carousel[$x]['estado_casa'] == 0){
                $carousel[$x]['estado_casa'] = "Inactiva";
            }
            $x++;
        }
        $json = json_encode($carousel);
        echo $json;
    }
    
?>