<?php

class Usuario extends BD{
    public static function DatosUsuarioid($id_usuario, $datos){
        $consulta_select_usuario = "SELECT *FROM usuario WHERE id_usuario = '$id_usuario'";
        $resultado = BD::consultaSelect($consulta_select_usuario);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                foreach($campo as $datos){
                    $usuario[$campo] = $while[$campo];
                }
            }
        }else{
            $usuario = null;
        }
        return $usuario;
    }        
}
?>


