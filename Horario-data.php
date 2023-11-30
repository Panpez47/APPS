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

<nav class="stroke">
        <ul>
            <li><a class="active" href="../APPS/Horario.php">Horario</a></li>
            <li><a href="./maestros/maestros-data.php">Maestros</a></li>
            <li><a href="materias.php">Materias</a></li>
            <li><a href="#">Generacion</a></li>
            <li><a href="./semestre.php">Semestre</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <li><a href="#">Extras</a></li>
            <li><a href="#">GruposP</a></li>
        </ul>
    </nav>
    <h1>Horarios Guardados</h1>

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
