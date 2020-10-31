<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseCuarto.php");
    $conexion = conexion();
    $id_cuarto = mysqli_real_escape_string($conexion, $_GET['id_cuarto']);
    $id_semestre = mysqli_real_escape_string($conexion, $_GET['id_semestre']);
    $datos_compra_completos = [];
    $oferta = Cuarto::VerOfertaCuarto($id_cuarto, $id_semestre);
    
    if($oferta == null){
        $datos_compra_completos['tipo'] = 0;
    }else{
        $compra = Cuarto::VerCompraCuarto($oferta['fk_oferta']);
        if($compra == null){
            $datos_compra_completos['tipo'] = 1;
            $datos_compra_completos['grupo'] = $oferta['grupo'];
            $datos_compra_completos['precio'] = $oferta['precio'];
        }else{
            $usuario = Usuario::DatosUsuarioid($compra['fk_usuario']);
            if($compra['pago'] == 1){
                $datos_compra_completos['pago'] = "Pagado";
            }else{
                $datos_compra_completos['pago'] = "No se ha confirmado el pago";
            }
            $datos_compra_completos['fk_usuario'] = $compra['fk_usuario'];
            $datos_compra_completos['foto'] = $usuario['foto'];
            $datos_compra_completos['nombre_usuario'] = $usuario['nombre_usuario'];
            $datos_compra_completos['celular'] = $usuario['celular'];
            $datos_compra_completos['celular_ext'] = $usuario['celular_ext'];
            $datos_compra_completos['fecha_compra'] = $compra['fecha_compra'];
            $datos_compra_completos['tipo'] = 2;
        }
    }

  echo json_encode($datos_compra_completos); 

?>