
<?php

include("conexion.php");

$con = conectar();

/*recibir los datos del formulario y actualizar*/

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['id'];
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $edad = $_POST['edad'];

    /*crear la consulta para actualizar*/

    $sql = "UPDATE alumnos SET
    matricula = ?,
    nombre = ?,
    apellido_p = ?,
    apellido_m = ?,
    edad = ?
    WHERE id = ?";

    /*ejecutar la consulta*/

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "isssii",
        $matricula,
        $nombre,
        $apellido_p,
        $apellido_m,
        $edad,
        $id
    );

    $query = mysqli_stmt_execute($stmt);

    /*verificar si se actualizo correctamente*/

    if($query){
        header("Location: alumnos.php");
        exit();
    }
    else{
        echo "Error al actualizar el alumno";
    }
}

/*recibir el id enviado por la URL*/

$id = $_GET['id'] ?? null;

if(!filter_var($id, FILTER_VALIDATE_INT)){
    exit("Id de alumno no valido");
}

/*consultar los datos del alumno*/

$sql = "SELECT * FROM alumnos WHERE id = ?";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$query = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($query);

if(!$row){
    exit("Alumno no encontrado");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
</head>
<body>

    <h1>EDITAR ALUMNO</h1>

    <form action="editar.php" method="POST">

        <input type="hidden" name="id"
        value="<?php echo $row['id'] ?>">

        <input type="text" name="matricula"
        value="<?php echo htmlspecialchars($row['matricula']) ?>" required>

        <input type="text" name="nombre"
        value="<?php echo htmlspecialchars($row['nombre']) ?>" required>

        <input type="text" name="apellido_p"
        value="<?php echo htmlspecialchars($row['apellido_p']) ?>" required>

        <input type="text" name="apellido_m"
        value="<?php echo htmlspecialchars($row['apellido_m']) ?>" required>

        <input type="number" name="edad"
        value="<?php echo htmlspecialchars($row['edad']) ?>" required>

        <input type="submit" value="Actualizar Alumno">

    </form>

</body>
</html>
