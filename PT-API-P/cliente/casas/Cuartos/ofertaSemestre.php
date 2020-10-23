<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseCuarto.php");
    $conexion = conexion();
    $id_cuarto = mysqli_real_escape_string($conexion, $_POST['id_cuarto']);
    $id_semestre = mysqli_real_escape_string($conexion, $_POST['id_semestre']);
    class Result {}

    $response = new Result();
    $oferta = Cuarto::VerOfertaCuarto($id_cuarto, $id_semestre);
    if($oferta == null){
        //no hay oferta, se muestra el mensaje de que no hay ofertas disponibles
    }else{
        $compra = Cuarto::VerCompraCuarto($oferta['fk_oferta']);
        if($compra == null){
            //hay oferta, pero no se ha vendido, por lo que se pude preguntar por esta, se manda la variable oferta para mostrar los datos ded esta
        }else{
            $datos_compra_completos = Usuario::DatosUsuarioid($compra['fk_usuario']);
            //solo foto y nombrede usuario se van a mostrar
            //ademas de mostrar este mensaje, se mostrara el mensaje de que este usuario rento esta habitacion para el semestre seleccionado
        }
    }

  if(mysqli_error($conexion)){
      $response->resultado = 'ERROR';
  }
  else{
      $response->resultado = 'OK';
  }

  echo json_encode($response); 

?>