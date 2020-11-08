<?php
    require("../../headers.php");
    require("../../BD.php");

    $consulta = "SELECT cantidad_rentas, dias_rentas, nombre_colonia FROM colonia";
    $resultado = BD::consultaSelect($consulta);
    if(mysqli_num_rows($resultado) > 0){
        $x = 0;
        while ($colonia = mysqli_fetch_array($resultado)) {
            if($colonia['cantidad_rentas'] > 0){
                $resultado[$x]["promedio"] = bcdiv($colonia["dias_rentas"], $colonia['cantidad_rentas'], 2);
            }else{
                $resultado[$x]["promedio"] = 0;
            }
            $resultado[$x]["nombre_colonia"] = $colonia["nombre_colonia"];
            $x++;
        }

    }else{
        $resultado = null;
    }
    echo json_encode($resultado);   
?>