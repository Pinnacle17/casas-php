<?php
    require("../../headers.php");
    require("../../conexion.php");
    require("../../BD.php");
    require("../../modelo/ClaseCuarto.php");

    $conexion = conexion();
    $id_cuarto = mysqli_real_escape_string($conexion, $_GET['id_cuarto']);
    $consulta_select_promocion = "SELECT * FROM oferta WHERE fk_cuarto = '$id_cuarto' AND estado = '1'";
    $resultado = BD::consultaSelect($consulta_select_promocion);
    if(mysqli_num_rows($resultado) > 0){
        $x = 0;
        while ($while = mysqli_fetch_array($resultado)){

            $promocion[$x]['precio'] = $while['precio'];
            $promocion[$x]['grupo'] = $while['grupo'];
            $promocion[$x]['id_oferta'] = $while['id_oferta'];
            $semestre = Cuarto::DatosSemestreid($while['fk_semestre']);
            $promocion[$x]['semestre'] = $semestre[0]['nombre'];
        }
    }else{
        $promocion = null;
    }

    echo json_encode($promocion); 

?>