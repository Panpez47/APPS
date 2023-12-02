<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Ingresar Materias</title>
</head>
<body>
    <!--Menu-->
    <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a class="active" href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../semestre/semestre-data.php">Semestre</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <?php
    
    include("../conector.php");

    // Obtener datos para las listas desplegables
    $maestrosQuery = "SELECT ID_Maestro, Nombre_maestro FROM maestros";
    $maestrosResult = $conexion->query($maestrosQuery);

    $generacionesQuery = "SELECT ID_Generacion, Nombre FROM generacion";
    $generacionesResult = $conexion->query($generacionesQuery);

    $carrerasQuery = "SELECT ID_Carrera, Nombre FROM carrera";
    $carrerasResult = $conexion->query($carrerasQuery);

    $gruposQuery = "SELECT ID_Grupopedagogico, Nombre FROM Grupopedagogico";
    $gruposResult = $conexion->query($gruposQuery);

    $semestresQuery = "SELECT ID_Semestre, Nombre_semestre FROM semestre";
    $semestresResult = $conexion->query($semestresQuery);
    ?>

    <!-- Formulario -->
    <div class="container">
        <form method="POST" action="procesar_materias.php">
            <label for="nombreMateria">Nombre de la Materia:</label>
            <input type="text" id="nombreMateria" name="nombreMateria" required>
            <br>

            <label for="horas">Horas:</label>
            <input type="number" id="horas" name="horas" required>
            <br>

            <label for="maestro">Maestro:</label>
            <select id="maestro" name="maestro" required>
                <?php
                while ($row = $maestrosResult->fetch_assoc()) {
                    echo "<option value='" . $row['ID_Maestro'] . "'>" . $row['Nombre_maestro'] . "</option>";
                }
                ?>
            </select>
            <br>

            <label for="generacion">Generación:</label>
            <select id="generacion" name="generacion" required>
                <?php
                while ($row = $generacionesResult->fetch_assoc()) {
                    echo "<option value='" . $row['ID_Generacion'] . "'>" . $row['Nombre'] . "</option>";
                }
                ?>
            </select>
            <br>

            <label for="carrera">Carrera:</label>
            <select id="carrera" name="carrera" required>
                <?php
                while ($row = $carrerasResult->fetch_assoc()) {
                    echo "<option value='" . $row['ID_Carrera'] . "'>" . $row['Nombre'] . "</option>";
                }
                ?>
            </select>
            <br>

            <label for="grupo">Grupo Pedagógico:</label>
            <select id="grupo" name="grupo" required>
                <?php
                while ($row = $gruposResult->fetch_assoc()) {
                    echo "<option value='" . $row['ID_Grupopedagogico'] . "'>" . $row['Nombre'] . "</option>";
                }
                ?>
            </select>
            <br>

            <label for="semestre">Semestre:</label>
            <select id="semestre" name="semestre" required>
                <?php
                while ($row = $semestresResult->fetch_assoc()) {
                    echo "<option value='" . $row['ID_Semestre'] . "'>" . $row['Nombre_semestre'] . "</option>";
                }
                ?>
            </select>
            <br>

            <input type="submit" name="enviar_materia">
        </form>
    </div>
</body>
</html>
