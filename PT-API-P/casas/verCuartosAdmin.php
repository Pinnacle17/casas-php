<?php
    require("../headers.php");
    require("../BD.php");
    include_once("../modelo/ClaseCuarto.php");

    $id_casa = $_GET['id_casas'];
    $cuartos = Cuarto::VerCuartos($id_casa);
    //si cuartos en igual a null, significa que no hay cuartos en la casa
    //si estado_cuarto es igual a cero, se mostrara el boton activar cuarto, sino se mostrara el boton desactivar cuarto
    $json = json_encode($cuartos);

    echo $json;
?>