<?php 
    require("../../../headers.php");
    require("../../../conexion.php");
    $conexion = conexion();
    $id_cuarto = mysqli_real_escape_string($conexion, $_POST['id_cuarto']);
    $id_semestre = mysqli_real_escape_string($conexion, $_POST['id_semestre']);
    $grupo = mysqli_real_escape_string($conexion, $_POST['grupo']);
    $precio = mysqli_real_escape_string($conexion, $_POST['id_semestre']);
    $consulta_insert_oferta = "INSERT INTO oferta(
        precio, 
        grupo,
        estado,
        fk_cuarto,
        fk_semestre) VALUES(
        '$precio',  
        '$grupo',
        '1', 
        '$id_cuarto',
        '$id_semestre')";
      
        mysqli_query($conexion, $consulta_insert_oferta) or die (mysqli_error($conexion));
        class Result {}

    $response = new Result();

    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
    }

    echo json_encode($response); 
?>