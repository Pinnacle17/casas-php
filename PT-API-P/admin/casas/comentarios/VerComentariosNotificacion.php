<?php
    require("../../../headers.php");
    require("../../../BD.php");
    include_once("../../../modelo/ClaseCasa.php");

    $id_casa = $_GET['id_casa'];
    $comentarios = Casa::VerComentariosNotificacion($id_casa);
    echo json_encode($comentarios);
    //a los comentarios notificacion hay dos opciones, que se confirmen o  que se dejen de anunciar
?>