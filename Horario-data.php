<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/table-horario.css">
    <title>Horarios Guardados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        #headerTabla th:nth-child(2),
        .tablita td:nth-child(2) {
            text-align: center;
            width: 400px;
        }

        .ver-horario {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            padding-top: 0.2rem;
            padding-bottom: 0.2rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            border-radius: 0.375rem;
            color: #ffffff;
            background-color: #3B82F6;
            margin-right: 0.5rem;
        }

        .ver-horario:hover{
            background-color: #1D4ED8;
        }

        .borrar-horario {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            padding-top: 0.2rem;
            padding-bottom: 0.2rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            border-radius: 0.375rem;
            color: #ffffff;
            background-color: #EF4444;
            margin-right: 0.5rem;
        }

        .borrar-horario:hover{
            background-color: #B91C1C;
        }
    </style>
</head>
<body>

<?php
include("formato_horario.php");

// Al principio de Horario-data.php
if (isset($_GET['error'])) {
    echo "<script>alert('" . $_GET['error'] . "');</script>";
}

if (isset($_GET['success'])) {
    echo "<script>alert('" . $_GET['success'] . "');</script>";
}
?>
<nav class="stroke">
    <ul>
        <li><a class="active" href="./Horario-data.php">Horario</a></li>
        <li><a href="./maestros/maestros-data.php">Maestros</a></li>
        <li><a href="./materias/materias-data.php">Materias</a></li>
        <li><a href="./generacion/generacion-data.php">Generacion</a></li>
        <br> <br>
        <li><a href="./mm/mm-data.php">Cursos Docentes</a></li>
        <li><a href="./incidencias/incidencias-data.php">Incidencias</a></li>
        <li><a href="./actext/actext-data.php">Extras</a></li>
        <li><a href="./grupos/grupos-data.php">Grupos</a></li>
        <li><a href="./carrera/carrera-data.php">Carrera</a></li>
    </ul>
</nav>

<h1>Horarios Guardados</h1>

<div class="ContenedorAgregar">
    <a href="./Horario1.php">
        <button class="buttonnav"><b>Agregar</b></button>
    </a>
</div>

<table class="tablita lineasVerticales">
    <tr id="headerTabla">
        <th>ID</th>
        <th>Nombre Horario</th>
        <th>Semana</th> <!-- Nuevo encabezado para la columna Semana -->
        <th>Grupo Pedagógico</th>
        <th>Acciones</th>
    </tr>

    <?php
    include("conector.php");


    
    $sql = "SELECT h.ID_Horario, h.NombreHorario, h.Semana, g.Nombre, g.Semestre, c.nombre as nombre_carrera, gen.Nombre as nombre_generacion 
    FROM Horario h
    JOIN Grupopedagogico g ON h.ID_Grupopedagogico = g.ID_Grupopedagogico
    JOIN Carrera c ON g.id_carrera = c.id_carrera
    JOIN Generacion gen ON g.ID_Generacion = gen.ID_Generacion";
    $result = mysqli_query($conexion, $sql);

    while ($mostrar = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $mostrar['ID_Horario'] . "</td>";
        echo "<td>" . $mostrar['NombreHorario'] . "</td>";
        echo "<td>" . formatWeekToMonthDayRange($mostrar['Semana']) . "</td>"; // Mostrar la semana aquí
        echo "<td>Carrera: " . $mostrar['nombre_carrera'] . " - Semestre: " . $mostrar['Semestre'] . " - Grupo: " . $mostrar['Nombre'] . " - Generacion: " . $mostrar['nombre_generacion'] . "</td>";
        echo "<td>
                <a href='editar-horario.php?idHorario=" . $mostrar['ID_Horario'] . "' class='ver-horario'>Editar</a>
                <a href='borrar_horario.php?idHorario=" . $mostrar['ID_Horario'] . "' class='borrar-horario' onclick='return confirm(\"¿Estás seguro de que quieres borrar el horario?\");'>Borrar</a>
             </td>";
        echo "</tr>";
    }
    ?>
</table>
<br><br><br><br>
<script>
    function borrarHorario(id) {
        // Mostrar un mensaje de confirmación
        var confirmacion = confirm("¿Estás seguro de que quieres borrar el horario?");
        if (confirmacion) {
            // Aquí puedes agregar la lógica para borrar el horario, por ejemplo, una llamada AJAX
            window.location.href = 'borrar_horario.php?idHorario=' + id; // Cambia 'borrar_horario.php' al archivo y ruta correctos
        }
    }

    
}
</script>
</body>
</html>
