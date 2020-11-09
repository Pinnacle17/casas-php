<?php
    require("../../headers.php");
    require("../../BD.php");

    $consulta = "SELECT cantidad_rentas, dias_rentas, nombre_casa, id_casa, orden_anuncio FROM casa";
    $resultado = BD::consultaSelect($consulta);
    if(mysqli_num_rows($resultado) > 0){
        $x = 0;
        while ($casa = mysqli_fetch_array($resultado)) {
            if($casa['cantidad_rentas'] > 0){
                $resultado1[$x]["promedio"] = bcdiv($casa["dias_rentas"], $casa['cantidad_rentas'], 2);
            }else{
                $resultado1[$x]["promedio"] = 0;
            }
            $resultado1[$x]["id_casa"] = $casa["id_casa"];
            $resultado1[$x]["nombre_casa"] = $casa["nombre_casa"];
            $resultado1[$x]["orden_anuncio"] = $casa["orden_anuncio"];
            $x++;
        }
    }else{
        $resultado = null;
    }
    echo json_encode($resultado1);   
?>