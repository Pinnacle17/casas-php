<?php
    require("../../../headers.php");
    require("../../../conexion.php"); 
    $conexion = conexion();
    $id_casa = mysqli_real_escape_string($conexion, $_POST['id_casa']);
    $id_cuarto = mysqli_real_escape_string($conexion, $_POST['id_casa']);
    if(!empty($_FILES['imgs'])){
        $numimg = count($_FILES['imgs']["name"]);
        $imgs = $_FILES['imgs'];

        $carpeta_imgs = "../../../../admin/assets/img/casas/".$id_casa."/".$id_cuarto."/imgs"."/";//ver ruta

        for($x=0; $x<$numimg; $x++){
            $nombre_img = $imgs["name"][$x];
            $ruta_img = $imgs["tmp_name"][$x];

            $dir_imgs = $carpeta_imgs.$nombre_img; //ver ruta
            move_uploaded_file($ruta_img, $dir_imgs);
            $dir_imgs_bd = $id_casa."/".$id_cuarto."/"."imgs/".$nombre_img;

            $consulta_insert_imgs = "INSERT INTO imagen_cuarto(ruta_imagen_cuarto, fk_cuarto) VALUES('$dir_imgs_bd', '$id_cuarto')";
            mysqli_query($conexion, $consulta_insert_imgs) or die(mysqli_error($conexion));
        }
    }
    
    if(!empty( $_FILES['imgPrincipal'])){
        $iprincipal = $_FILES['imgPrincipal']['name'];
        $ruta_iprincipal = $_FILES['imgPrincipal']['tmp_name'];

        $consulta_principal = "SELECT principal_img FROM cuarto WHERE id_cuarto = '$id_cuarto'";
        $registro = mysqli_query($conexion, $consulta_principal) or die (mysqli_error($conexion));
        while ($resultado = mysqli_fetch_array($registro)){
            $principal_img = $resultado["principal_img"];
        }

        $carpeta_casa = "../../../../admin/assets/img/casas/";
        $dirprincipal = $id_casa."/".$id_cuarto."/principal"."/".$iprincipal;
        $ruta_img_vieja = $carpeta_casa.$principal_img;

        unlink($ruta_img_vieja);
        move_uploaded_file($ruta_iprincipal, $carpeta_casa.$dirprincipal);

        $update_principal_cuarto = "UPDATE cuarto SET principal_img = '$dirprincipal' WHERE id_cuarto = '$id_cuarto'";
        mysqli_query($conexion, $update_principal_cuarto) or die (mysqli_error($conexion));
    }
    
    class Result {}

    $response = new Result();
  
    if(mysqli_error($conexion)){
        $response->resultado = 'ERROR';
    }
    else{
        $response->resultado = 'OK';
    }
  
    echo json_encode($response); 
?>