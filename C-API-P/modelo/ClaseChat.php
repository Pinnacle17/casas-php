<?php

class Chat extends BD{

    public static function InsertarMensaje($id_chat, $mensaje, $usuario){
        $fecha = date("Y-m-d H:i:s"); 
        $consulta_insert_mensaje = "INSERT INTO mensaje(mensaje, fecha, usuario, fk_chat) VALUES ('$mensaje', '$fecha', '$usuario', '$id_chat')";
        $resultado = BD::consultaSelect($consulta_insert_mensaje);
        return $resultado;
    }
    public static function UpdateEstadoChat($id_chat, $estado){ 
        $consulta_update_chat = "UPDATE chat SET estado_chat = '$estado' WHERE id_chat = '$id_chat'";
        $resultado = BD::consultaSelect($consulta_update_chat);
        return $resultado;
    }
    public static function Chat_estado($estado){
        $consulta_select_chat = "SELECT fk_usuario FROM chat WHERE estado_chat = '$estado'";
        $resultado = BD::consultaSelect($consulta_select_chat);
        if(mysqli_num_rows($resultado) > 0){
            $x = 0;
            while ($while = mysqli_fetch_array($resultado)){
                $chat[$x]['fk_usuario'] = $while['fk_usuario'];
                $x++;
            }
        }else{
            $chat = null;
        }
        return $chat;
    }
    public static function ChatsUsuario($id_usuario){
        $consulta_select_chats = "SELECT *FROM chat WHERE fk_usuario = '$id_usuario'";
        $resultado = BD::consultaSelect($consulta_select_chats);
        if(mysqli_num_rows($resultado) > 0){
            $x = 0;
            while ($while = mysqli_fetch_array($resultado)){
                $chats[$x]['estado_chat'] = $while['estado_chat'];
                $chats[$x]['creacion_chat'] = $while['creacion_chat'];
                $chats[$x]['notificacion'] = $while['notificacion'];
                $chats[$x]['id_chat'] = $while['id_chat'];
                $chats[$x]['fk_oferta'] = $while['fk_oferta'];
                $chats[$x]['id_chat'] = $while['id_chat'];
                $x++;
            }
        }else{
            $chats = null;
        }
        return $chats;
    }
    public static function ChatId($id_chat){
        $consulta_select_chat = "SELECT *FROM chat WHERE id_chat = '$id_chat'";
        $resultado = BD::consultaSelect($consulta_select_chat);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $chat[] = $while;
            }
        }else{
            $chat = null;
        }
        return $chat;
    }
    public static function chatMensajes($id_chat){
        $consulta_select_mensajes = "SELECT *FROM mensaje WHERE fk_chat = '$id_chat'";
        $resultado = BD::consultaSelect($consulta_select_mensajes);
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $mensajes[] = $while;
            }
        }else{
            $mensajes = null;
        }
        return $mensajes;
    }
    public static function Chats_estado($estado){
        $consulta_select_chat = "SELECT *FROM chat WHERE estado_chat = '$estado'";
        $resultado = BD::consultaSelect($consulta_select_chat);
        if(mysqli_num_rows($resultado) > 0){
            $x = 0;
            while ($while = mysqli_fetch_array($resultado)){
                $chats[$x]['fk_usuario'] = $while['fk_usuario'];
                $chats[$x]['fk_oferta'] = $while['fk_oferta'];
                $chats[$x]['id_chat'] = $while['id_chat'];
                $chats[$x]['estado_chat'] = $while['estado_chat'];
                $chats[$x]['notificacion'] = $while['fk_usuario'];
                $x++;
            }
        }else{
            $chats = null;
        }
        return $chats;
    }
    public static function Chats_notificacion(){
        $consulta_select_chat = "SELECT *FROM chat WHERE notificacion = '0' OR notificacion = '2'";
        $resultado = BD::consultaSelect($consulta_select_chat);
        $chats = [];
        if(mysqli_num_rows($resultado) > 0){
            while ($while = mysqli_fetch_array($resultado)){
                $chats[] = $while;
            }
        }else{
            $chats = null;
        }
        return $chats;
    }
    
    public static function UpdateNotificacion($id_chat, $notificacion){ 
        $consulta_update_chat = "UPDATE chat SET notificacion = '$notificacion' WHERE id_chat = '$id_chat'";
        $resultado = BD::consultaSelect($consulta_update_chat);
        return $resultado;
    }

    public static function DatosPagoEstado($id_usuario, $pago){
        $consulta_select_chat = "SELECT *FROM compra WHERE fk_usuario = '$id_usuario' AND pago = '$pago'";
        $resultado = BD::consultaSelect($consulta_select_chat);
        if(mysqli_num_rows($resultado) > 0){
            $x = 0;
            while ($while = mysqli_fetch_array($resultado)){
                $pagos[$x]['id_compra'] = $while['id_compra'];
                $pagos[$x]['fecha_compra'] = $while['fecha_compra'];
                $pagos[$x]['fk_oferta'] = $while['fk_oferta'];
                $x++;
            }
        }else{
            $pagos = null;
        }
        return $pagos;
    }
}
?>