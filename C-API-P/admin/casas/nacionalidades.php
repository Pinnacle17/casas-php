<?php
    require("../../headers.php");
    require("../../BD.php");
    $consulta = "SELECT usuario.nacionalidad, COUNT(usuario.nacionalidad) AS numero FROM compra JOIN usuario ON compra.fk_usuario=usuario.id_usuario GROUP BY usuario.nacionalidad ORDER BY numero DESC";
    $resultado = BD::consultaSelect($consulta);
    if(mysqli_num_rows($resultado) > 0){
        $x=0;
        while ($row = mysqli_fetch_array($resultado)) {
            $resultado1[$x]["cantidad"] = $row[1];
            $resultado1[$x]["nacionalidad"] = $row[0];
            $x++;
        }
    }else{
        $resultado = null;
    }
    echo json_encode($resultado1);   
?>