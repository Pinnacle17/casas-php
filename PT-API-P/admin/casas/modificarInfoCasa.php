<?php
    require("../../headers.php");
    require("../../conexion.php"); 
    $conexion = conexion();
    //modifica la info de la casa, hay que revisar el orden para poder insertar bien el orden    
    $id_casa = mysqli_real_escape_string($conexion, $_POST['id_casa']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre_casa']);
    $tipo = mysqli_real_escape_string($conexion, $_POST['ambiente']);
    $orden = mysqli_real_escape_string($conexion, $_POST['orden_anuncio']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion_casa']);
    $nombrebusqueda = strtolower($nombre);

    $consulta = "UPDATE casa SET nombre_casa = '$nombre', orden_anuncio = '$orden', nombre_casa_busqueda = '$nombrebusqueda', tipo_evento = '$tipo', descripcion_casa = '$descripcion' WHERE id_casa = '$id_casa'";
    $registro = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));   

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