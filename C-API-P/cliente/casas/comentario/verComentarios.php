<?php
require("../../../headers.php");
require("../../../conexion.php");

$conexion = conexion();
$consulta = "SELECT *FROM calificacion WHERE estado = '1' AND fk_casa = $_GET[id_casa]";
$registros = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($registros) > 0){
    $comentarios = [];
    while ($resultado = mysqli_fetch_array($registros)){
        $comentarios[] = $resultado;
    }
}else{
    $comentarios = null;
}


$json = json_encode($comentarios);

echo $json;

?>