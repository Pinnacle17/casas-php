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
    public static function Iniciodesesionadmin($correo, $contraseña){
        $consulta = "SELECT *FROM admin WHERE correo = '$correo'";
        $resultado = self::consultaSelect($consulta);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $id_usuario = $while['id_usuario'];
                $tipo_usuario = $while['tipo_usuario'];
                $contra = $while['contrasena'];
                $activo = $while['activo'];
            }
            if($activo == 0){
                $response = array();
                $response['estado'] = -2;//significa que la cuenta ya no esta activa
                return $response; 
            }else if(password_verify($contraseña, $contra)){
                $response = array();
                $response['id_admin'] = $id_usuario;
                return $response;
            }else{
                $response = array();
                $response['estado'] = 0;//contraseña incorrecta

                return $response;                
            }
        }else{
            $response = array();
            $response['estado'] = -1;//no se encontro el correo

            return $response;                
        }
    }
    public static function Chat_estado($estado, $datos){
        $consulta_select_chat = "SELECT *FROM chat WHERE estado_chat = '$estado'";
        $resultado = BD::consultaSelect($consulta_select_chat);
        if(mysqli_num_rows($resultado) > 0){
            $x = 0;
            while ($while = mysqli_fetch_array($resultado)){
                foreach($campo as $datos){
                    $chat[$x][$campo] = $while[$campo];
                }
                $x++;
            }
        }else{
            $chat = null;
        }
        return $chat;
    }         
}
?>


