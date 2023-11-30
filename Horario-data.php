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

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .ver-horario-link {
        color: #007BFF; /* Color del texto */
        text-decoration: none; /* Sin subrayado */
        font-weight: bold; /* Texto en negrita */
    }
    .ver-horario-link:hover{
        color: #004cff;
    }
    </style>
</head>
<body>

<!--Menu-->
<nav class="stroke">
        <ul>
            <li><a href="./Horario.php">Horario</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a href="./materias/materias-data.php">Materias</a></li>
            <li><a href="./generacion/generacion-data.php">Generacion</a></li> <br> <br>
            <li><a href="./semestre/semestre-data.php">Semestre</a></li>
            <li><a href="./incidencias/incidencias-data.php">Reportes</a></li>
            <li><a href="./actext/actext-data.php">Extras</a></li>
            <li><a href="./grupos/grupos-data.php">Grupos</a></li>
            <li><a href="./carrera/carrera-data.php">Carrera</a></li>

        </ul>
    </nav>
    <h1>Horarios Guardados</h1>
    <div class="ContenedorAgregar">
        <a href="./Horario.php">
            <button class="buttonnav"><b>Agregar</b></button>
        </a>
    </div>
    <table class="tablita lineasVerticales">
        <tr id="headerTabla">
            <th>Nombre del Archivo</th>
            <th>Acciones</th>
        </tr>

        <?php
        $directorio = 'HorariosJSON/';
        $archivos = scandir($directorio);

        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != "..") {
                echo "<tr>";
                echo "<td>{$archivo}</td>";
                echo "<td><a href='ver_horario.php?archivo={$archivo}' class='ver-horario-link'>Ver Horario</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
