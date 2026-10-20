<?php
include("conexion.php");

$con = conectar();

// Recibimos el id enviado por la URL
$id = $_GET['id'];

// Eliminamos al alumno de la tabla
$sql = "DELETE FROM alumnos WHERE id='$id'";

$query = mysqli_query($con, $sql);

// Verificamos si la consulta se ejecutó correctamente
if ($query) {
    header("Location: alumnos.php");
    exit();
} else {
    echo "Error al eliminar el alumno: " . mysqli_error($con);
}
?>
