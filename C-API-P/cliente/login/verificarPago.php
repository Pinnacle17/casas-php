<?php
    require("../../headers.php");
    require("../../conexion.php");

    $conexion = conexion();
    $payload = @file_get_contents('php://input');
    $event = null;

    try {
        $event = \Stripe\Event::constructFrom(
            json_decode($payload, true)
        );
    } catch(\UnexpectedValueException $e) {
        http_response_code(400);
        exit();
    }

    // Handle the event
    switch ($event->type) {
        case 'payment_intent.succeeded':
            $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
            // Then define and call a method to handle the successful payment intent.
            // handlePaymentIntentSucceeded($paymentIntent);
            $id_compra = 1;
            //
            $consulta = "UPDATE compra SET pago = '1' WHERE id_compra = '$id_compra'";
            $registros = mysqli_query($conexion, $consulta);

            break;
        case 'payment_method.attached':
            $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
            // Then define and call a method to handle the successful attachment of a PaymentMethod.
            // handlePaymentMethodAttached($paymentMethod);
            break;
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->type;
    }

    http_response_code(200);

?>



