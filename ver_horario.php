<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver y Editar Horario</title>
    <link rel="stylesheet" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/table-horario.css">
    <style>
        /*body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            position: relative;
        }

        input[type="text"], select {
            width: calc(100% - 12px);
            padding: 5px;
            box-sizing: border-box;
            border: none;
            outline: none;
        }

        input[type="text"]:focus, select:focus {
            outline: none;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilo para la lista desplegable en modo edición 
        .editable-list {
            display: none;
            position: absolute;
            z-index: 1;
        }*/
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
    <h1>Ver y Editar Horario</h1>

    <!-- Formulario para ver y editar horario -->
    <form action="guardar_horario.php" method="post">
        <table class="tablita lineasVerticales">
            <tr id="headerTabla">
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
            </tr>
            <?php
            // Verificar si se ha pasado el nombre del archivo por la URL
            if (isset($_GET['archivo'])) {
                $archivo = $_GET['archivo'];
                $rutaArchivo = "HorariosJSON/{$archivo}";

                // Leer el archivo JSON
                $json_data = file_get_contents($rutaArchivo);
                $horario = json_decode($json_data, true);

                // Mostrar el horario guardado
                for ($hora = 5; $hora <= 20; $hora++):
                    ?>
                    <tr id="datosTabla">
                        <td><?php echo $hora . ':00'; ?></td>
                        <?php for ($dia = 1; $dia <= 6; $dia++): ?>
                            <td>
                                <input type="text" name="materia[<?php echo $dia; ?>][<?php echo $hora; ?>]" value="<?php echo isset($horario[$dia . '_' . $hora]) ? $horario[$dia . '_' . $hora] : ''; ?>" list="materiasList" />
                                <datalist id="materiasList">
                                    <option value="Matematicas">
                                    <option value="Español">
                                    <option value="Biologia">
                                    <option value="Programacion">
                                </datalist>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor;
            } else {
                echo "<tr><td colspan='7'>No se ha especificado un archivo.</td></tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" value="Guardar Cambios">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function showEditableList(spanElement) {
            $(spanElement).hide().siblings('.editable-list').show();
        }
    </script>
</body>
</html>