<?php
    require("../../headers.php");
    require("../../BD.php");

    $consulta = "SELECT cantidad_rentas, dias_rentas, nombre_casa, id_casa FROM casa";
    $resultado = BD::consultaSelect($consulta);
    if(mysqli_num_rows($resultado) > 0){
        $x = 0;
        while ($casa = mysqli_fetch_array($resultado)) {
            if($casa['cantidad_rentas'] > 0){
                $resultado[$x]["promedio"] = bcdiv($casa["dias_rentas"], $casa['cantidad_rentas'], 2);
            }else{
                $resultado[$x]["promedio"] = 0;
            }
            $resultado[$x]["id_casa"] = $casa["id_casa"];
            $resultado[$x]["nombre_casa"] = $casa["nombre_casa"];
            $x++;
        }
    }else{
        $resultado = null;
    }
    echo json_encode($resultado);   
?>