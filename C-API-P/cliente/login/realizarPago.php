<?php
    require('../../vendor/autoload.php');
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCuarto.php");
    $id_usuario = $_GET['id_usuario'];
    $token = $_GET['token'];
    $pago = Chat::DatosPagoEstado($id_usuario, 0);
    $id_compra = $pago[0]['id_compra']; 
    $oferta = Usuario::verOfertaid($pago[0]['fk_oferta']);
    $precio = $oferta[0]['precio'];
    $cuarto = Cuarto::DatosCuartoid($oferta[0]['fk_cuarto']);
    $semestre = Cuarto::DatosSemestreid($oferta[0]['fk_semestre']);
    $datos = "Cuarto: ".$cuarto['nombre_cuarto']." Semestre: ".$semestre[0]['nombre'];
    $conexion = conexion();
    $stripe = new \Stripe\StripeClient(
        'pk_test_51HjyTwEaCyOGAt8vaArjUYevqjaDs0nwsMWE6jLReVYaOIcfEgdZhaTzjUOTWlsVDH3dcDXuhGw33JEEapMSPgyD00COwuwPKF'
      );
      $respuesta = $stripe->charges->create([
        'amount' => $precio*100,
        'currency' => 'mxn',
        'source' => $token,
        'description' => $datos,
      ]);
      
    if($respuesta.paid == true){
        $consulta = "UPDATE compra SET pago = '1' WHERE id_compra = '$id_compra'";
        mysqli_query($conexion, $consulta);
        Usuario::EstadoUsuario($id_usuario, 1);
        echo json_encode(true);      
    }else{
        echo json_encode(false); 
    }
    
?>