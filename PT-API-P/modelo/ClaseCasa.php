<?php

class Casa extends BD{

    public static function VerComentariosNormales($id_casa){
        $consulta_select_comentario = "SELECT *FROM calificacion WHERE fk_casa = '$id_casa' AND estado = '1'";
        $resultado = BD::consultaSelect($consulta_select_comentario);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $comentarios[] = $while;
            }
        }else{
            $comentarios = null;
        }
        return $comentarios;
    }
    public static function VerComentariosNotificacion($id_casa){
        $consulta_select_comentario = "SELECT *FROM calificacion WHERE fk_casa = '$id_casa' AND estado = '2'";
        $resultado = BD::consultaSelect($consulta_select_comentario);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $comentarios[] = $while;
            }
        }else{
            $comentarios = null;
        }
        return $comentarios;
    }         
    
    
}
?>