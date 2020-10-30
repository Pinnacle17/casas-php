<?php
    require("../../../headers.php");
    require("../../../BD.php");
    require("../../../modelo/ClaseCasa.php");
    require("../../../modelo/ClaseUsuario.php");

    $id_casa = $_GET['id_casa'];
    $comentarios = Casa::VerComentarios($id_casa, 1); 
    if($comentarios != null){
        $numerocomentarios = count($comentarios);
        for($x = 0; $x < $numerocomentarios; $x++){
            $resultado[$x]['id_calificacion'] = $comentarios[$x]['id_calificacion'];
            $resultado[$x]['limpieza'] = $comentarios[$x]['limpieza'];
            $resultado[$x]['ambiente'] = $comentarios[$x]['ambiente'];
            $resultado[$x]['instalaciones'] = $comentarios[$x]['instalaciones'];
            $resultado[$x]['comentario'] = $comentarios[$x]['comentario'];
            $resultado[$x]['fk_usuario'] = $comentarios[$x]['fk_usuario'];
            $usuario = DatosUsuarioid($resultado[$x]['fk_usuario']);
            $resultado[$x]['nombre_usuario'] = $usuario['nombre_usuario'];

        }
    }else{
        $resultado = null;//no se encontro nada
    }
    echo json_encode($resultado);
    //a los comentarios notificacion hay dos opciones, que se confirmen o  que se dejen de anunciar
?>