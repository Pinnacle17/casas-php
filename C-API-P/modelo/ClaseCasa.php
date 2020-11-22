<?php

class Casa extends BD{

    public static function VerComentarios($id_casa, $estado){
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
        $consulta_select_casa = "SELECT id_casa, nombre_casa, dias_rentas, cantidad_rentas, fk_colonia FROM casa WHERE id_casa = '$id_casa'";
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
    public static function DatosColoniaid($id_colonia){
        $consulta_select_casa = "SELECT *FROM colonia WHERE id_colonia = '$id_colonia'";
        $resultado = BD::consultaSelect($consulta_select_casa);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                $colonia[] = $while;
            }
        }else{
            $colonia = null;
        }
        return $colonia;
    }
    public static function UpdateCalificacionCasa($id_casa){
       $consulta_select_calificaciones = "SELECT COUNT(*), SUM(limpieza), SUM(ambiente), SUM(instalaciones) FROM calificacion WHERE fk_casa = '$id_casa' AND estado = '1'";
        $resultado = BD::consultaSelect($consulta_select_calificaciones);
        if(mysqli_num_rows($resultado) > 0){
            $row = mysqli_fetch_row($resultado);
            if($row[0] > 0){
                $calificacion_instalaciones = $row[3] / $row[0];
                $calificacion_ambiente = $row[2] / $row[0];
                $calificacion_limpieza = $row[1] / $row[0];
                $consulta_update_casa = "UPDATE casa SET  limpieza_cal= '$calificacion_limpieza', ambiente_cal= '$calificacion_ambiente', instalaciones_cal= '$calificacion_instalaciones' WHERE id_casa = '$id_casa'";
                BD::consultaSelect($consulta_update_casa);
            }
        }
    }
    
}
?>