<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">

    <title>Materias</title>
</head>
<body>
    <?php
    include("../conector.php");
    ?>
    <!--Header-->
   <nav class="stroke">
        <ul>
            <li><a class="active" href="../index.php">Horario</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a href="materias-data.php">Materias</a></li>
            <li><a href="#">Generacion</a></li>
            <li><a href="./semestre/semestre.php">Semestre</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <li><a href="#">Extras</a></li>
            <li><a href="#">GruposP</a></li>
        </ul>
    </nav>

    <div class="ContenedorAgregar">
        <a href="../materias/materias.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
    <table class="tablita lineasVerticales">
        <tr id="headerTabla">
            <td><b>ID</b></td>
            <td><b>Nombre de la Materia</b></td>
            <td><b>Horas</b></td>
            <td><b>Nombre del Maestro</b></td>
            <td><b>Generación</b></td>
            <td><b>Carrera</b></td>
            <td><b>Grupo Pedagógico</b></td>
            <td><b>Semestre</b></td>
            <td><b>Acciones</b></td>
        </tr>

        <?php
        $sql = "SELECT m.*, ma.Nombre_maestro, g.Nombre AS NombreGeneracion, c.Nombre AS NombreCarrera, gp.Nombre AS NombreGrupo, s.Nombre_semestre
                FROM materia m
                JOIN maestros ma ON m.ID_Maestro = ma.ID_Maestro
                JOIN generacion g ON m.ID_Generacion = g.ID_Generacion
                JOIN carrera c ON m.id_carrera = c.id_carrera
                JOIN grupopedagogico gp ON m.ID_Grupopedagogico = gp.ID_Grupopedagogico
                JOIN semestre s ON m.ID_Semestre = s.ID_Semestre";

        $result = mysqli_query($conexion, $sql);

        // Verificar si la consulta fue exitosa
        if ($result) {
            while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                <tr id="datosTabla">
                    <td><?php echo $mostrar['ID_Materia']?></td>
                    <td><?php echo $mostrar['Nombre_materia']?></td>
                    <td><?php echo $mostrar['Horas']?></td>
                    <td><?php echo $mostrar['Nombre_maestro']?></td>
                    <td><?php echo $mostrar['NombreGeneracion']?></td>
                    <td><?php echo $mostrar['NombreCarrera']?></td>
                    <td><?php echo $mostrar['NombreGrupo']?></td>
                    <td><?php echo $mostrar['Nombre_semestre']?></td>

                    <td id="botonesss">
                        <a href="materias-edit.php?id=<?php echo $mostrar['ID_Materia']?>" <button class="button"><b>Editar</b></button></a>
                        <a href="materias-delete.php?id=<?php echo $mostrar['ID_Materia']?>" <button class="button1"><b>Borrar</b></button></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            // Imprimir el error si la consulta falla
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
        ?>
    </table>
</div>
<script src="confirmacion.js"></script>
</body>
</html>