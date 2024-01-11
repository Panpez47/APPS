<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/forms.css">
    <title>Horario</title>
</head>

<body>
    <!--Menu-->
<nav class="stroke">
        <ul>
            <li><a class="active" href="./Horario-data.php">Horario</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a href="./materias/materias-data.php">Materias</a></li>
            <li><a href="./generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="./mm/mm-data.php">Cursos Docentes</a></li>
            <li><a href="./incidencias/incidencias-data.php">Incidencias</a></li>
            <li><a href="./actext/actext-data.php">Extras</a></li>
            <li><a href="./grupos/grupos-data.php">Grupos</a></li>
            <li><a href="./carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <?php
    include("conector.php");
    
    $query = "
        SELECT gp.ID_Grupopedagogico, c.nombre AS nombre_carrera, gp.Semestre, gp.Nombre, g.nombre AS nombre_generacion
        FROM Grupopedagogico gp
        JOIN Carrera c ON gp.id_carrera = c.id_carrera
        JOIN Generacion g ON gp.ID_Generacion = g.ID_Generacion
    ";
    $resultado = mysqli_query($conexion, $query);
    ?>
    <div><h1>Crear Nuevo Horario</h1></div>
    <div class="container">
        <form action="crear_horario.php" method="post">
            <label for="nombreHorario">Nombre del Horario:</label>
            <input type="text" id="nombreHorario" name="nombreHorario" required>
    
            <label for="grupopedagogico">Grupo Pedagógico:</label>
            <select name="grupopedagogico" id="grupopedagogico" required>
        <option value="">Selecciona un grupo pedagógico</option>
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <option value="<?php echo $fila['ID_Grupopedagogico']; ?>">
                Carrera: <?php echo $fila['nombre_carrera']; ?> - 
                Semestre: <?php echo $fila['Semestre']; ?> - 
                Grupo: <?php echo $fila['Nombre']; ?> - 
                Generación: <?php echo $fila['nombre_generacion']; ?>
            </option>
        <?php endwhile; ?>
    </select>
            <label for="semana">Semana:</label>
            <input type="week" name="semana" id = "semana">
            
            
            <input type="submit" value="Crear Horario">
        </form>
    </div>
</body>
</html>
