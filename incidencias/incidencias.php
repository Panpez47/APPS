<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Incidencias</title>
</head>
<body>

<?php
    include("../conector.php");
    include("enviar.php");

    $query = "SELECT ID_Maestro , Nombre_maestro FROM maestros";
    $result = $conexion->query($query);

    $gruposQuery = "SELECT ID_Grupopedagogico, Nombre FROM Grupopedagogico";
    $gruposResult = $conexion->query($gruposQuery);
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
    <!-- Formulario -->
    <div class="container">
        <form method="POST"> <!-- Asegúrate de ajustar el archivo de acción -->
            <!-- Motivo -->
            <label for="motivo">Motivo:</label>
            <input type="text" id="motivo" name="motivo" required>
            <br>

            

            <label for="grupo">ID Grupo Pedagógico:</label>
            <select id="grupo" name="grupo" required>
                <?php
                while ($row = $gruposResult->fetch_assoc()) {
                    echo "<option value='" . $row['ID_Grupopedagogico'] . "'>" . $row['Nombre'] . "</option>";
                }
                ?>
            </select>
            <br>

            <!-- Fecha -->
            <label for="fecha">Fecha:</label>
            <input type="text" id="fecha" name="fecha" value="<?php echo date('d-m-Y'); ?>" required readonly>
            <button type="button" onclick="cambiarFecha()">Cambiar Fecha</button>
            <br>
            <input type="submit" name="enviar1">
        </form>
    </div>

    <!-- Script para permitir cambiar la fecha -->
    <script>
        function cambiarFecha() {
            var nuevaFecha = prompt("Ingrese una nueva fecha (Día-Mes-Año):", "<?php echo date('d-m-Y'); ?>");
            if (nuevaFecha) {
                document.getElementById("fecha").value = nuevaFecha;
            }
        }
    </script>

    <?php
    include("enviar.php");
    ?>
</body>
</html>