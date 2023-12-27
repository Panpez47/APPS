<?php
session_start();

// Verificar si hay un mensaje de éxito para mostrar
if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_SESSION['mensajeExito'])) {
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/tables.css">

    <title>Grupo</title>
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
            <li><a href="../actext/actext-data.php">Extras</a></li>
            <li><a class="active" href="../grupos/grupos-data.php">Grupos</a></li>
            <li><a href="../carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>

    <div class="ContenedorAgregar">
        <a href="./grupos.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>

    <div>
    <table class="tablita lineasVerticales">
        <tr id="headerTabla">
            <td><b>ID</b></td>
            <td><b>Nombre del Grupo</b></td>
            <td><b>Semestre</b></td>
            <td><b>Generación</b></td>
            <td><b>Carrera</b></td>
            <td><b>Acciones</b></td>
        </tr>

        <?php
        $sql = "SELECT gp.ID_Grupopedagogico, gp.Nombre, gp.Semestre, g.Nombre AS NombreGeneracion, c.nombre AS NombreCarrera 
                FROM grupopedagogico gp
                JOIN Generacion g ON gp.ID_Generacion = g.ID_Generacion
                JOIN Carrera c ON gp.id_carrera = c.id_carrera";
        $result = mysqli_query($conexion, $sql);

        while ($mostrar = mysqli_fetch_assoc($result)) {
        ?>

        <tr id="datosTabla">
            <td><?php echo $mostrar['ID_Grupopedagogico']; ?></td>
            <td><?php echo $mostrar['Nombre']; ?></td>
            <td><?php echo $mostrar['Semestre']; ?></td>
            <td><?php echo $mostrar['NombreGeneracion']; ?></td>
            <td><?php echo $mostrar['NombreCarrera']; ?></td>

            <td id="botonesss">
            <a href="grupos-edit.php?id=<?php echo $mostrar['ID_Grupopedagogico']; ?>" class="button"><b>Editar</b></a>
            <a href="grupos-delete.php?id=<?php echo $mostrar['ID_Grupopedagogico']; ?>" class="button1"><b>Borrar</b></a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table> 
    
</div>
    <script src ="confirmacion.js"></script>
</body>
</html>