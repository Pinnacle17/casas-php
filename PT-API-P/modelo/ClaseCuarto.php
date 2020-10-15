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
    
    
}
?>