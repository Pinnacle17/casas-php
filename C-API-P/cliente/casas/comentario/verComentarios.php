<?php
require("../../headers.php");
require("../../conexion.php");

$conexion = conexion();
$consulta = "SELECT *FROM calificacion WHERE estado = '1' AND fk_casa = $_GET[id_casa]";
$registros = mysqli_query($conexion, $consulta);

$comentarios = [];

while ($resultado = mysqli_fetch_array($registros)){
    $comentarios[] = $resultado;
}

$json = json_encode($comentarios);

echo $json;

?>