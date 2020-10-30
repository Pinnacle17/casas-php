<?php
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCasa.php");
    require("../../modelo/ClaseCuarto.php");
    $id_usuario = $_GET['id_usuario'];
    $pago = Chat::DatosPagoEstado($id_usuario, 0);
    $resultado['fk_oferta'] = $pago[0]['fk_oferta'];
    $oferta = Usuario::verOfertaid($pago[0]['fk_oferta']);
    $resultado['precio'] = $oferta['precio'];
    $cuarto = Cuarto::DatosCuartoid($oferta['fk_cuarto']);
    $resultado['nombre_cuarto'] = $cuarto['nombre_cuarto'];
    $casa = Casa::DatosCasaid($cuarto['fk_casa']);
    $resultado['nombre_casa'] = $cuarto['nombre_casa'];
    $semestre = Cuarto::DatosSemestreid($oferta['fk_semestre']);
    $resultado['nombre_semestre'] = $semestre['nombre'];
    echo json_encode($resultado); 

?>