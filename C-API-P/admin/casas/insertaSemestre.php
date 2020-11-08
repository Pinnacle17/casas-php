<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
    $nombre = $_POST['nombre'];
    $consulta = "INSERT INTO semestre(nombre, inicio_semestre, fin_semestre) VALUES ('$nombre','$inicio','$fin')";
    $resultado = BD::consultaSelect($consulta);
    echo json_encode(true); 

?>