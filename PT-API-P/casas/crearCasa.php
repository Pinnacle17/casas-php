<?php
  require("../headers.php");
  require("../conexion.php");
  $conexion = conexion();
  
  $fecha = date('Y-m-d H:i:s');
  $id_colonia = mysqli_real_escape_string($conexion, $_POST['']);
  
  $nombre = mysqli_real_escape_string($conexion, $_POST['']);
  $nombre_busqueda = strtolower($nombre);
  $direccion = mysqli_real_escape_string($conexion, $_POST['']);
  $descripcion = mysqli_real_escape_string($conexion, $_POST['']);
  $orden_anuncio = mysqli_real_escape_string($conexion,$_POST['']);
  $ambiente = mysqli_real_escape_string($conexion, $_POST['']);
  $enlace = mysqli_real_escape_string($conexion, $_POST['']);
  

  $numimg = count($_FILES['imgsCasa']["name"]);
  $imgs = $_FILES['imgsCasa'];
  $icarousel = $_FILES['imgCarousel']['name'];
  $ruta_icarousel = $_FILES['imgCarousel']['tmp_name'];
  $ievento = $_FILES['imgPrincipal']['name'];
  $ruta_iprincipal = $_FILES['imgPrincipal']['tmp_name'];

  $consulta_insert_evento = "INSERT INTO evento(
  nombre_casa,
  nombre_casa_busqueda,
  direccion_casa, 
  descripcion_casa,
  creacion_casa,
  estado_casa,
  calificacion_casa,
  orden_anuncio,
  ambiente, 
  enlace_casa,
  fk_colonia) VALUES(
  '$nombre',  
  '$nombre_busqueda',  
  '$direccion', 
  '$descripcion',
  '$fecha',
  1,
  10, 
  '$orden_anuncio',
  '$ambiente', 
  '$enlace',
  '$id_colonia')";

  mysqli_query($conexion, $consulta_insert_evento) or die (mysqli_error($conexion));

  $consulta_select_id = "SELECT id_casa FROM casa WHERE creacion_casa = '$fecha'";

  $registros = mysqli_query($conexion, $consulta_select_id) or die (mysqli_error($conexion));

  while ($resultado = mysqli_fetch_array($registros)){
      $id_casa = $resultado["id_casa"];
  }

  $carpeta_casa = "../../admin/assets/img/eventos/".$id_casa;
  mkdir($carpeta_casa, 0777, true);

  $carpeta_ievento = "../../admin/assets/img/eventos/".$id_casa."/"."principal";
  mkdir($carpeta_ievento, 0777, true);

  $carpeta_icarousel = "../../admin/assets/img/eventos/".$id_casa."/"."carousel";
  mkdir($carpeta_icarousel, 0777, true);

  $carpeta_imgs = "../../admin/assets/img/eventos/".$id_casa."/"."imgs";
  mkdir($carpeta_imgs, 0777, true);

  $dircarousel = $carpeta_icarousel."/".$icarousel;
  $direvento = $carpeta_ievento."/".$ievento;

  move_uploaded_file($ruta_icarousel, $dircarousel);
  move_uploaded_file($ruta_iprincipal, $direvento);

  $dircarousel = $id_casa."/carousel"."/".$icarousel;
  $direvento = $id_casa."/principal"."/".$ievento;

  $consulta_update_evento = "UPDATE evento SET carousel_img = '$dircarousel', evento_img = '$direvento' WHERE id_evento = '$id_casa'";
  mysqli_query($conexion, $consulta_update_evento) or die (mysqli_error($conexion));

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