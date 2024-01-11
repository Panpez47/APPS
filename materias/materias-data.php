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
    <div class="ContenedorAgregar">
        <a href="../materias/materias.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <?php
session_start();

// Verificar si hay un mensaje de éxito para mostrar
if (isset($_SESSION['mensajeExito'])) {
    $mensajeExito = $_SESSION['mensajeExito'];
    unset($_SESSION['mensajeExito']); // Limpiar el mensaje para evitar que se muestre nuevamente

    // Mostrar la alerta después de un retraso de 300 ms después de que la página esté totalmente cargada
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    alert("' . $mensajeExito . '");
                }, 300);
            });
        </script>';
}
?>
    

    <div>
    <table class="tablita lineasVerticales">
        <tr id="headerTabla">
            <td><b>ID</b></td>
            <td><b>Nombre de la Materia</b></td>
            <td><b>Horas Totales</b></td>
            <td><b>Horas Restantes</b></td>
            <td><b>Grupo Pedagógico</b></td>
            <td><b>Acciones</b></td>
        </tr>

        <?php
         $sql = "SELECT m.ID_Materia, m.Nombre_materia, m.Horas_totales, m.Horas_impartidas, 
         gp.Nombre AS NombreGrupoPedagogico, gp.Semestre, c.nombre AS nombre_carrera, gen.Nombre AS nombre_generacion
         FROM materia m
         JOIN grupopedagogico gp ON m.ID_Grupopedagogico = gp.ID_Grupopedagogico
         JOIN Carrera c ON gp.id_carrera = c.id_carrera
         JOIN Generacion gen ON gp.ID_Generacion = gen.ID_Generacion";
 
        

        $result = mysqli_query($conexion, $sql);

        // Verificar si la consulta fue exitosa
        if ($result) {
            while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                <tr id="datosTabla">
                    <td><?php echo $mostrar['ID_Materia']; ?></td>
                    <td><?php echo $mostrar['Nombre_materia']; ?></td>
                    <td><?php echo $mostrar['Horas_totales']; ?></td>
                    <td><?php echo $mostrar['Horas_impartidas']; ?></td>
                    <td><?php echo (isset($mostrar['nombre_carrera']) ? $mostrar['nombre_carrera'] : '') . " - Semestre: " . (isset($mostrar['Semestre']) ? $mostrar['Semestre'] : '') . " - Grupo: " . $mostrar['NombreGrupoPedagogico'] . " - Generación: " . (isset($mostrar['nombre_generacion']) ? $mostrar['nombre_generacion'] : ''); ?></td>

                    <td id="botonesss">
                        <a href="materias-edit.php?id=<?php echo $mostrar['ID_Materia']; ?>"><button class="button"><b>Editar</b></button></a>
                        <a href="materias-delete.php?id=<?php echo $mostrar['ID_Materia']; ?>"><button class="button1"><b>Borrar</b></button></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
        ?>
    </table>
</div>
<script src="confirmacion.js"></script>
</body>
</html>