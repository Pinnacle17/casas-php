<?php
    require('../../vendor/autoload.php');
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCuarto.php");
    require("../../conexion.php");
    $conexion = conexion();
    $id_usuario = $_GET['id_usuario'];
    $token = $_GET['token'];
    $pago = Chat::DatosPagoEstado($id_usuario, 0);
    $id_compra = $pago[0]['id_compra']; 
    $oferta = Usuario::verOfertaid($pago[0]['fk_oferta']);
    $precio = $oferta[0]['precio'] * 100;
    $cuarto = Cuarto::DatosCuartoid($oferta[0]['fk_cuarto']);
    $semestre = Cuarto::DatosSemestreid($oferta[0]['fk_semestre']);

    $datos = "Cuarto: ".$cuarto['nombre_cuarto']." Semestre: ".$semestre[0]['nombre'];
    //$precio=1500
    $stripe = new \Stripe\StripeClient(
        'sk_test_51HjyTwEaCyOGAt8v8MO2ggbyPhvJ2c74N43uMoKJYnCD0IFP7qpORr8U6gPeD5oEZeDK6LIOV0E0gfsZY6zGcmsI005Yr5UDv0'
      );
      $respuesta = $stripe->charges->create([
        'amount' => $precio,
        'currency' => 'mxn',
        'source' => $token,
        'description' => $datos,
      ]);
      //echo json_encode($respuesta);

    if($respuesta->paid == true){
        
        $fecha = date("Y-m-d H:i:s");
        $consulta_update_compra = "UPDATE compra SET pago = '1', token = '$token', fecha_compra = '$fecha' WHERE id_compra = '$id_compra'";
        mysqli_query($conexion, $consulta_update_compra );
        Usuario::EstadoUsuario($id_usuario, 1);
        $dia = date("Y-m-d");
        $inicio_oferta = $semestre[0]['inicio_semestre'];
        $dia = new DateTime($dia);
        $inicio_oferta = new DateTime($inicio_oferta);
        $diferencia = $inicio_oferta->diff($dia);
        $casa = Casa::DatosCasaid($cuarto['fk_casa']);
        $id_casa = $casa[0]['id_casa'];
        $colonia = Casa::DatosColoniaid($casa[0]['fk_colonia']);
        $id_colonia = $colonia[0]['id_colonia'];
        $dias_renta_casa = $casa[0]['dias_rentas'] + $diferencia;
        $cantidad_rentas_casa = $casa[0]['cantidad_rentas'] + 1;
        $dias_renta_colonia = $colonia[0]['dias_rentas'] + $diferencia;
        $cantidad_rentas_colonia = $colonia[0]['cantidad_rentas'] + 1;
        $consulta_update_colonia = "UPDATE colonia SET dias_rentas = '$dias_renta_colonia', cantidad_rentas = '$cantidad_rentas_colonia' WHERE id_colonia = '$id_colonia'";
        mysqli_query($conexion, $consulta_update_colonia );
        $consulta_update_casa = "UPDATE casa SET dias_rentas = '$dias_renta_casa', cantidad_rentas = '$cantidad_rentas_casa' WHERE id_casa = '$id_casa'";
        mysqli_query($conexion, $consulta_update_casa );
        echo json_encode(true);
    }else{
        echo json_encode(false); 
    }

?>