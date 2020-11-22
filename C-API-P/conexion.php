<?php

  function conexion() {

    $dbServername = "localhost";
    $dbUsuario = "u925788104_admin";
    $dbContra = "Hola1234";
    $dbName = "u925788104_casas";
    //$dbServername = "localhost";
    //$dbUsuario = "root";
    //$dbContra = "";
    //$dbName = "casas";
    
    $conexion = mysqli_connect($dbServername, $dbUsuario, $dbContra, $dbName);
    mysqli_set_charset($conexion,'utf8');
    
    return $conexion;
    
  }
  
?>