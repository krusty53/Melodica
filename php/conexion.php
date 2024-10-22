<?php
//declaracion de variables para conexion a la BD
$servidor = "localhost";    //para este trabajo usaré el local host
$usuario = "root";  //usuartio de la BD
$contrasenha = "";   //contraseña del usuario Root
$BD = "melodica";    //Nombre de mi BD

//Creacion de la conexion a la BD Melodica

$conexion = mysqli_connect($servidor, $usuario, $contrasenha, $BD);


//verificacion de la conexion a la BD

if(!$conexion) {
    echo "Fallo la conexion a la BD <br>";
    die("connection failed: " . mysqli_connect_error());
}
else{
    echo "Conexion a la BD exitosa";
}

?>