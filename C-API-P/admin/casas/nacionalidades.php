<?php
    require("../../headers.php");
    require("../../BD.php");
    $consulta = "SELECT usuario.nacionalidad, COUNT(usuario.nacionalidad) AS numero FROM compra JOIN usuario ON compra.fk_usuario=usuario.id_usuario GROUP BY usuario.nacionalidad ORDER BY numero";
    $resultado = BD::consultaSelect($consulta);
    if(mysqli_num_rows($resultado) > 0){
        while ($row = mysqli_fetch_row($resultado)) {
            $resultado["cantidad"] = $row[1];
            $resultado["nacionalidad"] = $row[0];
        }
    }else{
        $resultado = null;
    }
    echo json_encode($resultado);   
?>