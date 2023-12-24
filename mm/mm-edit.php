<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" type="text/css" href="../Styles/tables.css">

    <title>Editar </title>
</head>
<body>
    <?php
    include("../conector.php");

    // Verifica si el ID está presente
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepara la consulta para obtener los datos del registro específico
        $stmt = $conexion->prepare("SELECT mm.id_maestro_materia, mm.ID_Maestro, mm.ID_Materia, m.Nombre_maestro, mt.Nombre_materia FROM MaestroMateria mm JOIN Maestros m ON mm.ID_Maestro = m.ID_Maestro JOIN Materia mt ON mm.ID_Materia = mt.ID_Materia WHERE mm.id_maestro_materia = ?");
        
        // Vincula el ID a la sentencia preparada
        $stmt->bind_param("i", $id);

        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene los resultados de la consulta
        $resultado = $stmt->get_result();

        // Fetch the data if it exists
        $fila = $resultado->fetch_assoc();

        if (!$fila) {
            echo "No se encontró un registro con el ID proporcionado.";
            exit;
        }

        // Cierra el statement
        $stmt->close();

        // Consultas adicionales para las listas desplegables
        $maestros = mysqli_query($conexion, "SELECT ID_Maestro, Nombre_maestro FROM Maestros");
        $materias = mysqli_query($conexion, "SELECT ID_Materia, Nombre_materia FROM Materia");
    } else {
        echo "No se ha proporcionado un ID para editar.";
        exit;
    }
    ?>

    <!-- Aquí tu menú de navegación -->
 <!--Menu-->
 <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="mm-data.php">Cursos Docentes</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a class="active" href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <div class="ContenedorAgregar">
        <!-- Aquí tu botón de agregar -->
    </div>
    
    <div>
        <form action="mm-actualizar.php" method="post">
            <table class="tablita lineasVerticales">
            <tr id="headerTabla">
                    <td><b>Nombre del Maestro</b></td>
                    <td><b>Nombre de la Materia</b></td>
                    <td><b>Acciones</b></td>
                </tr>
                <tr id="datosTabla">
                    <!-- Lista desplegable para los maestros -->
                    <td>
                        <select id="id_maestro" name="id_maestro" required>
                            <?php while($row = mysqli_fetch_assoc($maestros)): ?>
                                <option value="<?php echo $row['ID_Maestro']; ?>" <?php echo $row['ID_Maestro'] == $fila['ID_Maestro'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($row['Nombre_maestro']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                    <!-- Lista desplegable para las materias -->
                    <td>
                        <select id="id_materia" name="id_materia" required>
                            <?php while($row = mysqli_fetch_assoc($materias)): ?>
                                <option value="<?php echo $row['ID_Materia']; ?>" <?php echo $row['ID_Materia'] == $fila['ID_Materia'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($row['Nombre_materia']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>

                    <!-- Botón de acción para actualizar -->
                    <td>
                        <input type="hidden" name="id_maestro_materia" value="<?php echo $id; ?>">
                        <input type="submit" value="Actualizar Maestro Materia">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
