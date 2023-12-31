<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">
    <title>Incidencias</title>
</head>
<body>
    <?php
    include("../conector.php");

    // Función para obtener el nombre del maestro
    function obtenerNombreGrupo($conexion, $idGrupo)
    {
        $query = "SELECT Nombre FROM Grupopedagogico WHERE ID_Grupopedagogico = $idGrupo";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['Nombre'];
    }

    // Obtener datos de incidencias
    $sql = "SELECT * FROM Incidencias";
    $result = mysqli_query($conexion, $sql);
    ?>

    <!--Menu-->
    <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../mm/mm-data.php">Cursos Docentes</a></li>
            <li><a class="active" href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>
        </ul>
    </nav>

    <div class="ContenedorAgregar">
        <a href="./incidencias.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
        <table class="tablita lineasVerticales">
            <tr id="headerTabla">
                <td><b>ID</b></td>
                <td><b>Incidencia</b></td>
                <td><b>Grupo Pedagógico</b></td>
                <td><b>Fecha</b></td>
                <td><b>Acciones</b></td>
            </tr>

            <?php
            while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                <tr id="datosTabla">
                    <td><?php echo $mostrar['ID_Incidencias'] ?></td>
                    <td><?php echo $mostrar['Motivo'] ?></td>
                    <td><?php echo obtenerNombreGrupo($conexion, $mostrar['ID_Grupopedagogico']) ?></td>
                    <td><?php echo $mostrar['Fecha'] ?></td>

                    <td id="botonesss">
                        <a href="incidencias-edit.php?id=<?php echo $mostrar['ID_Incidencias'] ?>"><button class="button"><b>Editar</b></button></a>
                        <a href="incidencias-delete.php?id=<?php echo $mostrar['ID_Incidencias'] ?>"><button class="button1"><b>Borrar</b></button></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table> 
    </div>
    <script src="confirmacion.js"></script>
</body>
</html>
