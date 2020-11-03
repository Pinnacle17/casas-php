<?php
  require("../../../headers.php");
  require("../../../conexion.php");
  $conexion = conexion();
  
  $fecha = date('Y-m-d H:i:s');
  $id_casa = mysqli_real_escape_string($conexion, $_POST['id_casa']);
  $nombre = mysqli_real_escape_string($conexion, $_POST['nombre_cuarto']);
  $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion_cuarto']);
  $numimg = count($_FILES['imgsCuarto']["name"]);
  $imgs = $_FILES['imgsCuarto'];
  $iprincipal = $_FILES['imgPrincipalCuarto']['name'];
  $ruta_iprincipal = $_FILES['imgPrincipalCuarto']['tmp_name'];


  $consulta_insert_cuarto = "INSERT INTO cuarto(
  nombre_cuarto, 
  descripcion_cuarto,
  creacion_cuarto,
  estado_cuarto,
  fk_casa) VALUES(
  '$nombre',  
  '$descripcion',
  '$fecha',
  '1', 
  '$id_casa')";
  
  mysqli_query($conexion, $consulta_insert_cuarto) or die (mysqli_error($conexion));

  $consulta_select_id = "SELECT id_cuarto FROM cuarto WHERE creacion_cuarto = '$fecha'";

  $registros = mysqli_query($conexion, $consulta_select_id) or die (mysqli_error($conexion));

  while ($resultado = mysqli_fetch_array($registros)){
      $id_cuarto = $resultado["id_cuarto"];
  }

  $carpeta_cuarto = "../../assets/img/casas/".$id_casa."/".$id_cuarto;
  mkdir($carpeta_cuarto, 0777, true);

  $carpeta_iprincipal = $carpeta_cuarto."/principal";
  mkdir($carpeta_iprincipal, 0777, true);

  $carpeta_imgs = $carpeta_cuarto."/imgs";
  mkdir($carpeta_imgs, 0777, true);

  $dirprincipal = $carpeta_iprincipal."/".$iprincipal;
  move_uploaded_file($ruta_iprincipal, $dirprincipal);

  $dirprincipal = $id_casa."/".$id_cuarto."/principal"."/".$iprincipal;

  $consulta_update_cuarto = "UPDATE cuarto SET principal_img = '$dirprincipal' WHERE fk_casa = '$id_casa'";
  mysqli_query($conexion, $consulta_update_cuarto) or die (mysqli_error($conexion));
  $dir_general_imgs = $id_casa."/".$id_cuarto."/imgs"."/";
  for($x=0; $x<$numimg; $x++){

      $nombre_img = $imgs["name"][$x];
      $ruta_img = $imgs["tmp_name"][$x];

      $dir_imgs = $carpeta_imgs."/".$nombre_img;
      move_uploaded_file($ruta_img, $dir_imgs);  

      $dir_imgs_cuarto = $dir_general_imgs.$nombre_img;

      $consulta_insert_imgs = "INSERT INTO imagen_cuarto(ruta_imagen_cuarto, fk_cuarto) VALUES('$dir_imgs_cuarto' ,'$id_cuarto')";
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