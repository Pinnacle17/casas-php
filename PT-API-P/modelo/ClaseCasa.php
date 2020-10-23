<?php

class Casa extends BD{

    public static function VerComentariosNormales($id_casa, $estado){
        $consulta_select_comentario = "SELECT *FROM calificacion WHERE fk_casa = '$id_casa' AND estado = '$estado'";
        $resultado = BD::consultaSelect($consulta_select_comentario);
        if(mysqli_num_rows($resultado) > 0){
            $x = 0;
            while ($while = mysqli_fetch_array($resultado)){
                $comentarios[$x]['id_calificacion'] = $while['id_calificacion'];
                $comentarios[$x]['limpieza'] = $while['limpieza'];
                $comentarios[$x]['ambiente'] = $while['ambiente'];
                $comentarios[$x]['instalaciones'] = $while['instalaciones'];
                $comentarios[$x]['comentario'] = $while['comentario'];
                $comentarios[$x]['estado'] = $while['estado'];
                $comentarios[$x]['fk_usuario'] = $while['fk_usuario'];
                $comentarios[$x]['fk_casa'] = $while['fk_casa'];
                $x++;
            }
        }else{
            $comentarios = null;
        }
        return $comentarios;
    }         
    public static function DatosCasaid($id_casa){
        $consulta_select_casa = "SELECT nombre_casa FROM casa WHERE id_casa = '$id_casa'";
        $resultado = BD::consultaSelect($consulta_select_casa);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                $casa[] = $while;
            }
        }else{
            $casa = null;
        }
        return $casa;
    }
    
}
?>