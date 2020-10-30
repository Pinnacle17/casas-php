<?php
    require("../../headers.php");
    require("../../conexion.php"); 
    $conexion = conexion();
    $id_casa = mysqli_real_escape_string($conexion, $_POST['id_casa']);
    
    if(!empty($_FILES['imgs'])){
        $numimg = count($_FILES['imgs']["name"]);
        $imgs = $_FILES['imgs'];

        $carpeta_imgs = "../../admin/assets/img/casas/".$id_casa."/"."imgs/";//ver ruta

        for($x=0; $x<$numimg; $x++){
            $nombre_img = $imgs["name"][$x];
            $ruta_img = $imgs["tmp_name"][$x];

            $dir_imgs = $carpeta_imgs.$nombre_img; //ver ruta
            move_uploaded_file($ruta_img, $dir_imgs);
            $dir_imgs = $id_casa."/"."imgs/".$nombre_img;

            $consulta_insert_imgs = "INSERT INTO imagen_casa (ruta_imagen_casa, fk_casa) VALUES('$dir_imgs', '$id_casa')";
            mysqli_query($conexion, $consulta_insert_imgs) or die(mysqli_error($conexion));
        }
    }

    if(!empty($_FILES['imgCarousel'])){
        $icarousel = $_FILES['imgCarousel']['name'];
        $ruta_icarousel = $_FILES['imgCarousel']['tmp_name'];

        $consulta_carousel = "SELECT carousel_img FROM casa WHERE id_casa = '$id_casa'";
        $registro = mysqli_query($conexion, $consulta_carousel) or die (mysqli_error($conexion));
        while ($resultado = mysqli_fetch_array($registro)){
            $carousel_img = $resultado["carousel_img"];
        }

        $carpeta_casa = "../../admin/assets/img/casas/";
        $dircarousel = $id_casa."/carousel"."/".$icarousel; //ver si ruta es correcta
        $ruta_img = $carpeta_casa.$carousel_img; //poner la ruta para llegar a la imagen

        unlink($ruta_img);
        move_uploaded_file($ruta_icarousel, $carpeta_casa.$dircarousel);

        $update_carousel_casa = "UPDATE casa SET carousel_img = '$dircarousel' WHERE id_casa = '$id_casa'";
        mysqli_query($conexion, $update_carousel_casa) or die (mysqli_error($conexion));
    }
    
    if(!empty( $_FILES['imgPrincipal'])){
        $iprincipal = $_FILES['imgPrincipal']['name'];
        $ruta_iprincipal = $_FILES['imgPrincipal']['tmp_name'];

        $consulta_principal = "SELECT principal_img FROM casa WHERE id_casa = '$id_casa'";
        $registro = mysqli_query($conexion, $consulta_principal) or die (mysqli_error($conexion));
        while ($resultado = mysqli_fetch_array($registro)){
            $principal_img = $resultado["principal_img"];
        }

        $carpeta_casa = "../../admin/assets/img/casas/";
        $dircasa = $id_casa."/principal"."/".$iprincipal;
        $ruta_img_vieja = $carpeta_casa.$principal_img;

        unlink($ruta_img_vieja);
        move_uploaded_file($ruta_iprincipal, $carpeta_casa.$dircasa);

        $update_principal_casa = "UPDATE casa SET principal_img = '$dircasa' WHERE id_casa = '$id_casa'";
        mysqli_query($conexion, $update_principal_casa) or die (mysqli_error($conexion));
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