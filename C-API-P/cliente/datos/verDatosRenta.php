<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCasa.php");
    require("../../modelo/ClaseCuarto.php");

    $id_usuario = $_GET['id_usuario'];

    $rentas = Usuario::verRentasUsuario($id_usuario);
    if($rentas != null){

        $numerorentas = count($rentas);
        for($x = 0; $x<$numerorentas; $x++){
            $resultado[$x]['id_compra'] = $rentas[$x]['id_compra'];
            $resultado[$x]['fecha_compra'] = $rentas[$x]['fecha_compra'];
            $pago = $rentas[$x]['pago'];
            if($pago == 1){
                $resultado[$x]['pago'] = "Pagado";
            }else{
                $resultado[$x]['pago'] = "Pendiente de pago";
            }
            $oferta = Usuario::verOfertaid($rentas[$x]['fk_oferta']);
            $resultado[$x]['precio'] = $oferta[$x]['precio'];
            $resultado[$x]['grupo'] = $oferta[$x]['grupo'];
            $cuarto = Cuarto::DatosCuartoid($oferta[$x]['fk_cuarto']);
            $resultado[$x]['nombre_cuarto'] = $cuarto['nombre_cuarto'];
            $casa = Casa::DatosCasaid($cuarto['fk_casa']);
            $resultado[$x]['nombre_casa'] = $casa['nombre_casa'];
        }
        echo json_encode($resultado);
    }else{
        echo json_encode(null);//significa que no hay rentas realizadas
    }

?>