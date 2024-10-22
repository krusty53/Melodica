<?php

include("conexion.php");  //se incluye la ejecucion del archivo conexion


//declaracion de variables para recibir y guardar los datos enviados desde el formulario

$user           =   $_POST["user"];  //la primera es la variable de la BD la segunda despues de POST es la variable del formulario
$nombre         =   $_POST["nombre"];
$apellido       =   $_POST["apellido"];
$edad           =   $_POST["edad"];
$descripcion    =   $_POST["descripcion"];
$correo         =   $_POST["correo"];
$password       =   $_POST["contraseña"];


//encriptado del password para la Bd de Melodica

$passwordHash   =   password_hash($password, PASSWORD_BCRYPT);  //BCRYPT devuelve una cadena de 60 caracteres


//variable para la foto de perfil

$fotoPerfil     =   "img/$user/perfil.jpg";


//consulta SQL para validar si el usuario existe en la BD o no

$consultaId =  "SELECT user
                FROM persona
                WHERE user = '$user' ";

$consultaId = mysqli_query($conexion, $consultaId); //devuelva un objeto con el resultado, falso si hay error, true si se ejecuto correctamente
$consultaId = mysqli_fetch_array($consultaId) ; //devuelve un array o NULl


if(!$consultaId) {   //Si la consulta esta vacia entonces significa que no existe el user, y creamos el usuario nuevo
    
    $sql = "INSERT INTO persona VALUES('$user', '$nombre', '$apellido', '$edad', '$descripcion', '$fotoPerfil', '$correo', '$passwordHash')";

    //Se ejecuta y verifica si se guardaron los datos
    if(mysqli_query($conexion, $sql)) {

        mkdir("../img/$user"); //creacion de carpeta de imagenes para el usuario
        copy("../img/default.jpg", "../img/$user/perfil.jpg"); //copia de la foto por default

        echo "Tu cuenta ha sido creada con exito"; //mensaje de cuenta creada
        echo "<br> <a href='../index.html'> Iniciar Sesion</a></div>"; //muestra un link para poder volver a inicar sesion

    }
    else {
        echo "Error:" . $sql . "<br>" . mysqli_error($conexion);
    }
}
else{
    echo "El user ya existe.";
    echo "<a href='../index.html'> Intentalo de nuevo </a></div>";
}

//cierre de conexion con la BD
mysqli_close($conexion);
?>