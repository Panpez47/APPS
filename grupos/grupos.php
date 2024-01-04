
<?php
session_start();
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<script>alert('$error');</script>";
        unset($_SESSION['error']);  // Limpiar la variable de sesión después de mostrar el mensaje
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Grupos</title>
</head>
<body>
    <!--Menu-->
    <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../mm/mm-data.php">Cursos Docentes</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a class="active" href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>

    <?php
    include("../conector.php");
    $queryGeneracion = "SELECT ID_Generacion, Nombre FROM Generacion";
    $resultadoGeneracion = mysqli_query($conexion, $queryGeneracion);
    $queryCarrera = "SELECT id_carrera, nombre FROM Carrera";
    $resultadoCarrera = mysqli_query($conexion, $queryCarrera);
    ?>

    <!--Formulario-->
    <div class="container">
    <form  method="POST">
        <label for="nombregrupo">Nombre del Grupo:</label>
        <input type="text" id="nombregrupo" name="nombregrupo" required>
        <br>

        <label for="semestre">Semestre:</label>
        <select id="semestre" name="semestre" required>
            <?php for($i = 1; $i <= 9; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <br>

        <label for="id_generacion">Generación:</label>
        <select id="id_generacion" name="id_generacion" required>
        <?php while($row = mysqli_fetch_assoc($resultadoGeneracion)): ?>
        <option value="<?php echo $row['ID_Generacion']; ?>"><?php echo $row['Nombre']; ?></option>
    <?php endwhile; ?>
        </select>
        <br>

        <label for="id_carrera">Carrera:</label>
        <select id="id_carrera" name="id_carrera" required>
        <?php while($row = mysqli_fetch_assoc($resultadoCarrera)): ?>
        <option value="<?php echo $row['id_carrera']; ?>"><?php echo $row['nombre']; ?></option>
    <?php endwhile; ?>
        </select>
        <br>

        <input type="submit" name="enviar1">
    </form>
    <?php
    include("enviar.php");
    // Asegúrate de que el script de procesamiento esté correctamente referenciado
    ?>
    </div>

    <script>
        // Aquí podrías añadir JavaScript si es necesario
    </script>
</body>
</html>