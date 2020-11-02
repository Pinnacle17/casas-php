<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseCuarto.php");
    require("../../../modelo/ClaseUsuario.php");
    $conexion = conexion();
    $id_cuarto = mysqli_real_escape_string($conexion, $_GET['id_cuarto']);
    $id_semestre = mysqli_real_escape_string($conexion, $_GET['id_semestre']);
    $datos_compra_completos = [];
    $oferta=[];
    $compra=[];
    $usuario=[];
    $oferta = Cuarto::VerOfertaCuarto($id_cuarto, $id_semestre);
    
    if($oferta == null){
        $datos_compra_completos['tipo'] = 0;
    }else{
        $compra = Cuarto::VerCompraCuarto($oferta[0]['id_oferta']);
        $datos_compra_completos['precio'] = $oferta[0]['precio'];
        $datos_compra_completos['fk_oferta'] = $oferta[0]['id_oferta'];
        if($compra == null){
            $datos_compra_completos['tipo'] = 1;
        }else{
            $usuario = Usuario::DatosUsuarioid($compra[0]['fk_usuario']);
            if($compra[0]['pago'] == 1){
                $datos_compra_completos['pago'] = "Pagado";
            }else{
                $datos_compra_completos['pago'] = "No se ha confirmado el pago";
            }
            $datos_compra_completos['foto'] = $usuario[0]['foto'];
            $datos_compra_completos['nombre_usuario'] = $usuario[0]['nombre_usuario'];
            $datos_compra_completos['tipo'] = 2;
        }
    }

  echo json_encode($datos_compra_completos); 

?>