<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>
    <h1>Horarios Guardados</h1>

    <table>
        <tr>
            <th>Nombre del Archivo</th>
            <th>Acciones</th>
        </tr>

        <?php
        $directorio = 'Horarios/';
        $archivos = scandir($directorio);

        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != "..") {
                echo "<tr>";
                echo "<td>{$archivo}</td>";
                echo "<td><a href='ver_horario.php?archivo={$archivo}'>Ver Horario</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
