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
    ?>
    <!--Header-->
    <nav class="stroke">
        <ul>
            <li><a class="active" href="../index.php">Horario</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a href="materias.php">Materias</a></li>
            <li><a href="#">Generacion</a></li>
            <li><a href="./semestre.php">Semestre</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <li><a href="#">Extras</a></li>
            <li><a href="#">GruposP</a></li>
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
                <td><b>Maestro</b></td>
                <td><b>Fecha</b></td>
                <td><b>Acciones</b></td>
            </tr>

            <?php
            $sql = "SELECT * FROM incidencias";
            $result = mysqli_query($conexion, $sql);

            while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                <tr id="datosTabla">
                    <td><?php echo $mostrar['ID_Incidencias'] ?></td>
                    <td><?php echo $mostrar['Motivo'] ?></td>
                    <td><?php echo obtenerNombreMaestro($conexion, $mostrar['ID_Maestro']) ?></td>
                    <td><?php echo $mostrar['Fecha'] ?></td>

                    <td id="botonesss">
                        <a href="editar-incidencia.php?id=<?php echo $mostrar['ID_Incidencias'] ?>"><button class="button"><b>Editar</b></button></a>
                        <a href="borrar-incidencia.php?id=<?php echo $mostrar['ID_Incidencias'] ?>"><button class="button1"><b>Borrar</b></button></a>
                    </td>
                </tr>
                <?php
            }

            // Función para obtener el nombre del maestro
            function obtenerNombreMaestro($conexion, $idMaestro)
            {
                $query = "SELECT Nombre_maestro FROM maestros WHERE ID_Maestro = $idMaestro";
                $result = mysqli_query($conexion, $query);
                $row = mysqli_fetch_assoc($result);
                return $row['Nombre_maestro'];
            }
            ?>
        </table> 
    </div>
    <script src="confirmacion.js"></script>
</body>
</html>
