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
        //no hay oferta, se puede crear una
    }else{
        $compra = Cuarto::VerCompraCuarto($oferta['fk_oferta']);
        if($compra == null){
            //hay oferta, pero no se ha tomado, se envia oferta, se activa el boton para eliminar la oferta
        }else{
            $datos = ['foto','nombre_usuario','celular','celular_ext'];
            $datos_compra_completos = Usuario::DatosUsuarioid($compra['fk_usuario'], $datos);
            if($compra['pago'] == 1){
                $datos_compra_completos['pago'] = "Pagado";
            }else{
                $datos_compra_completos['pago'] = "No se ha confirmado el pago";
            }
            $datos_compra_completos['fecha_compra'] = $compra['fecha_compra'];
            $datos_compra_completos['precio'] = $oferta['precio'];
            //se envia todo
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