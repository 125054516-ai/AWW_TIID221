
<?php

/*incluir informacion del archivo*/
include("conexion.php");

/*mandar a llamar a las funciones*/
$con = conectar();

/*dame todo lo que tengas de alumnos*/
$sql = "SELECT * FROM alumnos";

/*ejecutar la consulta y tendremos acceso a la bd*/
$query = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
</head>
<body>

    <h2>Lista de Alumnos</h2>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Edad</th>
            <th>Acciones</th>
        </tr>

        <?php while($row = mysqli_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['matricula'] ?></td>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['apellido_p'] ?></td>
                <td><?php echo $row['apellido_m'] ?></td>
                <td><?php echo $row['edad'] ?></td>
                <td>
                    <a href="delate.php?id=<?php echo $row['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este alumno?')">Eliminar</a>
                    <br>
                    <a href="editar.php?id=<?php echo $row['id'] ?>">Editar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h1> FORMULARIO </h1>

    <form action="insertar.php" method="POST">
    <input type="text" class="form-control" name="matricula" placeholder="Matricula">
    <input type="text" class="form-control" name="nombre" placeholder="Nombre">
    <input type="text" class="form-control" name="apellido_p" placeholder="Apellido Paterno">
    <input type="text" class="form-control" name="apellido_m" placeholder="Apellido Materno">
    <input type="number" class="form-control" name="edad" placeholder="Edad">
    <input type="submit" class="btn btn-primary" value="Agregar Alumno">
    </form>

</body>
</html>
