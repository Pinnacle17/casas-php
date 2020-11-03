<?php 
    require("../../../headers.php");
    require("../../../conexion.php");
    $conexion = conexion();
    $id_cuarto = mysqli_real_escape_string($conexion, $_POST['id_cuarto']);
    $id_semestre = mysqli_real_escape_string($conexion, $_POST['id_semestre']);
    $grupo = mysqli_real_escape_string($conexion, $_POST['grupo']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
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

    $consulta_select_id = "SELECT id_oferta FROM oferta ORDER BY id_oferta DESC LIMIT 1";

    $registros = mysqli_query($conexion, $consulta_select_id) or die (mysqli_error($conexion));

    while ($resultado = mysqli_fetch_array($registros)){
      $id_oferta = $resultado["id_oferta"];
    }
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
        $response->oferta = $id_oferta;
    }

    echo json_encode($response); 
?>