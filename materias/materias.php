<?php
// Inicializar la sesión
session_start();

// Verificar si hay un mensaje de error para mostrar
if (isset($_SESSION['error'])) {
    $mensajeError = $_SESSION['error'];
    unset($_SESSION['error']); // Limpiar el mensaje para evitar que se muestre nuevamente

    // Mostrar la alerta después de un retraso de 300 ms después de que la página esté totalmente cargada
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    alert("' . $mensajeError . '");
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
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Ingresar Materias</title>
</head>
<body>
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
    <?php
    
    include("../conector.php");

    // Obtener datos para las listas desplegables
    $maestrosQuery = "SELECT ID_Maestro, Nombre_maestro FROM maestros";
    $maestrosResult = $conexion->query($maestrosQuery);

    



    // Consulta para obtener los datos de la tabla Grupopedagogico
    $query = "SELECT gp.ID_Grupopedagogico, gp.Nombre, gp.Semestre, g.Nombre AS NombreGeneracion, c.nombre AS NombreCarrera
    FROM Grupopedagogico gp
    JOIN Generacion g ON gp.ID_Generacion = g.ID_Generacion
    JOIN Carrera c ON gp.id_carrera = c.id_carrera";
$resultado = mysqli_query($conexion, $query);
    
    ?>

    <!-- Formulario -->
    <div class="container">
        <form method="POST" action="procesar_materias.php">
            <label for="nombreMateria">Nombre de la Materia:</label>
            <input type="text" id="nombreMateria" name="nombreMateria" required>
            <br>

            <label for="horas_totales">Horas totales:</label>
            <input type="number" id="horas_totales" name="horas_totales" required>
            <br>

            <label for="grupo">Grupo Pedagógico:</label>
<select id="grupo" name="grupo" required>
    <?php
    while ($row = mysqli_fetch_assoc($resultado)) {
        $textoOpcion = "Carrera: " . $row['NombreCarrera'] . " - Semestre: " . $row['Semestre'] . 
                       " - Grupo: " . $row['Nombre'] . " - Generación: " . $row['NombreGeneracion'];
        echo "<option value='" . $row['ID_Grupopedagogico'] . "'>" . htmlspecialchars($textoOpcion) . "</option>";
    }
    ?>
</select>
            <br>

            <input type="submit" name="enviar_materia">
        </form>
    </div>
</body>
</html>