<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">

    <title>Maestro Materia</title>
</head>
<body>
    <?php include("../conector.php"); ?>

    <!--Menu-->
   <!--Menu-->
   <nav class="stroke">
        <ul>
            <li><a href="../Horario-data.php">Horario</a></li>
            <li><a href="../maestros/maestros-data.php">Maestros</a></li>
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a class="active" href="mm-data.php">Cursos Docentes</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>


    <div class="ContenedorAgregar">
        <a href="mm.php"> <!-- Ajusta el enlace al formulario de creación -->
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
        <table class="tablita lineasVerticales">
            <tr id="headerTabla">
                <td><b>ID</b></td>
                <td><b>Maestro</b></td>
                <td><b>Materia</b></td>
                <td><b>Acciones</b></td>
            </tr>

            <?php
        $sql = "SELECT mm.id_maestro_materia, m.Nombre_maestro, mt.Nombre_materia, gp.Nombre AS GrupoPedagogico
        FROM MaestroMateria mm
        JOIN Maestros m ON mm.ID_Maestro = m.ID_Maestro
        JOIN Materia mt ON mm.ID_Materia = mt.ID_Materia
        LEFT JOIN Grupopedagogico gp ON mt.ID_Grupopedagogico = gp.ID_Grupopedagogico";
    $result = mysqli_query($conexion, $sql);

    while ($mostrar = mysqli_fetch_assoc($result)) {
    $nombreMateriaConGrupo = $mostrar['Nombre_materia'] . (isset($mostrar['GrupoPedagogico']) ? ' - Grupo: ' . $mostrar['GrupoPedagogico'] : '');
    echo "<tr id='datosTabla'>";
    echo "<td>{$mostrar['id_maestro_materia']}</td>";
    echo "<td>{$mostrar['Nombre_maestro']}</td>";
    echo "<td>{$nombreMateriaConGrupo}</td>";
    echo "<td id='botonesss'>";
    echo "<a href='mm-edit.php?id={$mostrar['id_maestro_materia']}' class='button'><b>Editar</b></a>";
    echo "<a href='mm-delete.php?id={$mostrar['id_maestro_materia']}' class='button1' onclick='return confirm(\"¿Estás seguro que deseas eliminar este registro?\");'><b>Borrar</b></a>";
    echo "</td>";
    echo "</tr>";
}
            ?>
        </table> 
    </div>
    <script src="confirmacion.js"></script> <!-- Asegúrate de que este script exista y esté correctamente enlazado -->
</body>
</html>
