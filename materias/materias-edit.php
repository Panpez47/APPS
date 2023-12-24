<?php
include("../conector.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_materia"])) {
    // Obtener los datos del formulario
    $idMateria = mysqli_real_escape_string($conexion, $_POST["idMateria"]);
    $nombreMateria = mysqli_real_escape_string($conexion, $_POST["nombreMateria"]);
    $horasTotales = mysqli_real_escape_string($conexion, $_POST["horas_totales"]);
    $idGrupoPedagogico = mysqli_real_escape_string($conexion, $_POST["grupo"]);

    // Calcular las horas restantes
    $horasUtilizadas = $mostrar['Horas_totales'] - $mostrar['Horas_restantes'];
    $horasRestantes = $horasTotales - $horasUtilizadas;

    // Query para actualizar los datos en la tabla materias
    $updateQuery = "UPDATE materia 
                    SET Nombre_materia = '$nombreMateria', 
                        horas_totales = '$horasTotales',
                        Horas_restantes = '$horasRestantes', 
                        grupo = '$idGrupoPedagogico' 
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
    $sql = "SELECT * FROM materia WHERE ID_Materia = '$idMateria'";
    $result = mysqli_query($conexion, $sql);

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
            <li><a href="../mm/mm-data.php">Cursos Docentes</a></li>
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
                    
            
                    <td><b>Grupo Pedagógico</b></td>
                    
                    <td><b>Acciones</b></td>
                </tr>

                <tr id="datosTabla">
                    
                    <td><input class="input-form" type="text" name="nombreMateria" value="<?php echo $mostrar['Nombre_materia']; ?>" required></td>
                    <td><input class="input-form" type="text" name="horas_totales" value="<?php echo $mostrar['Horas_totales']; ?>" required></td>
                    
                    

                    

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

                    
                    <td><input class="button-form" type="submit" name="editar_materia" value="Enviar">
                        <input type="hidden" name="idMateria" value="<?php echo $mostrar['ID_Materia']; ?>">
                        </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>