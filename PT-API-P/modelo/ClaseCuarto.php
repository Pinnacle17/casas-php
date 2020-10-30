<?php

class Cuarto extends BD{

    public static function VerCuartos($id_casa){
        $consulta_select_cuartos = "SELECT *FROM cuarto WHERE fk_casa = '$id_casa'";
        $resultado = BD::consultaSelect($consulta_select_cuartos);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $cuartos[] = $while;
            }
        }else{
            $cuartos = null;
        }
        return $cuartos;
    }
    public static function VerOfertaCuarto($id_cuarto, $id_semestre){
        $consulta_select_promocion = "SELECT *FROM oferta WHERE fk_cuarto = '$id_cuarto' AND fk_semestre = '$id_semestre'";
        $resultado = BD::consultaSelect($consulta_select_promocion);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                $promocion[] = $while;
            }
        }else{
            $promocion = null;
        }
        return $promocion;
    }           
    public static function VerCompraCuarto($id_oferta){
        $consulta_select_compra = "SELECT *FROM compra WHERE fk_oferta = '$id_oferta'";
        $resultado = BD::consultaSelect($consulta_select_compra);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                $promocion[] = $while;
            }
        }else{
            $promocion = null;
        }
        return $promocion;
    } 
    public static function DatosCuartoid($id_cuarto){
        $consulta_select_cuarto = "SELECT nombre_cuarto, fk_casa FROM cuarto WHERE id_cuarto = '$id_cuarto'";
        $resultado = BD::consultaSelect($consulta_select_cuarto);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                $cuarto['fk_casa'] = $while['fk_casa'];
                $cuarto['nombre_cuarto'] = $while['nombre_cuarto'];
            }
        }else{
            $cuarto = null;
        }
        return $cuarto;
    }
    public static function DatosSemestreid($id_semestre){
        $consulta_select_semestre = "SELECT nombre FROM semestre WHERE id_semestre = '$id_semestre'";
        $resultado = BD::consultaSelect($consulta_select_semestre);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                $semestre[] = $while;
            }
        }else{
            $semestre = null;
        }
        return $semestre;
    }
}
?>