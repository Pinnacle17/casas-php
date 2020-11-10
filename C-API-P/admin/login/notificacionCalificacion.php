<?php
require("../../headers.php");
require("../../conexion.php");
require("../../BD.php");
require("../../modelo/ClaseCasa.php");
$conexion = conexion();

class Result {}
$response = new Result();
    $consulta_notificaciones = "SELECT *FROM calificacion WHERE estado = '2' GROUP BY fk_casa";
    $resultado_notificaciones = BD::consultaSelect($consulta_notificaciones);
    if(mysqli_num_rows($resultado_notificaciones) > 0){
        $x = 0;
        while ($while = mysqli_fetch_array($resultado)){
            $casas[$x]['fk_casa'] = $while['fk_casa'];
            $casa = Casa::DatosCasaid($while['fk_casa']);
            $casas[$x]['nombre_casa'] = $casa[0]['nombre_casa'];
            $x++;
        }
    }else{
        $casas = null;//no hay notificaciones, por lo tanto no se mostrara ningun mensaje
    }
    $json = json_encode($casas);

    echo $json;
    
?>