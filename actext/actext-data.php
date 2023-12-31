<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">
    <title>Actext</title>
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
            <li><a href="../materias/materias-data.php">Materias</a></li>
            <li><a href="../generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="../mm/mm-data.php">Cursos Docentes</a></li>
            <li><a href="../incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a class="active" href="../actext/actext-data.php">Extras</a></li>
            <li><a href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>
        </ul>
    </nav>

    <div class="ContenedorAgregar">
        <a href="../actext/actext.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
        <table class="tablita lineasVerticales">
            <tr id="headerTabla">
                <td><b>ID</b></td>
                <td><b>Actividades</b></td>
                <!--<td><b>Maestro</b></td>-->
                <td><b>Acciones</b></td>
            </tr>

            <?php

            $sql = "SELECT id_act, nombre_act FROM actext";

           /* $sql = "SELECT actext.id_act, actext.nombre_act, actext.ID_Maestro, maestros.nombre_maestro 
                    FROM actext 
                    INNER JOIN maestros ON actext.ID_Maestro = maestros.ID_Maestro";*/

            $result = mysqli_query($conexion, $sql);

            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                <tr id="datosTabla">
                    <td><?php echo $mostrar['id_act'] ?></td>
                    <td><?php echo $mostrar['nombre_act'] ?></td>
                   

                    <td id="botonesss">
                        <a href="actext-edit.php?id=<?php echo $mostrar['id_act'] ?>"><button class="button"><b>Editar</b></button></a>
                        <a href="actext-delete.php?id=<?php echo $mostrar['id_act'] ?>"><button class="button1"><b>Borrar</b></button></a>
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
