<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario Semanal</title>
    <link rel="stylesheet" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/table-horario.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.6/xlsx.full.min.js"></script>
    
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

    <h1>Horario Semanal</h1>
    

<!-- Formulario para guardar horario -->
<form id="horarioForm" action="guardar_horario.php" method="post">
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
        <?php for ($hora = 5; $hora <= 20; $hora++): ?>
            <tr id="datosTabla">
                <td>
                    <input type="text" name="hora[<?php echo $hora; ?>]" value="<?php echo sprintf("%02d:00 - %02d:50", $hora, $hora); ?>" />
                </td>
                <?php for ($dia = 1; $dia <= 6; $dia++): ?>
                    <td>
                        <input type="text" name="materia[<?php echo $dia; ?>][<?php echo $hora; ?>]" list="materiasList" />
                        <datalist id="materiasList">
                            <option value="Matemáticas - Alejandro Panduro López">
                            <option value="Español - Octavio Corral Tovar">
                            <option value="Biología - Gerardo Mora Hernández">
                            <option value="Programación - Hugo González Martínez">
                        </datalist>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <br>
    <input type="submit" onclick="guardarHorario()" value="Guardar Horario">
    <button type="button" onclick="exportarExcel()">Exportar a Excel</button>
</form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>

        function showEditableList(spanElement) {
            $(spanElement).hide().siblings('.editable-list').show();
        }

        function exportarExcel() {
        // Obtén las horas y días de la semana con los datos de los inputs
        var data = obtenerDatosTabla();

        // Crear una nueva hoja de cálculo
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.aoa_to_sheet(data);

        // Agregar la hoja de cálculo al libro
        XLSX.utils.book_append_sheet(wb, ws, "Horario");

        // Autoajustar el ancho de las columnas
        var range = XLSX.utils.decode_range(ws['!ref']);
        for (var C = range.s.c; C <= range.e.c; ++C) {
            ws['!cols'] = ws['!cols'] || [];
            ws['!cols'][C] = { wch: 20 }; // Puedes ajustar el ancho según tus necesidades
        }

        // Guardar el archivo Excel
        XLSX.writeFile(wb, "horario.xlsx");
    }

    function guardarHorario() {
            // Preguntar al usuario el nombre con el que desea guardar el horario
            var nombreHorario = prompt("Por favor, ingrese el nombre con el que desea guardar el horario:");

            // Verificar si se ingresó un nombre
            if (nombreHorario != null && nombreHorario !== "") {
                // Asignar el nombre como valor a un campo oculto en el formulario
                var inputNombre = document.createElement("input");
                inputNombre.type = "hidden";
                inputNombre.name = "nombreHorario";
                inputNombre.value = nombreHorario;
                document.getElementById("horarioForm").appendChild(inputNombre);

                // Enviar el formulario
                document.getElementById("horarioForm").submit();
            } else {
                alert("Por favor, ingrese un nombre válido.");
            }
        }
    </script>
</body>
</html>
