<?php
    require("../headers.php");
    require("../BD.php");
    include_once("../modelo/ClaseCasa.php");
    include_once("../modelo/ClaseUsuario.php");

    $id_casa = $_GET['id'];

    $comentarios = Casa::VerComentariosNormales($id_casa);
    echo json_encode($comentarios);
    //se mostrara la opcion de desactivar comentario
    //ve todos los comentarios permitidos
?>