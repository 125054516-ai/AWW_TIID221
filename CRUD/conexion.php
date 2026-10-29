<?php

/*creamos una funcion llamada conectar que nos permitira conectarnos a la base de datos*/
function conectar(){
    /*informacion del servidor*/
    $host = "localhost";
    $user = "root";
    $pass = "";

    /*base de datos*/
    $db = "AWW_TIID221";

    /*permitir conectarlos a sql*/
    $con = mysqli_connect($host, $user, $pass, $db);

    return $con;
}

?>
