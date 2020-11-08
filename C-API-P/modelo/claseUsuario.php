<?php

class Usuario extends BD{
    public static function DatosUsuarioid($id_usuario){
        $consulta_select_usuario = "SELECT foto, nombre_usuario, celular, celular_ext, nacionalidad FROM usuario WHERE id_usuario = '$id_usuario'";
        $resultado = BD::consultaSelect($consulta_select_usuario);
        if(mysqli_num_rows($resultado) == 1){
            while ($while = mysqli_fetch_array($resultado)){
                    $usuario[] = $while;
            }
        }else{
            $usuario = null;
        }
        return $usuario;
    }
        public static function Iniciodesesionadmin($correo, $contraseña){
        $response = [];
        $consulta = "SELECT *FROM admin WHERE correo = '$correo'";
        $resultado = BD::consultaSelect($consulta);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $id_usuario = $while['id_admin'];
                $contra = $while['contrasena'];
                $activo = $while['activo'];
            }
            if($activo == 0){
                $response['estado'] = -2;//significa que la cuenta ya no esta activa
                return $response; 
            }else if(password_verify($contraseña, $contra)){
                $response['id_admin'] = $id_usuario;
                $response['estado'] = 1;
                return $response;
            }else{
                $response['estado'] = 0;//contraseña incorrecta
                return $response;                
            }
        }else{
            $response['estado'] = -1;//no se encontro el correo
        
        }
        return $response;  
    }
    
    public static function verVentasUsuario($id_usuario){
        $consulta_select_compra = "SELECT *FROM compra WHERE fk_usuario = '$id_usuario'";
        $resultado = BD::consultaSelect($consulta_select_compra);
        if(mysqli_num_rows($resultado) > 0){
            $x = 0;
            while ($while = mysqli_fetch_array($resultado)){
                $rentas[$x]['id_compra'] = $while['id_compra'];
                $rentas[$x]['pago'] = $while['pago'];
                $rentas[$x]['fecha_compra'] = $while['fecha_compra'];
                $rentas[$x]['fk_oferta'] = $while['fk_oferta'];
                $rentas[$x]['fk_usuario'] = $while['fk_usuario'];
                $x++; 
            }
        }else{
            $rentas = null;
        }
        return $rentas;
    }
    public static function verOfertaid($id_oferta){
        $consulta_select_oferta = "SELECT *FROM oferta WHERE id_oferta = '$id_oferta'";
        $resultado = BD::consultaSelect($consulta_select_oferta);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $oferta[] = $while;
            }
        }else{
            $oferta = null;
        }
        return $oferta;
    }
    public static function EstadoUsuario($id_usuario, $estado){
        $consulta_update_usuario = "UPDATE usuario SET estado = '$estado' WHERE id_usuario = '$id_usuario'";
        BD::consultaSelect($consulta_update_usuario);
    }
    public static function modificarEstadoOferta($id_oferta, $estado){
        $consulta_update_usuario = "UPDATE oferta SET estado = '$estado' WHERE id_oferta = '$id_oferta'";
        BD::consultaSelect($consulta_update_usuario);
    }
        
}
?>


