<?php
// This example sets up an endpoint using the Slim framework.
// Watch this video to get started: https://youtu.be/sGcNPFX1Ph4.
    use Slim\Http\Request;
    use Slim\Http\Response;
    use Stripe\Stripe;
    require 'vendor/autoload.php';
    require("../../headers.php");
    require("../../BD.php");
    require("../../modelo/ClaseChat.php");
    require("../../modelo/ClaseUsuario.php");
    require("../../modelo/ClaseCasa.php");
    require("../../modelo/ClaseCuarto.php");
    $id_usuario = $_GET['id_usuario'];
    $pago = Chat::DatosPagoEstado($id_usuario, 0);
    $id_compra = $pago[0]['id_compra']; 
    $oferta = Usuario::verOfertaid($pago[0]['fk_oferta']);
    $precio = $oferta[0]['precio'];
    $cuarto = Cuarto::DatosCuartoid($oferta[0]['fk_cuarto']);
    $semestre = Cuarto::DatosSemestreid($oferta[0]['fk_semestre']);
    $datos = "Cuarto: ".$cuarto['nombre_cuarto']." Semestre: ".$semestre[0]['nombre'];




$app = new \Slim\App;

$app->add(function ($request, $response, $next) {
  // Set your secret key. Remember to switch to your live secret key in production!
  // See your keys here: https://dashboard.stripe.com/account/apikeys
  \Stripe\Stripe::setApiKey('pk_test_51HjyTwEaCyOGAt8vaArjUYevqjaDs0nwsMWE6jLReVYaOIcfEgdZhaTzjUOTWlsVDH3dcDXuhGw33JEEapMSPgyD00COwuwPKF');

  return $next($request, $response);
});

$app->post('/create-checkout-session', function (Request $request, Response $response) {
  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'mxn',
        'product_data' => [
          'name' => $datos,
        ],
        'unit_amount' => $precio,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://example.com/success',
    'cancel_url' => 'https://example.com/cancel',
    "metadata" => ["id_compra" => $id_compra],
  ]);

  return $response->withJson([ 'id' => $session->id ])->withStatus(200);
});

$app->run();