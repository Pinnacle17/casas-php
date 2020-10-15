<?php
  require("../headers.php");
  require("../conexion.php");
  $conexion = conexion();
  
  $fecha = date('Y-m-d H:i:s');
  $id_colonia = mysqli_real_escape_string($conexion, $_POST['id_colonia']);
  
  
  $nombre = mysqli_real_escape_string($conexion, $_POST['nombre_casa']);
  $nombre_busqueda = strtolower($nombre);
  $direccion = mysqli_real_escape_string($conexion, $_POST['direccion_casa']);
  $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion_casa']);
  $orden_anuncio = mysqli_real_escape_string($conexion,$_POST['orden_anuncio']);
  $ambiente = mysqli_real_escape_string($conexion, $_POST['ambiente']);


  $numimg = count($_FILES['imgsCasa']["name"]);
  $imgs = $_FILES['imgsCasa'];
  $icarousel = $_FILES['imgCarousel']['name'];
  $ruta_icarousel = $_FILES['imgCarousel']['tmp_name'];
  $iprincipal = $_FILES['imgPrincipal']['name'];
  $ruta_iprincipal = $_FILES['imgPrincipal']['tmp_name'];


  $consulta_insert_casa = "INSERT INTO evento(
  nombre_casa,
  nombre_casa_busqueda,
  direccion_casa, 
  descripcion_casa,
  creacion_casa,
  estado_casa,
  orden_anuncio,
  ambiente, 
  fk_colonia) VALUES(
  '$nombre',  
  '$nombre_busqueda',  
  '$direccion', 
  '$descripcion',
  '$fecha',
  1,
  '$orden_anuncio',
  '$ambiente', 
  '$id_colonia')";

  mysqli_query($conexion, $consulta_insert_casa) or die (mysqli_error($conexion));

  $consulta_select_id = "SELECT id_casa FROM casa WHERE creacion_casa = '$fecha'";

  $registros = mysqli_query($conexion, $consulta_select_id) or die (mysqli_error($conexion));

  while ($resultado = mysqli_fetch_array($registros)){
      $id_casa = $resultado["id_casa"];
  }

  $carpeta_casa = "../../admin/assets/img/casas/".$id_casa;
  mkdir($carpeta_casa, 0777, true);

  $carpeta_iprincipal = "../../admin/assets/img/casas/".$id_casa."/"."principal";
  mkdir($carpeta_iprincipal, 0777, true);

  $carpeta_icarousel = "../../admin/assets/img/casas/".$id_casa."/"."carousel";
  mkdir($carpeta_icarousel, 0777, true);

  $carpeta_imgs = "../../admin/assets/img/casas/".$id_casa."/"."imgs";
  mkdir($carpeta_imgs, 0777, true);

  $dircarousel = $carpeta_icarousel."/".$icarousel;
  $dirprincipal = $carpeta_iprincipal."/".$iprincipal;

  move_uploaded_file($ruta_icarousel, $dircarousel);
  move_uploaded_file($ruta_iprincipal, $dirprincipal);

  $dircarousel = $id_casa."/carousel"."/".$icarousel;
  $dirprincipal = $id_casa."/principal"."/".$ievento;

  $consulta_update_casa = "UPDATE casa SET carousel_img = '$dircarousel', principal_img = '$dirprincipal' WHERE id_casa = '$id_casa'";
  mysqli_query($conexion, $consulta_update_casa) or die (mysqli_error($conexion));

  for($x=0; $x<$numimg; $x++){

      $nombre_img = $imgs["name"][$x];
      $ruta_img = $imgs["tmp_name"][$x];

      $dir_imgs = $carpeta_imgs."/".$nombre_img;
      move_uploaded_file($ruta_img, $dir_imgs);  

      $dir_imgs = $id_casa."/imgs"."/".$nombre_img;

      $consulta_insert_imgs = "INSERT INTO casa(ruta_imagen_casa, fk_casa) VALUES('$dir_imgs' ,'$id_casa')";
      mysqli_query($conexion, $consulta_insert_imgs) or die(mysqli_error($conexion));
      
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