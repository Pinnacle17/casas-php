<?php
require("../../../headers.php");
require("../../../conexion.php");
require("../../../modelo/claseUsuario.php");

$conexion = conexion();
$consulta = "SELECT *FROM calificacion WHERE estado = '1' AND fk_casa = $_GET[id_casa]";
$registros = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($registros) > 0){
    $comentarios = [];
    $x = 0;
    while ($resultado = mysqli_fetch_array($registros)){
        $comentarios[$x]['limpieza'] = $resultado['limpieza'];
        $comentarios[$x]['ambiente'] = $resultado['ambiente'];
        $comentarios[$x]['instalaciones'] = $resultado['instalaciones'];
        $comentarios[$x]['comentario'] = $resultado['comentario'];
        $comentarios[$x]['fk_usuario'] = $resultado['fk_usuario'];
        $usuario = Usuario::DatosUsuarioid($resultado['fk_usuario']);
        $comentarios[$x]['nombre_usuario'] = $usuario['nombre_usuario'];
        $comentarios[$x]['foto'] = $usuario['foto'];
    }
}else{
    $comentarios = null;
}


$json = json_encode($comentarios);

echo $json;

?>