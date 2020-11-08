<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    $id_oferta = $_GET[''];
    $grupo = $_GET[''];
    $precio = $_GET[''];
    $consulta = "UPDATE oferta SET precio = '$precio', grupo = '$grupo' WHERE id_oferta = '$id_oferta'";
    $registro = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
    echo json_encode($mensajes); 

?>