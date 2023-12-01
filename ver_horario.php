<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver y Editar Horario</title>
    <link rel="stylesheet" href="./Styles/barranav.css">
    <link rel="stylesheet" href="./Styles/table-horario.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.6/xlsx.full.min.js"></script>
</head>
<body>

<!--Menu-->
<nav class="stroke">
        <ul>
            <li><a class="active" href="./Horario-data.php">Horario</a></li>
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

        function obtenerDatosTabla() {
            var data = [['Hora', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']];
            var filas = document.querySelectorAll('#datosTabla');

            filas.forEach(function (fila) {
                var rowData = [];
                var celdas = fila.querySelectorAll('td');

                celdas.forEach(function (celda) {
                    // Obtener el texto o el valor del input según sea el caso
                    var contenido = celda.querySelector('input') ? celda.querySelector('input').value : celda.innerText;
                    rowData.push(contenido);
                });

                data.push(rowData);
            });

            return data;
        }
    </script>
</body>
</html>