<?php
include("../conector.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_materia"])) {
    // Obtener los datos del formulario
    $idMateria = mysqli_real_escape_string($conexion, $_POST["ID_Materia"]);
    $nombreMateria = mysqli_real_escape_string($conexion, $_POST["Nombre_Materia"]);
    $horas = mysqli_real_escape_string($conexion, $_POST["Horas"]);
    $idMaestro = mysqli_real_escape_string($conexion, $_POST["ID_Maestro"]);
    $idGeneracion = mysqli_real_escape_string($conexion, $_POST["generacion"]);
    $idCarrera = mysqli_real_escape_string($conexion, $_POST["carrera"]);
    $idGrupo = mysqli_real_escape_string($conexion, $_POST["grupo"]);
    $idSemestre = mysqli_real_escape_string($conexion, $_POST["semestre"]);

    // Query para actualizar los datos en la tabla materias
    $updateQuery = "UPDATE materia 
                    SET Nombre_materia = '$nombreMateria', 
                        Horas = '$horas', 
                        ID_Maestro = '$idMaestro', 
                        ID_Generacion = '$idGeneracion', 
                        id_carrera = '$idcarrera', 
                        ID_Grupopedagogico = '$idgrupo', 
                        ID_Semestre = '$idSemestre'
                    WHERE ID_Materia = '$idMateria'";

    // Ejecutar la consulta de actualización
    if (mysqli_query($conexion, $updateQuery)) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar datos: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Obtener el ID de la materia a editar desde la URL
    $idMateria = $_GET['id'];

    // Consultar los datos actuales de la materia
    $selectQuery = "SELECT m.*, ma.Nombre_maestro, g.Nombre AS NombreGeneracion, c.Nombre AS NombreCarrera, gp.Nombre AS NombreGrupo, s.Nombre_semestre
                    FROM materia m
                    JOIN maestros ma ON m.ID_Maestro = ma.ID_Maestro
                    JOIN generacion g ON m.ID_Generacion = g.ID_Generacion
                    JOIN carrera c ON m.id_carrera = c.id_carrera
                    JOIN grupopedagogico gp ON m.ID_Grupopedagogico = gp.ID_Grupopedagogico
                    JOIN semestre s ON m.ID_Semestre = s.ID_Semestre
                    WHERE m.ID_Materia = '$idMateria'";
    $result = mysqli_query($conexion, $selectQuery);

    // Verificar si se encontraron datos
    if ($result && mysqli_num_rows($result) > 0) {
        $mostrar = mysqli_fetch_assoc($result);
    } else {
        // Redirigir o manejar el caso cuando no se encuentra la materia
        echo "Materia no encontrada.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" type="text/css" href="../Styles/tables.css">

    <title>Editar Materia</title>
</head>
<body>
    <?php
    include("../conector.php");
    
    ?>

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
    <div>
        <form method="post" action = "materias-actualizar.php"  >
            <table class="tablita lineasVerticales">
                <tr id="headerTabla">
                
                    <td><b>Nombre de la Materia</b></td>
                    <td><b>Horas</b></td>
                    <td><b>Maestro</b></td>
                    <td><b>Generación</b></td>
                    <td><b>Carrera</b></td>
                    <td><b>Grupo Pedagógico</b></td>
                    <td><b>Semestre</b></td>
                    <td><b>Acciones</b></td>
                </tr>

                <tr id="datosTabla">
                    
                    <td><input class="input-form" type="text" name="nombreMateria" value="<?php echo $mostrar['Nombre_materia']; ?>" required></td>
                    <td><input class="input-form" type="text" name="horas" value="<?php echo $mostrar['Horas']; ?>" required></td>
                    <td>
                        <select class="select-form" name="maestro" required>
                            <?php
                            
                            // Obtener la lista de maestros
                            $id = $_GET["ID_Materia"];
                            $queryMaestros = "SELECT ID_Maestro, Nombre_maestro FROM maestros";
                            $resultMaestros = mysqli_query($conexion, $queryMaestros);

                            while ($rowMaestro = mysqli_fetch_assoc($resultMaestros)) {
                                echo "<option value='" . $rowMaestro['ID_Maestro'] . "'";
                                if ($rowMaestro['ID_Maestro'] == $mostrar['ID_Maestro']) {
                                    echo " selected";
                                }
                                echo ">" . $rowMaestro['Nombre_maestro'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <!-- Generación -->
                    <td>
                        <select class="select-form" name="generacion" required>
                            <?php
                            // Obtener la lista de generaciones
                            $queryGeneraciones = "SELECT ID_Generacion, Nombre FROM generacion";
                            $resultGeneraciones = mysqli_query($conexion, $queryGeneraciones);

                            while ($rowGeneracion = mysqli_fetch_assoc($resultGeneraciones)) {
                                echo "<option value='" . $rowGeneracion['ID_Generacion'] . "'";
                                if ($rowGeneracion['ID_Generacion'] == $mostrar['ID_Generacion']) {
                                    echo " selected";
                                }
                                echo ">" . $rowGeneracion['Nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>

                    <!-- Carrera -->
                    <td>
                        <select class="select-form" name="carrera" required>
                            <?php
                            // Obtener la lista de carreras
                            $queryCarreras = "SELECT id_carrera, Nombre FROM carrera";
                            $resultCarreras = mysqli_query($conexion, $queryCarreras);

                            while ($rowCarrera = mysqli_fetch_assoc($resultCarreras)) {
                                echo "<option value='" . $rowCarrera['id_carrera'] . "'";
                                if ($rowCarrera['id_carrera'] == $mostrar['id_carrera']) {
                                    echo " selected";
                                }
                                echo ">" . $rowCarrera['Nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>

                    <!-- Grupo Pedagógico -->
                    <td>
                        <select class="select-form" name="grupo" required>
                            <?php
                            // Obtener la lista de grupos pedagógicos
                            $queryGrupos = "SELECT ID_Grupopedagogico, Nombre FROM grupopedagogico";
                            $resultGrupos = mysqli_query($conexion, $queryGrupos);

                            while ($rowGrupo = mysqli_fetch_assoc($resultGrupos)) {
                                echo "<option value='" . $rowGrupo['ID_Grupopedagogico'] . "'";
                                if ($rowGrupo['ID_Grupopedagogico'] == $mostrar['ID_Grupopedagogico']) {
                                    echo " selected";
                                }
                                echo ">" . $rowGrupo['Nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>

                    <!-- Semestre -->
                    <td>
                        <select class="select-form" name="semestre" required>
                            <?php
                            // Obtener la lista de semestres
                            $querySemestres = "SELECT ID_Semestre, Nombre_semestre FROM semestre";
                            $resultSemestres = mysqli_query($conexion, $querySemestres);

                            while ($rowSemestre = mysqli_fetch_assoc($resultSemestres)) {
                                echo "<option value='" . $rowSemestre['ID_Semestre'] . "'";
                                if ($rowSemestre['ID_Semestre'] == $mostrar['ID_Semestre']) {
                                    echo " selected";
                                }
                                echo ">" . $rowSemestre['Nombre_semestre'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td><input class="button-form" type="submit" name="editar_materia" value="Enviar">
                        <input type="hidden" name="idMateria" value="<?php echo $mostrar['ID_Materia']; ?>">

                </tr>
            </table>
        </form>
    </div>
</body>
</html>