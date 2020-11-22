<?php
    class BD{
        public static function DB(){
            $dbServername = "localhost";
            $dbUsuario = "u925788104_admin";
            $dbContra = "Hola1234";
            $dbName = "u925788104_casas";
            //$dbServername = "localhost";
            //$dbUsuario = "root";
            //$dbContra = "";
            //$dbName = "casas";

            $conexion = new mysqli($dbServername, $dbUsuario, $dbContra, $dbName);
            return $conexion;
        }
        public static function consultaSelect($consulta){
            $dbServername = "localhost";
            $dbUsuario = "u925788104_admin";
            $dbContra = "Hola1234";
            $dbName = "u925788104_casas";
            //$dbServername = "localhost";
            //$dbUsuario = "root";
            //$dbContra = "";
            //$dbName = "casas";
            
            $conexion = new mysqli($dbServername, $dbUsuario, $dbContra, $dbName);
            $resultado = mysqli_query($conexion, $consulta);
            return $resultado;
        }


    }
?>