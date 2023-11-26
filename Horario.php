<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario Semanal</title>
    <style>
        body {
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

        /* Estilo para la lista desplegable en modo edición */
        .editable-list {
            display: none;
            position: absolute;
            z-index: 1;
        }
    </style>
</head>
<body>
    <h1>Horario Semanal</h1>

    <!-- Formulario para guardar horario -->
<form action="guardar_horario.php" method="post">
    <table>
        <tr>
            <th>Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
        </tr>
        <?php for ($hora = 5; $hora <= 20; $hora++): ?>
            <tr>
                <td><?php echo $hora . ':00'; ?></td>
                <?php for ($dia = 1; $dia <= 6; $dia++): ?>
                    <td>
                        <input type="text" name="materia[<?php echo $dia; ?>][<?php echo $hora; ?>]" list="materiasList" />
                        <datalist id="materiasList">
                            <option value="Matematicas - Alejandro Panduro López">
                            <option value="Español - Octavio Corral Tovar">
                            <option value="Biologia - Gerardo Mora Hernandez">
                            <option value="Programacion - Hugo Gonzalez Martinez">
                        </datalist>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <br>
    <input type="submit" value="Guardar Horario">
</form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function showEditableList(spanElement) {
            // Ocultar el texto y mostrar la lista desplegable en modo edición
            $(spanElement).hide().siblings('.editable-list').show();
        }
    </script>
</body>
</html>
