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
    public static function DatosCasaid($id_casa, $datos){
        $consulta_select_casa = "SELECT *FROM casa WHERE id_casa = '$id_casa'";
        $resultado = BD::consultaSelect($consulta_select_casa);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                foreach($campo as $datos){
                    $casa[$campo] = $while[$campo];
                }
            }
        }else{
            $casa = null;
        }
        return $casa;
    }
    
}
?>