<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    $conexion = conexion();
    $id_oferta = $_POST['id_oferta'];
    $grupo = $_POST['grupo'];
    $precio = $_POST['precio'];
    $consulta = "UPDATE oferta SET precio = '$precio', grupo = '$grupo' WHERE id_oferta = '$id_oferta'";
    $registro = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
    echo json_encode(true); 

?>