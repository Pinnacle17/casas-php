<?php
    require("../headers.php");
    require("../conexion.php");
    $conexion = conexion();
    
    $busqueda = mysqli_real_escape_string($conexion, $_GET['nombre']);

    $consulta = "SELECT * FROM casa WHERE nombre_casa_busqueda LIKE '%$busqueda%'";
    $registros = mysqli_query($conexion, $consulta);
    
    if(mysqli_num_rows($registros) == 0){
        echo null; //si es null significa que no se cambio nada
    }else{
        $casa = [];
        $x = 0;
        while ($resultado = mysqli_fetch_array($registros)){
            $casa[$x]['id_casa'] = $resultado[$x]['id_casa'];
            $casa[$x]['nombre_casa'] = $resultado[$x]['nombre_casa'];
            $casa[$x]['estado_casa'] = $resultado[$x]['estado_casa'];
            $casa[$x]['orden_anuncio'] = $resultado[$x]['orden_anuncio'];
            if($casa[$x]['estado_casa'] == 1){
                $casa[$x]['estado_casa'] = "Activa";
            }else if($casa[$x]['estado_casa'] == 0){
                $carousel[$x]['estado_casa'] = "Inactiva";
            }
            $x++;
        }
        $json = json_encode($carousel);
        echo $json;
    }
    
?>