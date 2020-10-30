<?php
    require("../../headers.php");
    require("../../conexion.php");
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
            $casa[$x]['id_casa'] = $resultado['id_casa'];
            $casa[$x]['nombre_casa'] = $resultado['nombre_casa'];
            $casa[$x]['orden_anuncio'] = $resultado['orden_anuncio'];
            if($resultado['estado_casa'] == 1){
                $casa[$x]['estado_casa'] = "Activa";
            }else if($resultado['estado_casa'] == 0){
                $casa[$x]['estado_casa'] = "Inactiva";
            }
            $x++;
        }
        $json = json_encode($casa);
        echo $json;
    }
    
?>