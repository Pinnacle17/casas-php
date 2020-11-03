<?php
    require("../../../headers.php");
    require("../../../conexion.php");
    require("../../../modelo/BD.php");
    require("../../../modelo/ClaseUsuario.php");

    $conexion = conexion();
    $id_casa = $_GET['id_casa'];
    $id_usuario = $_GET['id_usuario'];
    $consulta_select_cuartos = "SELECT id_cuarto FROM cuarto WHERE fk_casa = '$id_casa'";
    $resultado_cuartos = BD::consultaSelect($consulta_select_cuartos);
    $ventas = Usuario::verVentasUsuario($id_usuario);
    $encontrado = 0;
    if(mysqli_num_rows($resultado_cuartos > 0)){
        if($ventas != null){
            $z = 0;
            while ($cuartos = mysqli_fetch_array($resultado_cuartos)){
                $id_cuartos[$z]['id_cuarto'] = $cuartos['id_cuarto'];
                $z++;
            }
            $numeroventas = count($ventas);
            for($x = 0; $x < $numeroventas; $x++){
                $oferta = Usuario::verOfertaid($ventas[$x]['fk_oferta']);
                for($y = 0; $y < $z; $y++){
                    if($oferta[0]['fk_cuarto'] == $id_cuartos[$y]['id_cuarto']){
                        $encontrado = 1;//significa que rento un cuarto y puede comentar la casa
                        break;
                    }
                }
                if($encontrado == 1){
                    break;
                }
            }
        }
    }
    class Result {}

    $response = new Result();
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
        $response->validacion = $encontrado;//si validacion es igual a 1 puede comentar, si es igual a 0 no
    }
    echo json_encode($response); 

?>