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
    
}
?>