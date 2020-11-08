<?php
    require("../../../headers.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseChat.php");
    $inicio = $_POST[''];
    $fin = $_POST[''];
    $nombre = $_POST[''];
    $consulta = "INSERT INTO semestre(nombre, inicio_semestre, fin_semestre) VALUES ('$nombre','$inicio','$fin')";
    $resultado = BD::consultaSelect($consulta);
    echo json_encode($mensajes); 

?>