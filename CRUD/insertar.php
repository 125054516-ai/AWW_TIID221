<?php

include("conexion.php");

$con = conectar();

/*recibir los datos del formulario*/

$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$apellido_p = $_POST['apellido_p'];
$apellido_m = $_POST['apellido_m'];
$edad = $_POST['edad'];

/* crear la consulta para insertar los datos en la base de datos*/
$sql = "INSERT INTO alumnos
(matricula, nombre, apellido_p, apellido_m, edad)
VALUES
('$matricula', '$nombre', '$apellido_p', '$apellido_m', '$edad')";

/*ejecutar la consulta*/
$query = mysqli_query($con, $sql);

/*comprobar si la consulta se ejecuto correctamente y redireccionar a la pagina de alumnos.php*/
if($query){
    Header("Location: alumnos.php");
}
else{
    echo "Error al insertar al alumno";
}


?>