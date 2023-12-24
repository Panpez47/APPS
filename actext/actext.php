<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Actext</title>
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
            <li><a class="active" href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <?php
    
    include("../conector.php");

    $query = "SELECT ID_Maestro , Nombre_maestro FROM maestros";
    $result = $conexion->query($query);
    ?>

    <!--Formulario-->
    <div class="container">
    <form method="POST">
        <label for="nombreactext">Actividad Extra:</label>
        <input type="text" id="actext" name="actext" required>
        <br>
        <label for="maestro">Maestro:</label>
        <select id="actividad" name="actividad" required>
            <?php
            // Iterar sobre los resultados y generar opciones para la lista desplegable
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ID_Maestro'] . "'>" . $row['Nombre_maestro'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" name = "enviar1" >
    </form>
    <?php
    include("enviar.php");
    ?>
</body>
</html>