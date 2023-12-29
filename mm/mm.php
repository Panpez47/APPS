<?php
// Incluir el archivo de conexión a la base de datos
include '../conector.php';

// Consultar la base de datos para obtener todos los maestros
$maestrosQuery = "SELECT ID_Maestro, Nombre_maestro FROM Maestros";
$maestrosResult = $conexion->query($maestrosQuery);

// Consultar la base de datos para obtener todas las materias
$materiasQuery = "SELECT m.ID_Materia, m.Nombre_materia, gp.Nombre AS NombreGrupo
                  FROM Materia m
                  JOIN Grupopedagogico gp ON m.ID_Grupopedagogico = gp.ID_Grupopedagogico";

$materiasResult = $conexion->query($materiasQuery);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/barranav.css">
    <link rel="stylesheet" href="../Styles/forms.css">
    <title>Maestro-Materia</title>
</head>
<body>
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
<!-- Formulario para asignar materias a maestros -->
<div class="container">
  <form action="asignar_materia_a_maestro.php" method="post">
    <label for="maestro">Maestro:</label>
    <select name="maestro" id="maestro">  
    <?php while ($maestro = $maestrosResult->fetch_assoc()): ?>
        <option value="<?php echo $maestro['ID_Maestro']; ?>">
          <?php echo htmlspecialchars($maestro['Nombre_maestro']); ?>
        </option>
      <?php endwhile; ?>
    </select>
  
    <label for="materia">Materia:</label>
    <select name="materia" id="materia">
  <?php while ($materia = $materiasResult->fetch_assoc()): ?>
    <option value="<?php echo $materia['ID_Materia']; ?>">
      <?php echo htmlspecialchars($materia['Nombre_materia'] . ' - Grupo: ' . $materia['NombreGrupo']); ?>
    </option>
  <?php endwhile; ?>
</select>
  
    <input type="submit" value="Asignar Materia">
  </form>
</div>

</body>
</html>